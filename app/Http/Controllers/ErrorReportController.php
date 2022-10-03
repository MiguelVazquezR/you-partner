<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ErrorReportController extends Controller
{
    public function index()
    {

        return Inertia::render('ErrorReport/Index');
    }
}
