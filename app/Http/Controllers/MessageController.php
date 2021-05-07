<?php

namespace App\Http\Controllers;

use App\Http\Requests\Messages\StoreMessageRequest;
use App\Http\Resources\ConversationListItemResource;
use App\Http\Resources\MessageResource;
use App\Mail\NewMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use function GuzzleHttp\Promise\queue;

class MessageController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index() {
		$conversations = Message::conversations()->get();

		return ConversationListItemResource::collection($conversations);
	}

	public function show($user_id) {
		$messages = Message::betweenAuthUserandUser($user_id)
			->with('sender:id,name')
			->with('receiver:id,name')
			->get();

		return MessageResource::collection($messages);
	}

	public function store(StoreMessageRequest $request) {
		$message = Message::create([
			'content' => $request->content,
			'receiver_id' => $request->receiver_id,
			'sender_id' => Auth::user()->id,
		]);

		$receiver = User::find($request->receiver_id);

		Mail::to($receiver->email)
			->queue(new NewMessage($receiver));

		return response()->json([
			'message' => new MessageResource($message)
		]);
	}
}
