<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostComment extends Model {
        protected $fillable = ['user_id', 'post_id', 'post_comment_id', 'content'];

        public function User() {
            return $this->belongsTo('App\Models\User');
        }

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }

        public function PostComment() {
            return $this->belongsTo('App\Models\PostComment');
        }

        public function PostComments() {
            return $this->hasMany('App\Models\PostComment');
        }

        public function PostCommentRatings() {
            return $this->hasMany('App\Models\PostComment');
        }
    }
