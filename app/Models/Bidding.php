<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

	protected $fillable = ['amount', 'user_id', 'advertisement_id'];

	protected $with = ['user'];

    #region Relationships

    public function user() {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    #endregion Relationships
}
