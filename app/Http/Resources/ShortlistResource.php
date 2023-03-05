<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Utility\MemberUtility;
use App\Models\ExpressInterest;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortlistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $package_update_alert = get_setting('full_profile_show_according_to_membership') == 1 && auth()->user()->membership == 1 ? true : false;
        $interest = ExpressInterest::where('user_id', $this->user_id)->where('interested_by',auth()->user()->id)->first();

        return [
            'user_id'              => $this->user_id,
            'package_update_alert' => $package_update_alert,
            'photo'                => uploaded_asset($this->user->photo),
            'name'                 => $this->user->first_name.' '.$this->user->last_name,
            'age'                  => Carbon::parse($this->user->member->birthday)->age,
            'religion'             => MemberUtility::member_religion($this->user_id),
            'country'              => MemberUtility::member_country($this->user_id),
            'mothere_tongue'       => MemberUtility::member_mothere_tongue($this->user_id),
            'express_interest'     => $interest ? true : false,
        ];
    }
}
