<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Post extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo('App\Models\User');
        }

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }

        public function PostVotes() {
            return $this->hasMany('App\Models\PostVote');
        }

        public function PostCategories() {
            return $this->hasMany('App\Models\PostCategory')->with('Category');
        }

        public function PostTags() {
            return $this->hasMany('App\Models\PostTag')->with('Tag');
        }

        public function PostMetas() {
            return $this->hasMany('App\Models\PostMeta');
        }

        public function PostComments() {
            return $this->hasMany('App\Models\PostComment')->whereNull('post_comment_id')->with('User', 'PostComments');
        }
    }
