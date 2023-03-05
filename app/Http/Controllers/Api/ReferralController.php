<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ReferralResource;
use App\Http\Resources\ReferralEarningsResource;

class ReferralController extends Controller
{
    public function index()
    {
        if (addon_activation('referral_system')) {
            $referred_users = User::orderBy('id', 'desc')->where('referred_by', auth()->user()->id)->paginate(10);
            return ReferralResource::collection($referred_users)->additional([
                    'result' => true
                ]);
        }
        return $this->failure_message('You are not authorized to access!!');
    }

    public function referral_code()
    {
        if (addon_activation('referral_system')) {
            $data['referral_code'] = auth()->user()->code;
            return $this->response_data($data);
        }
        return $this->failure_message('You are not authorized to access!!');
    }

    public function referral_earnings()
    {
        if (addon_activation('referral_system')) {
            $referral_earnings = Wallet::orderBy('id', 'desc')->where('payment_method', 'reffered_commission')->where('user_id', auth()->user()->id)->paginate(10);
            return ReferralEarningsResource::collection($referral_earnings)->additional([
                    'result' => true
                ]);
        }
        return $this->failure_message('You are not authorized to access!!');
    }
}
