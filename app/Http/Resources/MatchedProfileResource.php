<?php

namespace App\Http\Resources;

use App\Models\ReportedUser;
use App\Models\Shortlist;
use Carbon\Carbon;
use App\Utility\MemberUtility;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchedProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        $avatar_image = $this->user->member->gender == 1 ? 'assets/img/avatar-place.png' : 'assets/img/female-avatar-place.png';
        $profile_picture_show = show_profile_picture($this->user);
        return [
            'user_id'              => $this->match_id,
            'code'                 => $this->user->code,
            'membership'           => $this->user->membership,
            'name'                 => $this->user->first_name.' '.$this->user->last_name,
            'photo'                => $profile_picture_show ? uploaded_asset($this->user->photo) : static_asset($avatar_image),
            'age'                  => !empty($this->user->member->birthday) ? Carbon::parse($this->user->member->birthday)->age : '',
            'height'               => !empty($this->user->physical_attributes->height) ? $this->user->physical_attributes->height : '',
            'marital_status'       => !empty($this->user->member->marital_status->name) ? $this->user->member->marital_status->name : '',
            'religion'             => MemberUtility::member_religion($this->match_id),
            'caste'                => !empty($this->user->spiritual_backgrounds->caste->name) ? $this->user->spiritual_backgrounds->caste->name.', ' : "",
            'sub_caste'            => !empty($this->user->spiritual_backgrounds->sub_caste->name) ? $this->user->spiritual_backgrounds->sub_caste->name : "",
            "report_status"        => ReportedUser::where('user_id', $this->id)->where('reported_by', auth()->id())->first()? true : false,
            "shortlist_status"    => Shortlist::where('user_id', $this->id)->where('shortlisted_by', auth()->id())->first()? 1 : 0,
        ];
    }
}
