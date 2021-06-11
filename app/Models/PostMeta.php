<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostMeta extends Model {
        protected $guarded = ['id'];

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }

        public function PostFields() {
            return $this->hasMany('App\Models\PostField');
        }
    }
