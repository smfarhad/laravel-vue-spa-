<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

// use App\Reply;
// use App\Category;
class Question extends Model
{
    //protected $fillable = ['title','slung', 'body', 'category_id', 'user_id'];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slung';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getPathAttribute()
    {
        return asset("api/question/$this->slung");
    }
}
