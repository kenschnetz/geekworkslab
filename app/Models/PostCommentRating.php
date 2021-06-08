<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostCommentRating extends Model {
        protected $fillable = ['user_id', 'post_comment_id', 'rating'];

        public function User() {
            return $this->belongsTo('App\Models\User');
        }

        public function PostComment() {
            return $this->belongsTo('App\Models\PostComment');
        }
    }
