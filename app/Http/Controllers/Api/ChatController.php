<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\ChatRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\ChatThreadResource;
use App\Http\Resources\MatchedProfileResource;
use App\Models\Chat;
use App\Models\ChatThread;
use App\Models\IgnoredUser;
use App\Models\ProfileMatch;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat_list()
    {
        $matched_profiles = [];
        $user = auth()->user();
        if ($user->member->auto_profile_match == 1) {
            $matched_profiles = ProfileMatch::orderBy('match_percentage', 'desc')
                ->where('user_id', $user->id)
                ->where('match_percentage', '>=', 50);

            $ignored_to = IgnoredUser::where('ignored_by', $user->id)->pluck('user_id')->toArray();
            if (count($ignored_to) > 0) {
                $matched_profiles = $matched_profiles->whereNotIn('match_id', $ignored_to);
            }
            $ignored_by_ids = IgnoredUser::where('user_id', $user->id)->pluck('ignored_by')->toArray();
            if (count($ignored_by_ids) > 0) {
                $matched_profiles = $matched_profiles->whereNotIn('match_id', $ignored_by_ids);
            }
            $matched_profiles = $matched_profiles->limit(20)->get();
        }
        $data['matched_profiles'] = MatchedProfileResource::collection($matched_profiles);
        $chat_threads = ChatThread::where('sender_user_id', auth()->user()->id)->orWhere('receiver_user_id', auth()->user()->id)->get();
        return  ChatThreadResource::collection($chat_threads)->additional([
            'result' => true,
            'matched_profile'=> $data
        ]);
    }

    public function chat_view($id)
    {
        $chat_thread = ChatThread::findOrFail($id);
        foreach ($chat_thread->chats as $key => $chat) {
            if ($chat->sender_user_id != auth()->user()->id) {
                $chat->seen = 1;
                $chat->save();
            }
        }
        return (new ChatResource($chat_thread))->additional([
                'result' => true
            ]);
    }

    public function get_old_messages(Request $request)
    {
        $chat = Chat::findOrFail($request->first_message_id);
        $chats = Chat::where('id', '<', $chat->id)->where('chat_thread_id', $chat->chat_thread_id)->latest()->limit(20)->get();
        if(count($chats) > 0){
            return response()->json([
                'result' => true,
                'messages' => $chats,
                'first_message_id' => $chats->last()->id
            ]);            
        }
        else {
            return response()->json([
                'result' => false,
                'messages' => "",
                'first_message_id' => 0
            ]);            
        }
    }

    public function chat_reply(ChatRequest $request)
    {
        // image upload
        $attachments = [];
        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $attachment = upload_api_file($file);
                $attachments[] = $attachment;
            }
        }      

        $chat = new ChatService();
        $new_chat = $chat->store($request->except(['_token']), $attachments);
        return $this->success_message('Data inserted successfully!');
    }
}
