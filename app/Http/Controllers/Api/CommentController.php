<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetCommentRequest;
use App\Models\Comments;
use App\Models\Stupenka;
use App\Traits\ApiResponser;

class CommentController extends Controller
{
    use ApiResponser;

    public function getPostComments(Stupenka $post)
    {
        return $this->success($post->comments()->get());
    }

    public function setComment(SetCommentRequest $request)
    {
        $comment = new Comments();
        $comment->user_id = auth()->id();
        $comment->post_id = $request->input('post_id');
        $comment->text = $request->input('text');
        $comment->save();

        return $this->success(null, 'запись сохранена', 201);
    }
}
