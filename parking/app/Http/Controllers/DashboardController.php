<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function accueil()
    {
        $user = Auth::user();
        $nb_places = DB::table('places')->where('est_occupee', '=', 0)->count();

        return view('dashboard', ['user' => $user, 'nb_places' => $nb_places,]);
    }

    public function parametres()
    {
        $user = Auth::user();
        $nb_places = DB::table('places')->where('est_occupee', '=', 0)->count();

        return view('parametres', ['user' => $user, 'nb_places' => $nb_places,]);
    }
}
