<?php

namespace App\Models;

use App\Builders\MessageBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

	protected $fillable = ['receiver_id', 'sender_id', 'content'];

    #region Relationships

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

	public function user() {
		return $this->belongsTo(User::class, 'user_id');
	}

    #endregion Relationships

    public function newEloquentBuilder($query)
    {
        return new MessageBuilder($query);
    }
}
