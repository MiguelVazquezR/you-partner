<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use App\Http\Requests\StoreCollaborationRequest;
use App\Http\Requests\UpdateCollaborationRequest;

use App\Http\Resources\HomeworkResource;

use App\Http\Resources\CollaborationResource;
use App\Models\Chat;
use App\Models\Homework;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CollaborationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $exclude_if_i_applied_to_collaborate = true;
        $filters = $request->all('search');
        $homeworks = HomeworkResource::collection(Homework::noCollaborationApproved($exclude_if_i_applied_to_collaborate)
            ->filter($filters)
            ->where('user_id', '<>', auth()->id())
            ->with(['schoolSubject', 'user','media', 'chats' => ['users', 'messages.user']])
            ->latest()
            ->paginate());
       
        return Inertia::render('Collaborations/Index', compact('homeworks', 'filters'));
    }

    public function create()
    {
        //
    }

    public function store(StoreCollaborationRequest $request)
    {
        Collaboration::create($request->validated());
        return redirect()->route('collaborations.approve-pendent'); //->with('message', 'Aplicaste a una colaboración. Espera la aprobación');
    }

    public function show(Collaboration $collaboration)
    {
        //
    }

    public function edit(Collaboration $collaboration)
    {
        //
    }

    public function update(UpdateCollaborationRequest $request, Collaboration $collaboration)
    {
        //
    }

    public function destroy(Collaboration $collaboration)
    {
        //
    }

    // My views (tabs) ----------------
    public function approvePendent(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = CollaborationResource::collection(Collaboration::where('user_id', auth()->id())
            ->whereNull('approved_at')
            ->filter($filters)
            ->with(['user', 'homework' => ['schoolSubject', 'user','media', 'chats' => ['users', 'messages.user']]])
            ->latest()
            ->paginate());

        return Inertia::render('Collaborations/ApprovePendent', compact('collaborations'));
    }

    // Other methods
    public function readCollaboration(Request $request)
    {
        $collaboration = Collaboration::with('user.collaborations')->find($request->collaboration_id);
        $collaboration->update(['read_at' => now()]);

        // dd($collaboration);

        return new CollaborationResource($collaboration);
    }
}
