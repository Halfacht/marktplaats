<?php

namespace App\Http\Controllers;

use App\Http\Requests\Messages\StoreMessageRequest;
use App\Http\Resources\ConversationListItemResource;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

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

		return response()->json([
			'message' => new MessageResource($message)
		]);
	}
}
