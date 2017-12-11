<?php

namespace App\Policies;

use App\{Comment, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function accept(User $user, Comment $comment)
    {
        // return $user->id === $comment->post->user_id;

        return $user->owns($comment->post);

        // return $user->owns($comment->post) && !$comment->answer;
    }
}
