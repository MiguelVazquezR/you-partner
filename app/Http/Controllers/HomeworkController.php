<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Http\Requests\StoreHomeworkRequest;
use App\Http\Requests\UpdateHomeworkRequest;
use App\Http\Resources\HomeworkResource;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeworkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        $filters = $request->all('search');

        $homeworks = HomeworkResource::collection(auth()->user()->homeworks()
            ->filter($filters)
            ->with(['schoolSubject', 'collaborations.user.collaborations', 'chats' => ['users', 'messages.user']])
            ->latest('id')
            ->paginate());

        return Inertia::render('Homework/Index', compact('homeworks', 'filters'));
    }

    public function create()
    {
        $subjects = SchoolSubject::all();

        return Inertia::render('Homework/Create', compact('subjects'));
    }

    public function store(StoreHomeworkRequest $request)
    {
        $homework = Homework::create($request->validated());
        $homework->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());

        // request()->session()->flash('flash.banner', 'Se ha creado la tarea correctamente!');
        // request()->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('homeworks.no-collaboration')->with('message', 'Se ha creado la tarea correctamente!');
    }

    public function edit(Homework $homework)
    {
        $subjects = SchoolSubject::all();
        $media = $homework->getMedia()->all();

        return Inertia::render('Homework/Edit', compact('homework', 'subjects', 'media'));
    }

    public function update(UpdateHomeworkRequest $request, Homework $homework)
    {
        $homework->update($request->validated());

        return redirect()->route('homeworks.no-collaboration')->with('message', 'Se ha actualizado la tarea correctamente!');
    }

    public function updateWithResources(UpdateHomeworkRequest $request, Homework $homework)
    {
        $homework->update($request->validated());
        $homework->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());

        return redirect()->route('homeworks.no-collaboration')->with('message', 'Se ha actualizado la tarea correctamente!');
    }

    public function destroy(Homework $homework)
    {
        $homework->delete();

        return redirect()->route('homeworks.no-collaboration')->with('message', 'Se ha eliminado la tarea correctamente!');
    }

    // My views (tabs) --------------------
    public function noCollaboration(Request $request)
    {
        $filters = $request->all('search');

        $homeworks = HomeworkResource::collection(auth()->user()->homeworks()
            ->whereDate('limit_date', '>=', now())
            ->noCollaborationApproved()
            ->filter($filters)
            ->with(['schoolSubject', 'collaborations.user.collaborations', 'chats' => ['users', 'messages.user']])
            ->latest('id')
            ->paginate());

        return Inertia::render('Homework/NoCollaboration', compact('homeworks', 'filters'));
    }

    public function onCollaboration(Request $request)
    {
        $filters = $request->all('search');

        $homeworks = HomeworkResource::collection(auth()->user()->homeworks()
            ->whereHas('collaborations', function ($query) {
                $query->whereNotNull('approved_at')
                    ->whereNull('completed_date');
            })
            ->filter($filters)
            ->with(['user', 'schoolSubject', 'collaborations.user.collaborations', 'chats' => ['users', 'messages.user']])
            ->latest('id')
            ->paginate());

        return Inertia::render('Homework/OnCollaboration', compact('homeworks', 'filters'));
    }

    public function completed(Request $request)
    {
        $filters = $request->all('search');

        $homeworks = HomeworkResource::collection(auth()->user()->homeworks()
            ->whereHas('collaborations', function ($query) {
                $query->doesntHave('claim')
                    ->whereNotNull('completed_date');
            })
            ->filter($filters)
            ->with(['schoolSubject', 'collaborations' => ['user.collaborations', 'rate',], 'chats' => ['users', 'messages.user']])
            ->latest('id')
            ->paginate());


        return Inertia::render('Homework/Completed', compact('homeworks', 'filters'));
    }

    public function claims(Request $request)
    {
        $filters = $request->all('search');

        $homeworks = HomeworkResource::collection(auth()->user()->homeworks()
            ->whereHas('collaborations', function ($query) {
                $query->Has('claim');
            })
            ->filter($filters)
            ->with(['schoolSubject', 'user', 'collaborations' => ['user.collaborations', 'claim'], 'chats' => ['users', 'messages.user']])
            ->latest('id')
            ->paginate());

        // return $homeworks;

        return Inertia::render('Homework/Claims', compact('homeworks', 'filters'));
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create($request->all());

        return new MessageResource(Message::with('user')->find($message->id));
    }

    public function deleteFile(Request $request)
    {
        Homework::find($request->homework_id)->deleteMedia($request->file_id);

        return response()->json(['success' => 'success'], 200);
    }
}
