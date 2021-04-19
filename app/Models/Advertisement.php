<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $table = 'advertisement';

    #region Relationships

    public function biddings() {
        return $this->hasMany(Bidding::class);
    }

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        $this->belongsTo(Category::class);
    }

    #endregion Relationships
}
