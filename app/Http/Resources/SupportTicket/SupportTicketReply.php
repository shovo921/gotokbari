<?php

namespace App\Http\Resources\SupportTicket;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportTicketReply extends JsonResource
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
            'reply' =>  str_replace('&amp;', '&', str_replace('&nbsp;', ' ', strip_tags($this->reply))),
            'replied_user_image'=> uploaded_asset(User::find($this->replied_user_id)->photo),
            'created_at'=> $this->created_at,
        ];
    }
}
