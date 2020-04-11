<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Model\Reply;
use App\Model\Question;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return  ReplyResource::collection($question->replies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());
        $user = $question->user;
        //if ($reply->user_id !== $question->user_id) {
        $user->notify(new NewReplyNotification($reply));
        //}
        return response(['reply' => new ReplyResource($reply)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        //return $question;
        return new ReplyResource($reply);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request, Reply $reply)
    {
        // return $question;
        // $reply->body = $request->name;
        // $reply->slung = Str::slug($request->name);
        // $reply->save();
        $reply->update($request->all());
        return response('Updated', Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        return response('Deleted', Response::HTTP_MOVED_PERMANENTLY);
    }
}


// Route::post('/notifications', function () {
// });
