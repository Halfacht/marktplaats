<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

    #region Relationships

    public function user() {
        return $this->belongsTo(User::class);
    }

    #endregion Relationships
}
