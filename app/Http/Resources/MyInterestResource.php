<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Utility\MemberUtility;
use App\Models\ExpressInterest;
use Illuminate\Http\Resources\Json\JsonResource;

class MyInterestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $interest = ExpressInterest::find($this->id);
        $package_update_alert = get_setting('full_profile_show_according_to_membership') == 1 && auth()->user()->membership == 1 ? true : false;

        return [
            'user_id'              => $interest->user_id,
            'package_update_alert' => $package_update_alert,
            'photo'                => uploaded_asset($interest->user->photo),
            'name'                 => $interest->user->first_name.' '.$interest->user->last_name,
            'age'                  => Carbon::parse($interest->user->member->birthday)->age,
            'religion'             => MemberUtility::member_religion($interest->user_id),
            'country'              => MemberUtility::member_country($interest->user_id),
            'mothere_tongue'       => MemberUtility::member_mothere_tongue($interest->user_id),
            'status'               => $interest->status == 1 ? 'Approved' : 'Pending',
        ];
    }
}
