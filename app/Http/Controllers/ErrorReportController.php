<?php

namespace App\Http\Controllers;

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
        $filters = $request->all('search');
        $errors = ErrorReportModel::
            filter($filters)
            ->with('user')
            ->latest()
            ->paginate();

        return Inertia::render('ErrorReport/Index', compact('errors'));

    }
}
