<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Collaboration;
use App\Models\User;
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
        
        $claims = Claim::with(['collaboration.homework' => ['schoolSubject', 'user']])->paginate();
        return Inertia::render('Admin/Claims', compact('claims')) ;
    }

    public function notifications(){

        return Inertia::render('Admin/Notifications');
    }

    public function users(){

        $users = User::with('level', 'collaborations')->paginate();

        // return $users;

        return Inertia::render('Admin/Users',compact('users'));
    }
}
