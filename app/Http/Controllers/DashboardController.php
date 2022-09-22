<?php

namespace App\Http\Controllers;

use App\Http\Resources\CollaborationResource;
use App\Http\Resources\HomeworkResource;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $homeworks = auth()->user()->homeworks()->with('schoolSubject', 'collaborations.user')->get();
        $collaborations = auth()->user()->collaborations()->with('homework', 'user', 'claim')->get();

        // return CollaborationResource::collection($collaborations->filter(fn ($item) => !$item->approved_at)->values());
        return Inertia::render('Dashboard', [
            'homework_expired' => HomeworkResource::collection($homeworks->filter(fn ($item) => is_null($item?->collaboration?->completed_date) && $item->limit_date <= now()->addDays(3))->values()),
            'homeworks_uploaded_this_month' => $homeworks->filter(fn ($item) => $item->created_at->month == now()->month)->count(),
            'homeworks_uploaded_prev_month' => $homeworks->filter(fn ($item) => $item->created_at->month == now()->subMonths(1)->month)->count(),
            'all_homeworks_uploaded' => $homeworks->count(),
            'unread_messages' => MessageResource::collection(Message::unread('homeworks')->with('user', 'chat.homework')->get()),
            'homeworks_recently_completed' => HomeworkResource::collection($homeworks->filter(fn ($item) => $item?->collaboration?->completed_date >= now()->subDays(7) && $item?->collaboration?->completed_date < now())->values()),
            'apllies_to_collaborate' => HomeworkResource::collection($homeworks->filter(fn ($item) => $item?->collaboration && is_null($item?->collaboration?->read_at))->values()),
            'collaborations_in_process' => CollaborationResource::collection($collaborations->filter(fn ($item) => $item->approved_at && !$item->completed_date)->values()),
            'collaborations_to_approve' => CollaborationResource::collection($collaborations->filter(fn ($item) => !$item->approved_at && !$item->canceled_at)->values()),
            'collaborations_claims' => CollaborationResource::collection($collaborations->filter(fn ($item) => $item->claim && !$item->claim->solution)->values()),
            'unread_messages_c' => MessageResource::collection(Message::unread('collaborations')->with('user')->get()),
            'profit_month' => auth()->user()->monthlyEarnings(now()->month),
            'profit_last_month' => auth()->user()->monthlyEarnings(now()->subMonths(1)->month),
            'money_locked_collaborations' => auth()->user()->collaborationsWithMoneyLocked()->count(),
            'money_locked' => auth()->user()->moneyLocked(),
            'total_profit' => auth()->user()->totalEarnings(),
        ]);
    }
}
