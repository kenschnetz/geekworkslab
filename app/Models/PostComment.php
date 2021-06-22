<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostComment extends Model {
        protected $guarded = ['id'];

	    public function User() {
            return $this->belongsTo('App\Models\User');
        }

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }

        public function PostComment() {
            return $this->belongsTo('App\Models\PostComment')->with('User');
        }

        public function PostComments() {
            return $this->hasMany('App\Models\PostComment')->with('User', 'PostComments', 'PostComment');
        }

        public function PostCommentRatings() {
            return $this->hasMany('App\Models\PostComment');
        }
    }
