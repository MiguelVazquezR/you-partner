<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClaimResource;
use App\Http\Resources\CollaborationResource;
use App\Http\Resources\ErrorReportResource;
use App\Http\Resources\UserResource;
use App\Models\Claim;
use App\Models\Collaboration;
use App\Models\ErrorReportModel;
use App\Models\User;
use Inertia\Inertia;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function finances()
    {

        return Inertia::render('Admin/Finances');
    }

    public function configurations()
    {

        return Inertia::render('Admin/Configurations');
    }

    public function claims()
    {
        $claims = ClaimResource::collection(Claim::with(['collaboration.homework' => ['chats' => ['users', 'messages.user'], 'schoolSubject', 'user']])->paginate());
        return Inertia::render('Admin/Claims', compact('claims'));
    }

    public function notifications()
    {

        return Inertia::render('Admin/Notifications');
    }

    public function users()
    {

        $users = User::with('level', 'collaborations')->paginate();

        // return UserResource::collection($users);
        return Inertia::render('Admin/Users', [
            'users' => UserResource::collection($users)
        ]);
    }

    public function errors(Request $request)
    {
        $filters = $request->all('search');
        $errors = ErrorReportResource::collection(ErrorReportModel::filter($filters)
            ->with('user')
            ->latest()
            ->paginate());

        // return $errors;
        return Inertia::render('Admin/Errors', compact('errors'));
    }

    public function collaborations(Request $request)
    {
        $collaborations = CollaborationResource::collection(Collaboration::doesntHave('claim')
            ->with(['homework' => ['schoolSubject', 'user'], 'user'])
            ->paginate());
        return Inertia::render('Admin/Collaborations', compact('collaborations'));
    }
}
