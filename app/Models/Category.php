<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Category extends Model {
        protected $guarded = ['id'];

        public function PostCategories() {
            return $this->hasMany('App\Models\PostCategory');
        }

        public function Posts() {
            return $this->hasManyThrough('App\Models\Post', 'App\Models\PostCategory');
        }
    }
