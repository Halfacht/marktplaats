<?php

namespace App\Models;

use App\Builders\MessageBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    #region Relationships

    public function sender() {
        return $this->belongsTo(User::class, 'from');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'to');
    }

    #endregion Relationships

    public function newEloquentBuilder($query)
    {
        return new MessageBuilder($query);
    }
}
