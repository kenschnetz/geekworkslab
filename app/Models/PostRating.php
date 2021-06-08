<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostRating extends Model {
        protected $fillable = ['user_id', 'post_id', 'rating'];

        public function User() {
            return $this->belongsTo('App\Models\User');
        }

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }
    }
