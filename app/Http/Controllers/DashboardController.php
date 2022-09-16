<?php

namespace App\Http\Controllers;

use App\Models\Claim;
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
            ->whereHas('chat', function ($q) {
                $q->whereHas('homework', function ($q2) {
                    $q2->where('user_id', auth()->user()->id);
                });
            })
            ->where('user_id', '!=', auth()->user()->id)
            ->whereNull('read_at')
            ->with('user')
            ->get();

        $homeworks_recently_completed = auth()->user()->homeworks()->whereHas('collaboration', function ($q) {
            $q->whereDate('completed_date', '>=', now())
                ->whereDate('completed_date', '<', now()->addDays(7));
        })->with('collaboration')
            ->get();

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

        // return $profit_month;
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
