<?php
/**
 * Class MessageController.
 *
 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Message;
use App\Job;
use DB;
use App\User;
use App\Helper;
use Auth;
use Carbon\Carbon;
use App\SiteManagement;
use App\Chatroom;
use App\Chat;
use App\JobChat;
use App\Live_contest_participant;
use App\Live_contest;

/**
 * Class MessageController
 *
 */
class MessageController extends Controller
{
    protected $message;

    /**
     * Create a new controller instance.
     *
     * @param mixed $message make instance
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  dd('this is the test');
        if (Auth::user()) {
            $senders = '';
            $senders =  $this->message::select('user_id')->where('receiver_id', auth()->user()->id)->groupBy('user_id')->get();
            $chat_settings = SiteManagement::getMetaValue('chat_settings');
            if (file_exists(resource_path('views/extend/back-end/chat-room/index.blade.php'))) {
                return View(
                    'extend.back-end.chat-room.index',
                    compact('senders', 'chat_settings')
                );
            } else {
                return View(
                    'back-end.chat-room.index',
                    compact('senders', 'chat_settings')
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function startchat($id)
    {
        //dd($id);
        $ids = explode('_', $id);
        $job = Job::find($ids[1]);
        if(Message::where('user_id', Auth::user()->id)->where('receiver_id', $ids[0])->exists())
        {
            $message = Message::where('user_id', Auth::user()->id)->where('receiver_id', $ids[0])->first();
        }
        else{
            $message = new Message;
            $message->user_id = Auth::user()->id;
            $message->receiver_id = $ids[0];
            $message->body = 'Hi';
            $message->status = 0;
            $message->save(); 
        }

        if(JobChat::where('job_id', $job->id)->where('chat_id', $message->id)->exists())
        {}
        else
        {
            JobChat::create([
                'job_id' => $job->id, 
                'chat_id' => $message->id
            ]);
        }
        //dd($message);
        return Redirect::to('proposal/'.$job->slug.'/'.$job->status.'#menu6-#'.$ids[2]);
    }
    /*public function jobchat($id)
    {
        $ids = explode('_', $id);
        //o -> receiver id, 1 -> job id
        $messages = Message::where('receiver_id', $ids[0])->select('id')->get();
        foreach($messages as $value)
        {
            if(JobChat::where('job_id', $ids[1])->where('chat_id', $value)->exists())
                return 1;
        }
        return 0;

    }*/
    public function getUsersjob($id)
    {
        $unreadNotifyClass  = '';
        $user_id = auth()->user()->id;
        $users = DB::select(
            DB::raw(
                "SELECT * FROM messages
                    WHERE id IN (
                        SELECT MAX(id) AS id
                FROM (
                    SELECT id, user_id AS chat_sender
                    FROM messages
                    WHERE receiver_id = :uid1 OR user_id = :uid2
                UNION ALL
                    SELECT id, receiver_id AS chat_sender
                    FROM messages
                    WHERE user_id = :uid3 OR receiver_id = :uid4 )
                    t GROUP BY chat_sender ) ORDER BY id DESC"
            ),
            ['uid1' => $user_id, 'uid2' => $user_id, 'uid3' => $user_id, 'uid4' => $user_id]
        );
        
        $json = array();
        if (!empty($users)) {
            foreach ($users as $key => $userVal) {
                $chat_user_id   = '';
                $chatshow = 0;
                if ($user_id === intval($userVal->user_id)) {
                    $chat_user_id = intval($userVal->receiver_id);
                } else {
                    $chat_user_id = intval($userVal->user_id);
                }
                

                $messages = Message::where('receiver_id', $userVal->receiver_id)->select('id')->get();
                foreach($messages as $value)
                {
                    //dd($messages, $id, $value);
                    if(JobChat::where('job_id', $id)->where('chat_id', $value->id)->exists())
                        $chatshow = 1;
                }
                
                $user = User::find($chat_user_id);
                $profile_image = !empty(User::find($chat_user_id)->profile->avater) ? User::find($chat_user_id)->profile->avater : '';
                $image = '/uploads/users/'.$chat_user_id.'/'.$profile_image;

                if (!empty($chat_user_id)) {
                    $json[$key]['id'] = $chat_user_id;
                    $json[$key]['image'] = $image;//Helper::getProfileImage($chat_user_id);
                    $json[$key]['name'] = Helper::getUserName($chat_user_id);
                    $json[$key]['tagline'] = !empty(User::find($chat_user_id)) ? User::find($chat_user_id)->profile->tagline : '';
                    $json[$key]['image_name'] = !empty(User::find($chat_user_id)) ? User::find($chat_user_id)->profile->avater :'';
                    $json[$key]['chatshow'] = $chatshow;
                }
            }
            //dd($users);
            $chatrooms = Chatroom::all();
            foreach($chatrooms as $value)
            {
                $live = Live_contest::find($value->contest_id);
                $chatshow = 0;
                if($live) {
                    $job = Job::find($live->job_id);
                    
                    if($job->id == $id)
                    $chatshow = 1;

                    if($job->user_id == $user_id)
                    {
                        $key++;
                        $json[$key]['id'] = 'c_'.$value->id;
                        $json[$key]['image'] = Helper::getProfileImage(1);
                        $json[$key]['name'] = 'chatroom '.$value->id;
                        $json[$key]['tagline'] = '';
                        $json[$key]['image_name'] = 'image.jpg';//!empty(User::find(1)) ? User::find(1)->profile->avater :'';
                        $json[$key]['chatshow'] = $chatshow;
                    }
                }
                
                if(Live_contest_participant::where('user_id', $user_id)->where('live_id', $value->contest_id)->exists())
                { 

                    $key++;
                    $json[$key]['id'] = 'c_'.$value->id;
                    $json[$key]['image'] = Helper::getProfileImage(1);
                    $json[$key]['name'] = 'chatroom '.$value->id;
                    $json[$key]['tagline'] = '';
                    $json[$key]['image_name'] = 'image.jpg';//!empty(User::find(1)) ? User::find(1)->profile->avater :'';
                    $json[$key]['chatshow'] = $chatshow;
                }
                
                
            }
            $message_status = $this->message::where('receiver_id', $user_id)->where('status', 0)->count();
            if ($message_status > 0) {
                $unreadNotifyClass = 'wt-dotnotification';
            }
            $json[$key]['status_class'] = $unreadNotifyClass;
            return response()->json($json);
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.user_not_found');
            return $json;
        }
    }
    public function getUsers()
    {
        $unreadNotifyClass  = '';
        $user_id = auth()->user()->id;
        $users = DB::select(
            DB::raw(
                "SELECT * FROM messages
                    WHERE id IN (
                        SELECT MAX(id) AS id
                FROM (
                    SELECT id, user_id AS chat_sender
                    FROM messages
                    WHERE receiver_id = :uid1 OR user_id = :uid2
                UNION ALL
                    SELECT id, receiver_id AS chat_sender
                    FROM messages
                    WHERE user_id = :uid3 OR receiver_id = :uid4 )
                    t GROUP BY chat_sender ) ORDER BY id DESC"
            ),
            ['uid1' => $user_id, 'uid2' => $user_id, 'uid3' => $user_id, 'uid4' => $user_id]
        );
        //$user = User::find(22);
        //dd($users);
        $json = array();
        if (!empty($users)) {
            foreach ($users as $key => $userVal) {
                $chat_user_id   = '';
                if ($user_id === intval($userVal->user_id)) {
                    $chat_user_id = intval($userVal->receiver_id);
                } else {
                    $chat_user_id = intval($userVal->user_id);
                }
                //dd(Helper::getProfileImage($userVal->id));
                /*$user = User::find($chat_user_id);
                $profile_image = !empty(User::find($user_id)->profile->avater) ? User::find($user_id)->profile->avater : '';
                $image = '/uploads/users/'.$user_id.'/'.$profile_image;*/
                if($chat_user_id == 21)
                {
                    $profile_image = !empty(User::find($chat_user_id)->profile->avater) ? User::find($chat_user_id)->profile->avater : '';
                    //dd(User::find($userVal->id), $chat_user_id, $users);
                    //dd(Helper::getProfileImage($userVal->id), file_exists(Helper::publicPath() . '/uploads/users/' . $chat_user_id . '/' . $profile_image), $profile_image);
                }
                if (!empty($chat_user_id)) {
                    $json[$key]['id'] = $chat_user_id;
                    $json[$key]['image'] = Helper::getProfileImage($chat_user_id);//$image;
                    $json[$key]['name'] = Helper::getUserName($chat_user_id);
                    $json[$key]['tagline'] = !empty(User::find($chat_user_id)) ? User::find($chat_user_id)->profile->tagline : '';
                    $json[$key]['image_name'] = !empty(User::find($chat_user_id)) ? User::find($chat_user_id)->profile->avater :'';
                }
            }
            $chatrooms = Chatroom::all();
            foreach($chatrooms as $value)
            {
                if(Live_contest_participant::where('user_id', $user_id)->where('live_id', $value->contest_id)->exists())
                { 
                    $key++;
                    $json[$key]['id'] = 'c_'.$value->id;
                    $json[$key]['image'] = Helper::getProfileImage(1);
                    $json[$key]['name'] = 'chatroom '.$value->id;
                    $json[$key]['tagline'] = '';
                    $json[$key]['image_name'] = 'image.jpg';//!empty(User::find(1)) ? User::find(1)->profile->avater :'';
                }
                $live = Live_contest::find($value->contest_id);
                if($live) {
                    $job = Job::find($live->job_id);
                    if($job->user_id == $user_id)
                    {
                        $key++;
                        $json[$key]['id'] = 'c_'.$value->id;
                        $json[$key]['image'] = Helper::getProfileImage(1);
                        $json[$key]['name'] = 'chatroom '.$value->id;
                        $json[$key]['tagline'] = '';
                        $json[$key]['image_name'] = 'image.jpg';//!empty(User::find(1)) ? User::find(1)->profile->avater :'';
                    }
                }
                
            }
            $message_status = $this->message::where('receiver_id', $user_id)->where('status', 0)->count();
            if ($message_status > 0) {
                $unreadNotifyClass = 'wt-dotnotification';
            }
            $json[$key]['status_class'] = $unreadNotifyClass;
            return response()->json($json);
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.user_not_found');
            return $json;
        }
    }

    /**
     * Get user messages.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserMessages(Request $request)
    {
        //dd($request->all());
        $json = array();
        $ids = explode('_', $request->sender_id);
        if($ids[0] == 'c')
        {
            //dd('chatroom');
            $user_id = Auth::user()->id;
            $chats = Chat::where('chatroom_id', $ids[1])->get();
            //dd($chats);
            foreach($chats as $key => $value)
            {
                $user = User::find($value->user_id);
                if($user->nickname)
                    $username = $user->nickname;
                else
                    $username = $user->first_name.' '.$user->last_name;
                //$value->username = $username;
                //$value->image = $this->getProfileImage($user->id);
                //set messages
                //$user = User::find($user->id);
                $profile_image = !empty(User::find($user->id)->profile->avater) ? User::find($user->id)->profile->avater : '';
                $image = '/uploads/users/'.$user->id.'/'.$profile_image;
                
                $json['messages'][$key]['is_sender'] = 'no';
                if ($value->user_id == $user_id) {
                    $json['messages'][$key]['is_sender'] = 'yes';
                }
                $json['messages'][$key]['id'] = $value->id;
                $json['messages'][$key]['name'] = $username;
                $json['messages'][$key]['user_id'] = $value->user_id;
                $json['messages'][$key]['image'] = $image;//url(Helper::getProfileImage($value->user_id, 'medium-small-'));
                $json['messages'][$key]['message'] = $value->message;
                $json['messages'][$key]['date'] =  $value->created_at->format('Y.m.d H:i:s');
                $json['messages'][$key]['read_status'] = '';

            }
        }
        else 
        {
            
            if (!empty($request['sender_id'])) {
                if (!empty($request['type']) && $request['type'] == 'admin') {
                    $user_id = $request['sender_id'];
                    $receiver_id = $request['receiver_id'];
                } else if (!empty($request['type']) && $request['type'] == 'popup') {
                    $user_id = $request['sender_id'];
                    $receiver_id = auth()->user()->id;
                } else {
                    $user_id = auth()->user()->id;
                    $receiver_id = $request['sender_id'];
                }
                $selected_user = User::find($receiver_id);
                DB::table('messages')
                    ->where('user_id', $receiver_id)
                    ->where('receiver_id', $user_id)
                    ->update(['status' => 1]);
                $messages = DB::table('messages')->select('*')
                    ->where(
                        function ($query) use ($user_id, $receiver_id) {
                            $query->where('user_id', '=', $user_id)
                                ->Where('receiver_id', '=', $receiver_id);
                        }
                    )
                    ->orWhere(
                        function ($query) use ($user_id, $receiver_id) {
                            $query->where('receiver_id', '=', $user_id)
                                ->Where('user_id', '=', $receiver_id);
                        }
                    )
                    ->get()->toArray();
                foreach ($messages as $key => $message) {
                    $message_read = '';
                    if ($message->status == 1 && $message->user_id == $user_id) {
                        $message_read = 'wt-readmessage';
                    }
                    $json['messages'][$key]['is_sender'] = 'no';
                    if ($message->user_id == $user_id) {
                        $json['messages'][$key]['is_sender'] = 'yes';
                    }
                    $profile_image = !empty(User::find($message->user_id)->profile->avater) ? User::find($message->user_id)->profile->avater : '';
                    $image = '/uploads/users/'.$message->user_id.'/'.$profile_image;
                    $json['messages'][$key]['id'] = $message->id;
                    $json['messages'][$key]['user_id'] = $message->user_id;
                    $json['messages'][$key]['image'] = Helper::getProfileImage($message->user_id, 'medium-small-');//$image;
                    $json['messages'][$key]['message'] = $message->body;
                    $json['messages'][$key]['date'] =  $message->created_at;
                    $json['messages'][$key]['read_status'] = $message_read;
                }
                $profile_image1 = !empty(User::find($receiver_id)->profile->avater) ? User::find($receiver_id)->profile->avater : '';
                $image1 = '/uploads/users/'.$receiver_id.'/'.$profile_image1;
                $profile_image2 = !empty(User::find($user_id)->profile->avater) ? User::find($user_id)->profile->avater : '';
                $image2 = '/uploads/users/'.$user_id.'/'.$profile_image2;

                if ($request['type'] == 'admin') {
                    

                    $json['conversation_users']['receiver_name'] = Helper::getUserName($receiver_id);
                    $json['conversation_users']['receiver_img'] = $image1;//Helper::getProfileImage($receiver_id);
                    $json['conversation_users']['receiver_role'] = Helper::getRoleNameByUserID($receiver_id);
                    $json['conversation_users']['sender_name'] = Helper::getUserName($user_id);
                    $json['conversation_users']['sender_img'] = $image2;//Helper::getProfileImage($user_id);
                    $json['conversation_users']['sender_role'] = Helper::getRoleNameByUserID($user_id);
                }
                $json['selected']['selected_user_name'] = Helper::getUserName($receiver_id);
                $json['selected']['selected_user_slug'] = $selected_user->slug;
                $json['selected']['selected_user_tagline'] = $selected_user->profile->tagline;
                $json['selected']['selected_user_image'] = $image1;//Helper::getProfileImage($receiver_id);
                $json['selected']['selected_user_verified'] = $selected_user->user_verified;
                
            }
            //dd($json);
        }
        return response()->json($json);
    }


    /**
     * Store messages.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messsage = $this->message->sendMessage($request);
        return response()->json($messsage);
    }

    /**
     * Get conversations
     * 
     * @return \Illuminate\Http\Response
     */
    public function getConversations (Request $request) 
    {
        if ($request->filled('keyword')) {
            $keyword = $request->query('keyword');
            $searched_users_ids = User::where('first_name', 'like', '%' . $keyword . '%')->orWhere('last_name', 'like', '%' . $keyword . '%')->pluck('id')->toarray();
            $re_create_searched_users_ids = array_values($searched_users_ids);
            $conversations = DB::table('messages')
                            ->whereIn('user_id',$re_create_searched_users_ids)
                            ->OrWhereIn('receiver_id',$re_create_searched_users_ids)
                            ->select('user_id','receiver_id')
                            ->groupBy(DB::raw('LEAST(receiver_id, user_id), GREATEST(receiver_id, user_id)'))
                            ->paginate(7);
            $pagination = $conversations->appends([
                'keyword' => $keyword,
            ]);
        } else {
            $conversations = DB::table('messages')
                            ->select('user_id','receiver_id')
                            ->groupBy(DB::raw('LEAST(receiver_id, user_id), GREATEST(receiver_id, user_id)'))
                            ->paginate(7);
        }
        //dd($conversations);
        if (file_exists(resource_path('views/extend/back-end/admin/chat/index.blade.php'))) {
            return View(
                'extend.back-end.admin.chat.index',
                compact('conversations')
            );
        } else {
            return View(
                'back-end.admin.chat.index',
                compact('conversations')
            );
        }
    }

    /**
     * Delete message
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteMessage (Request $request) 
    {
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        if (!empty($id)) {
            $this->message::where('id', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.message_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Delete message
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteConversation (Request $request) 
    {
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $ids = explode('-', $request['id']);
        $user_id = $ids[0];
        $receiver_id = $ids[1];
        // dd($user_id);
        $json = array();
        if (!empty($user_id) && !empty($receiver_id)) {
            $this->message::where(
                function ($query) use ($user_id, $receiver_id) {
                    $query->where('user_id', '=', $user_id)
                        ->Where('receiver_id', '=', $receiver_id);
                })
                ->orWhere(
                    function ($query) use ($user_id, $receiver_id) {
                        $query->where('receiver_id', '=', $user_id)
                            ->Where('user_id', '=', $receiver_id);
                    }
                )->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.message_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
}
