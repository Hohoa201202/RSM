<?php

namespace App\View\Components;

use App\Models\Feedback;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class FeedbackComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $listFeedback = Feedback::join('tbl_Customer', 'tbl_Customer.IdCustomer', '=',  'tbl_Feedback.IdCustomer')
            ->where('isApproved', true)
            ->whereNotNull('content')
            ->whereRaw('CHAR_LENGTH(content) > 10')
            ->where('NumStars', 5)
            ->take(5)
            ->select(
                'tbl_Feedback.*',
                'tbl_Customer.Avatar',
                DB::raw('CONCAT(tbl_Customer.LastName, " ", tbl_Customer.FirstName) AS `FullName`')
            )
            ->get();
        // dd($listFeedback);
        return view('components.feedback-component', ['listFeedback' => $listFeedback]);
    }
}
