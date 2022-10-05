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
        $filters = $request->all('search');
        $homeworks = HomeworkResource::collection(Homework::noCollaborationApproved()
            ->filter($filters)
            ->where('user_id', '<>', auth()->user()->id)
            ->with(['schoolSubject', 'user','media', 'chats' => ['users', 'messages.user']])
            ->latest()
            ->paginate());
       
        return Inertia::render('Collaborations/Index', compact('homeworks', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCollaborationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCollaborationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function show(Collaboration $collaboration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function edit(Collaboration $collaboration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCollaborationRequest  $request
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCollaborationRequest $request, Collaboration $collaboration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collaboration $collaboration)
    {
        //
    }

    // My views (tabs) ----------------
    public function myCollaborations(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = Collaboration::where('user_id', auth()->user()->id)
            ->filter($filters)
            ->with(['user', 'homework' => ['user']])
            ->latest()
            ->paginate();

        return Inertia::render('Collaborations/MyCollaborations', compact('collaborations'));
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
