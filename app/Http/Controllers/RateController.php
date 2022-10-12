<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRateRequest;
use App\Models\Rate;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class RateController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreRateRequest $request)
    {
        Rate::create($request->Validated());

        return redirect()->route('homeworks.completed')->with('message', 'Se ha enviado la calificación. Gracias por tus comentarios');
    }

    public function show(Rate $rate)
    {
        //
    }

    public function edit(Rate $rate)
    {
        //
    }

    public function update(Request $request, Rate $rate)
    {
        //
    }

    public function destroy(Rate $rate)
    {
        //
    }
}
