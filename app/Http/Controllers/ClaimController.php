<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Http\Requests\StoreClaimRequest;
use App\Http\Requests\UpdateClaimRequest;
use App\Notifications\Claims\NewClaimCreatedNotification;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

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
     * @param  \App\Http\Requests\StoreClaimRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClaimRequest $request)
    {
        $claim = Claim::create($request->validated());

        $claim->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());

        $claim->collaboration->user->notify(new NewClaimCreatedNotification($claim->collaboration->homework->title));

        return redirect()->route('homeworks.claims')->with('message', 'Se ha registrado el reclamo, haremos lo posible para solucionarlo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function show(Claim $claim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function edit(Claim $claim)
    {
        //
    }

    public function update(Request $request, Claim $claim)
    {
        $validated = $request->validate([
            'solution_details' => 'required',
            'solution' => 'required|string|max:100',
            'refund' => 'required|numeric|min:0',
            'claim_id' => 'required|numeric|min:1',
        ]);

        $claim->update($validated + ['status' => 'Cerrado']);

        return redirect()->route('admin.claims')->with('message', 'Se ha enviado la solución al reclamo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function destroy(Claim $claim)
    {
        $claim->delete();
        return redirect()->route('homeworks.claims')->with('message', 'Se eliminó el reclamo');
    }
}
