<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostTag extends Model {
        protected $fillable = ['post_id', 'tag_id', 'rating'];

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }

        public function Tag() {
            return $this->belongsTo('App\Models\Tag');
        }
    }
