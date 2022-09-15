<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function finances(){

        return Inertia::render('Admin/Finances');
    }

    public function configurations(){

        return Inertia::render('Admin/Configurations');
    }

    public function claims(){

        return Inertia::render('Admin/Claims');
    }

    public function notifications(){

        return Inertia::render('Admin/Notifications');
    }

    public function users(){

        return Inertia::render('Admin/Users');
    }
}
