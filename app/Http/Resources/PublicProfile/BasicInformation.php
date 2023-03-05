<?php

namespace App\Http\Resources\PublicProfile;

use App\Http\Resources\Profile\OnBehalfResource;
use App\Models\OnBehalf;
use Illuminate\Http\Resources\Json\JsonResource;

class BasicInformation extends JsonResource
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
            'firs_name'=> $this->first_name,
            'last_name'=> $this->last_name,                       
            'date_of_birth' => $this->member->birthday,
            'onbehalf' => new OnBehalfResource(OnBehalf::find($this->member->on_behalves_id)),
            'no_of_children' => $this->member->children,
            'gender' => $this->member->gender,
            'phone' => $this->phone,          
            'maritial_status' =>  $this->member->marital_status ? $this->member->marital_status->name : '',
            'photo'=> uploaded_asset($this->photo) ?? static_asset('assets/frontend/default/img/avatar-place.png'),
            
        ];
    }
}
