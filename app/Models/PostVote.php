<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostVote extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo('App\Models\User');
        }

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }
    }
