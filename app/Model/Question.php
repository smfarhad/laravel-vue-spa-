<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Str;
// use App\Reply;
// use App\Category;
class Question extends Model
{
    //protected $fillable = ['title','slung', 'body', 'category_id', 'user_id'];

    //protected $guarded = [];
    protected $fillable = ['title', 'slung', 'body', 'category_id', 'user_id'];

    protected $with = ['replies'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($question) {
            $question->slung = Str::slug($question->title);
        });
    }

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
        return $this->hasMany(Reply::class)->latest();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getPathAttribute()
    {
        return "/question/$this->slung";
    }
}
