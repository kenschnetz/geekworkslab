<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Post extends Model {
        protected $fillable = ['user_id', 'post_id', 'type', 'published'];

        public function User() {
            return $this->belongsTo('App\Models\User');
        }

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }

        public function PostRatings() {
            return $this->hasMany('App\Models\PostRating');
        }

        public function PostCategories() {
            return $this->hasMany('App\Models\PostCategory');
        }

        public function PostTags() {
            return $this->hasMany('App\Models\PostTag');
        }

        public function PostContent() {
            return $this->hasMany('App\Models\PostContent');
        }

        public function PostFields() {
            return $this->hasMany('App\Models\PostField');
        }

        public function PostComments() {
            return $this->hasMany('App\Models\PostComment');
        }
    }
