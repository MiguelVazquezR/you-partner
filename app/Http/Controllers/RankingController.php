<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RankingController extends Controller
{
    public function byCollaborations(){

        return Inertia::render('Ranking/ByCollaborations');
    }

    public function byHomeworks(){

        return Inertia::render('Ranking/ByHomeworks');
    }

    public function byPoints(){

        return Inertia::render('Ranking/ByPoints');
    }

    public function byRatings(){

        return Inertia::render('Ranking/ByRatings');
    }
}
