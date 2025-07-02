<?php

namespace App\Http\Controllers;

use App\Models\ManualPayment;
use Illuminate\Http\Request;

class ManualPaymentController extends Controller
{
    public function approvePayment(Request $request, ManualPayment $payment)
    {
        $payment->status = 'approved';
        $payment->save();

        $user = $payment->user;
        $user->access_level_id = $payment->access_level_id;
        $user->save();

        return redirect()->back()->with('success', 'Payment approved and user access level updated.');
    }
}
