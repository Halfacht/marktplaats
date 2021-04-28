<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $table = 'advertisement';

	protected $fillable = ['title', 'content', 'price', 'category_id', 'sort_date', 'user_id'];

	protected $with = ['category', 'owner'];

    #region Relationships

    public function biddings() {
        return $this->hasMany(Bidding::class)->orderByDesc('created_at');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'name', 'postcode_id']);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    #endregion Relationships
}
