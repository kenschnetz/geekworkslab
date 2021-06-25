<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostCommentUpvote extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo(User::class);
        }

        public function PostComment() {
            return $this->belongsTo(PostComment::class);
        }
    }
