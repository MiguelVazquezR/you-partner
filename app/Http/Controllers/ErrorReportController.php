<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreErrorReportsRequest;
use App\Models\ErrorReportModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ErrorReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {

        return Inertia::render('ErrorReport/Index');

    }

    public function store(StoreErrorReportsRequest $request) 
    {
        $report = ErrorReportModel::create($request->validated() + ['user_id' => auth()->id()]);
        $report->addAllMediaFromRequest()->each(fn ($file) => $file->toMediaCollection());

        return back()->with('message','Se ha enviado tu reporte. Muchas gracias por tu retroalimentación');
    }
    
    public function markAsRead(ErrorReportModel $error) 
    {
        $error->update(['is_read'  => 1]);
        return back()->with('message', 'Marcado como leido');
    }

}
