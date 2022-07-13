<?php

namespace App\Http\Controllers;

use App\Models\SchoolSubject;
use App\Http\Requests\StoreSchoolSubjectRequest;
use App\Http\Requests\UpdateSchoolSubjectRequest;

class SchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSchoolSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolSubjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolSubject  $schoolSubject
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolSubject $schoolSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolSubject  $schoolSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolSubject $schoolSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchoolSubjectRequest  $request
     * @param  \App\Models\SchoolSubject  $schoolSubject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolSubjectRequest $request, SchoolSubject $schoolSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolSubject  $schoolSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolSubject $schoolSubject)
    {
        //
    }
}
