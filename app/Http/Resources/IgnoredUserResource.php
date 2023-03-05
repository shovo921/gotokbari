<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Utility\MemberUtility;
use Illuminate\Http\Resources\Json\JsonResource;

class IgnoredUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id'        => $this->user_id,
            'photo'          => uploaded_asset($this->user->photo),
            'name'           => $this->user->first_name.' '.$this->user->last_name,
            'age'            => Carbon::parse($this->user->member->birthday)->age,
            'religion'       => MemberUtility::member_religion($this->user_id),
            'country'        => MemberUtility::member_country($this->user_id),
            'mothere_tongue' => MemberUtility::member_mothere_tongue($this->user_id),
        ];
    }
}
