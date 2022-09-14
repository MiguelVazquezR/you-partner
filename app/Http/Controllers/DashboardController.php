<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $homework_no_collaborations = auth()->user()->homeworks()->whereDate('limit_date', '<=', now()->addDays(3))->whereDoesntHave('collaboration')->get();
        $homework_expired = $homework_no_collaborations->merge(auth()->user()->homeworks()->whereDate('limit_date', '<=', now()->addDays(3))->whereHas('collaboration', function ($q) {
            $q->whereNull('completed_date');
        })->with('schoolSubject', 'collaboration')->get());

        $homeworks_uploaded_this_month = auth()->user()->homeworks()->whereMonth('created_at', now()->month)->get()->count();
        $homeworks_uploaded_prev_month = auth()->user()->homeworks()->whereMonth('created_at', now()->subMonth(1)->month)->get()->count();
        $all_homeworks_uploaded = auth()->user()->homeworks->count();

        $chats_ids = auth()->user()->chats->pluck('id');
        $unread_messages = Message::whereIn('chat_id', $chats_ids)
            ->where('user_id', '!=', auth()->user()->id)
            ->whereNull('read_at')
            ->with('user')
            ->get();

        // return $unread_messages;
        return Inertia::render('Dashboard', compact(
            'homework_expired',
            'homeworks_uploaded_this_month',
            'homeworks_uploaded_prev_month',
            'all_homeworks_uploaded',
            'unread_messages',
        ));
    }
}
