<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $attributes = [
        "date_fin_reservation" => null,
        "est_active" => null,
        "position_liste_attente" => null,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function place(): HasOne
    {
        return $this->hasOne(Place::class);
    }

    public function historiqueReservations(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public static function create(User $user)
    {
        // Cette requête retourne une éventuelle réservation active de l'utilisateur
        $reservation_active = Reservation::where('est_active', '=', 1)->where('user_id', '=', $user->id)->first();

        // Si l'utilisateur n'a pas de reservation active 
        if (!($reservation_active)) {

            // Créer un nouvelle réservation
            $reservation = new Reservation;
            $reservation->est_active = true;

            // Remplit les références croisées entre l'utilisateur et la réservation
            $reservation->user_id = $user->id;
            $reservation->save();

            // Tente de trouver une place disponible 
            $place_libre = Place::disponible();

            // Si il n'y a aucune place libre 
            if (!($place_libre)) {
                // Ajouter l'utilisteur à la file d'attente 
                $waitlist = Waitlist::add($user);

                // Ajoute la position en file d'attente à la réservation
                $reservation->num_liste_attente = $waitlist->position;
                $reservation->place_id = null;
            } else {
                // Si il y a une place disponible elle est attibuée a la réservation
                Place::reserver($place_libre);
                $reservation->place_id = $place_libre->id;
                $reservation->num_liste_attente = null;
                $duree_reservation = Parametre::find(1)->duree_reservations;
                $reservation->date_fin_reservation = now()->add(CarbonInterval::days($duree_reservation));
            }


            $user->reservation_id = $reservation->id;
            $user->save();

            return $reservation;
        }

        return redirect()->back()->flash('message', 'Vous avez déja une réservation active');
    }

    public static function historique($user)
    {
        $historique = Reservation::where('user_id', '=', $user->id)->where('est_active', '=', 0)->get();

        return $historique;
    }
}
