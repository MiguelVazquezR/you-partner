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
        $this->middleware('auth');
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

        return redirect()->route('homeworks.index'); //->with('message', 'Se ha creado la tarea correctamente!');
    }

    public function edit(Homework $homework)
    {
        $subjects = SchoolSubject::all();
        $media = $homework->getMedia()->all();

        return Inertia::render('Homework/Edit', compact('homework', 'subjects', 'media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHomeworkRequest  $request
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Homework $homework)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'delivery_date' => 'required',
            'priority' => 'required',
            'school_subject_id' => 'required'
        ]);

        $homework->update($data);

        return redirect()->route('homeworks.edit', $homework);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homework $homework)
    {
        $homework->delete();

        return redirect()->route('homeworks.index');
    }

    // My views (tabs) --------------------
    public function noCollaboration(Request $request)
    {
        $filters = $request->all('search');

        $homeworks = HomeworkResource::collection(auth()->user()->homeworks()
            ->doesntHave('collaborations')
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
            ->with('schoolSubject', 'collaborations.user')
            ->latest('id')
            ->paginate());

        return Inertia::render('Homework/OnCollaboration', compact('homeworks', 'filters'));
    }

    public function finished(Request $request)
    {
        $filters = $request->all('search');

        $homeworks = HomeworkResource::collection(auth()->user()->homeworks()
            ->whereHas('collaborations', function ($query) {
                $query->whereNotNull('completed_date');
            })
            ->filter($filters)
            ->with('schoolSubject', 'collaborations.user')
            ->latest('id')
            ->paginate());

        return Inertia::render('Homework/Finished', compact('homeworks', 'filters'));
    }

    public function claims(Request $request)
    {
        $filters = $request->all('search');

        $homeworks = HomeworkResource::collection(auth()->user()->homeworks()
            ->whereHas('collaborations', function ($query) {
                $query->whereNotNull('completed_date');
            })
            ->filter($filters)
            ->with('schoolSubject', 'collaborations.user')
            ->latest('id')
            ->paginate());

        return Inertia::render('Homework/Claims', compact('homeworks', 'filters'));
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create($request->all());

        return new MessageResource(Message::with('user')->find($message->id));
    }
}
