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
use MercadoPago\Entities\Preference;
use MercadoPago\Entities\Shared\Item;
use MercadoPago\SDK;

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
            ->with(['schoolSubject', 'user', 'media', 'chats' => ['users', 'messages.user']])
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

    /**
     * update collaboration with multiple resources
     */
    public function updateP(UpdateCollaborationRequest $request)
    {
        $collaboration = Collaboration::find($request->collaboration_id);
        $validated_data = $request->validated();
        $collaboration->update([
            'completed_comments' => $validated_data['completed_comments'],
            'completed_date' => now()->toDateString(),
        ]);
        $collaboration->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());
        return redirect()->route('collaborations.completed')->with('message', 'Colaboración completada');
    }

    public function destroy(Collaboration $collaboration)
    {
        $collaboration->delete();
        return redirect()->route('collaborations.approve-pendent');
    }

    // My views (tabs) ----------------
    public function approvePendent(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = CollaborationResource::collection(Collaboration::where('user_id', auth()->id())
            ->whereNull('approved_at')
            ->filter($filters)
            ->with(['user', 'homework' => ['schoolSubject', 'user', 'media', 'chats' => ['users', 'messages.user']]])
            ->latest()
            ->paginate());

        return Inertia::render('Collaborations/ApprovePendent', compact('collaborations'));
    }

    public function inProcess(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = CollaborationResource::collection(Collaboration::where('user_id', auth()->id())
            ->whereNotNull('approved_at')
            ->whereNull('completed_date')
            ->filter($filters)
            ->with(['user', 'homework' => ['schoolSubject', 'user', 'media', 'chats' => ['users', 'messages.user']]])
            ->latest()
            ->paginate());

        return Inertia::render('Collaborations/InProcess', compact('collaborations'));
    }

    public function completed(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = CollaborationResource::collection(Collaboration::where('user_id', auth()->id())
            ->doesntHave('claim')
            ->whereNotNull('completed_date')
            ->filter($filters)
            ->with(['user', 'homework' => ['schoolSubject', 'user', 'media', 'chats' => ['users', 'messages.user']], 'rate'])
            ->latest('completed_date')
            ->paginate());

        return Inertia::render('Collaborations/Completed', compact('collaborations'));
    }

    public function claims(Request $request)
    {
        $filters = $request->all('search');

        $collaborations = CollaborationResource::collection(Collaboration::where('user_id', auth()->id())
            ->has('claim')
            ->filter($filters)
            ->with(['claim', 'user', 'homework' => ['schoolSubject', 'user', 'media', 'chats' => ['users', 'messages.user']]])
            ->latest()
            ->paginate());

        return Inertia::render('Collaborations/Claims', compact('collaborations'));
    }

    // Other methods
    public function readCollaboration(Request $request)
    {
        $collaboration = Collaboration::with('user.collaborations')->find($request->collaboration_id);
        $collaboration->update(['read_at' => now()]);

        return new CollaborationResource($collaboration);
    }

    public function approve(Collaboration $collaboration)
    {
        $collaboration->update(['approved_at' => now()]);

        return redirect()->route('homeworks.on-collaboration');
    }

    public function releasePayment(Collaboration $collaboration)
    {
        $collaboration->update(['payed_at' => now()]);

        return response()->json(['payed_at' => [
            'relative' => now()->diffForHumans(),
            'string' => now()->toDateTimeString(),
            'special' => now()->isoFormat('DD MMM, YYYY'),
        ]]);
    }

    public function payment(Collaboration $collaboration)
    {
        $collaboration = CollaborationResource::make(Collaboration::with('user', 'homework')->findOrFail($collaboration->id));
        $publicKey = config('stripe.key');

        return inertia('Collaborations/Payment', compact('collaboration', 'publicKey'));
    }
}
