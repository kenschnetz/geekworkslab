<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostTag extends Model {
        protected $guarded = ['id'];

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }

        public function Tag() {
            return $this->belongsTo('App\Models\Tag');
        }
    }
