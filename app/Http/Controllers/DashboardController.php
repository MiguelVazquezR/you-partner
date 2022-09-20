<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeworkResource;
use App\Models\Claim;
use App\Models\Homework;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $homeworks = auth()->user()->homeworks()->with('schoolSubject', 'collaboration')->get();
        $homework_expired = $homeworks->filter(fn ($item) => is_null($item?->collaboration?->completed_date) && $item->limit_date <= now()->addDays(3))->values();
        $homeworks_uploaded_this_month = $homeworks->filter(fn ($item) => $item->created_at->month == now()->month )->count();
        $homeworks_uploaded_prev_month = $homeworks->filter(fn ($item) => $item->created_at->month == now()->subMonth(1)->month )->count();
        $all_homeworks_uploaded = $homeworks->count();
        $homeworks_recently_completed = $homeworks->filter(fn ($item) => $item?->collaboration?->completed_date >= now()->subDays(7) && $item?->collaboration?->completed_date < now())->values();

        // $homework_no_collaborations = auth()->user()->homeworks()->whereDate('limit_date', '<=', now()->addDays(3))->whereDoesntHave('collaboration')->with('schoolSubject', 'collaboration')->get();
        // $homework_expired = $homework_no_collaborations->merge(auth()->user()->homeworks()->whereDate('limit_date', '<=', now()->addDays(3))->whereHas('collaboration', function ($q) {
        //     $q->whereNull('completed_date');
        // })->with('schoolSubject', 'collaboration', 'user', 'chats')->get());

        // $homeworks_uploaded_this_month = auth()->user()->homeworks()->whereMonth('created_at', now()->month)->get()->count();
        // $homeworks_uploaded_prev_month = auth()->user()->homeworks()->whereMonth('created_at', now()->subMonth(1)->month)->get()->count();

        $chats_ids = auth()->user()->chats->pluck('id');
        $unread_messages = Message::whereIn('chat_id', $chats_ids)
            ->whereHas('chat', function ($q) {
                $q->whereHas('homework', function ($q2) {
                    $q2->where('user_id', auth()->user()->id);
                });
            })
            ->where('user_id', '!=', auth()->user()->id)
            ->whereNull('read_at')
            ->with('user', 'chat.homework')
            ->get();

        // $homeworks_recently_completed = auth()->user()->homeworks()->whereHas('collaboration', function ($q) {
        //     $q->whereDate('completed_date', '>=', now()->subDays(7))
        //         ->whereDate('completed_date', '<', now());
        // })->with('collaboration')
        //     ->get();

        $apllies_to_collaborate = auth()->user()->homeworks()->whereHas('collaboration', function ($q) {
            $q->whereNull('read_at');
        })->with('collaboration.user')
            ->get();

        // My collaborations
        $payed_month = auth()->user()->collaborations()->whereMonth('completed_date', now()->month)
        ->whereNotNull('payed_at')
        ->get('price')->sum('price');
        $refund_month = Claim::whereHas('collaboration', function($q){
            $q->where('user_id', auth()->user()->id);
        })
        ->whereMonth('created_at', now()->month)
        ->get('refund')->sum('refund');
        $profit_month = number_format(($payed_month - $refund_month), 2);
        
        $payed_last_month = auth()->user()->collaborations()->whereMonth('completed_date', now()->subMonths(1))
        ->get('price')->sum('price');
        $refund_last_month = Claim::whereHas('collaboration', function($q){
            $q->where('user_id', auth()->user()->id);
        })
        ->whereMonth('created_at', now()->subMonths(1))
        ->get('refund')->sum('refund');
        $profit_last_month = number_format(($payed_last_month - $refund_last_month), 2);

        $money_locked_collaborations = auth()->user()->collaborations()->whereNotNull('completed_date')->whereNull('payed_at')
        ->get('price')->count();
        $money_locked = auth()->user()->collaborations()->whereNotNull('completed_date')->whereNull('payed_at')
        ->get('price')->sum('price');
        $money_locked = number_format($money_locked, 2);

        $total_payed = auth()->user()->collaborations()
        ->whereNotNull('payed_at')
        ->get('price')->sum('price');
        $total_refund = Claim::whereHas('collaboration', function($q){
            $q->where('user_id', auth()->user()->id);
        })
        ->get('refund')->sum('refund');
        $total_profit = number_format(($total_payed - $total_refund), 2);

        $collaborations_in_process = auth()->user()->collaborations()->whereNotNull('approved_at')
            ->whereNull('completed_date')
            ->with('homework')
            ->get();

        $collaborations_to_approve = auth()->user()->collaborations()->whereNull('approved_at')
            ->with('homework')
            ->get();

        $collaborations_claims = auth()->user()->collaborations()
            ->whereHas('claim', function ($q) {
                $q->whereNull('solution');
            })
            ->with('homework', 'claim')
            ->get();

        $chats_ids = auth()->user()->chats->pluck('id');
        $unread_messages_c = Message::whereIn('chat_id', $chats_ids)
            ->whereHas('chat', function ($q) {
                $q->whereHas('homework', function ($q2) {
                    $q2->where('user_id', '!=', auth()->user()->id);
                });
            })
            ->where('user_id', '!=', auth()->user()->id)
            ->whereNull('read_at')
            ->with('user')
            ->get();

        // return $homeworks_uploaded_this_month->count();
        return Inertia::render('Dashboard', compact(
            'homework_expired',
            'homeworks_uploaded_this_month',
            'homeworks_uploaded_prev_month',
            'all_homeworks_uploaded',
            'unread_messages',
            'homeworks_recently_completed',
            'apllies_to_collaborate',
            'collaborations_in_process',
            'collaborations_to_approve',
            'unread_messages_c',
            'collaborations_claims',
            'profit_month',
            'profit_last_month',
            'money_locked_collaborations',
            'money_locked',
            'total_profit',
        ));
    }
}