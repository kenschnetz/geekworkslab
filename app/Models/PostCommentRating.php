<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostCommentRating extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo('App\Models\User');
        }

        public function PostComment() {
            return $this->belongsTo('App\Models\PostComment');
        }
    }
