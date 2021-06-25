<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Image extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo('App\Models\User');
        }

        public function Posts() {
            return $this->belongsToMany(Post::class, 'post_images');
        }
    }
