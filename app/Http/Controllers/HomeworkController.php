<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Http\Requests\StoreHomeworkRequest;
use App\Http\Requests\UpdateHomeworkRequest;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->all('search');

        $homeworks = Homework::where('user_id', auth()->user()->id)
            ->filter($filters)
            ->with(['schoolSubject', 'collaboration', 'resources'])
            ->latest('id')
            ->paginate();


        return Inertia::render('Homework/Index', compact('homeworks', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = SchoolSubject::all();
        return Inertia::render('Homework/Create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHomeworkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'delivery_date' => 'required',
            'priority' => 'required',
            'user_id' => 'required',
            'school_subject_id' => 'required'
        ]);

        Homework::create($data);

        return redirect()->route('homeworks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function edit(Homework $homework)
    {
        $subjects = SchoolSubject::all();
        return Inertia::render('Homework/Edit', compact('homework', 'subjects'));
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

    // My views --------------------
    public function onCollaboration()
    {
        return Inertia::render('Homework/OnCollaboration');
    }

    public function finished()
    {
        return Inertia::render('Homework/Finished');
    }
}
