<?php

namespace App\Http\Controllers;

use App\Models\ErrorReportModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ErrorReportController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $errors = ErrorReportModel::all()
            ->filter($filters)
            ->with('user')
            ->latest()
            ->paginate();

        return Inertia::render('ErrorReport/Index', compact('errors'));

    }
}
