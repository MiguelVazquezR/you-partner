<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRateRequest;
use App\Http\Resources\RateResource;
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
        $rate = Rate::create($request->validated());

        return response()->json(['rate' => new RateResource($rate)]);
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
