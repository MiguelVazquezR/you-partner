<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RankingController extends Controller
{
    public function ranking(){

        return Inertia::render('Ranking/Ranking');
    }

    public function awards(){

        return Inertia::render('Ranking/Awards');
    }

    public function motivation(){

        return Inertia::render('Ranking/Motivation');
    }

    public function levels(){

        return Inertia::render('Ranking/Levels');
    }
}
