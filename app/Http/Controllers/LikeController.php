<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function likeIt(Reply $reply)
    {
        // return $reply->like();
        $reply->like()->create([
            'user_id' => auth()->id()
            // 'user_id' => 1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function unLikeIt(Reply $reply)
    {
        $reply->like()->where(['user_id', auth()->id()])->first()->delete();
        // $reply->like()->where('user_id', 1)->first()->delete();
    }
}
