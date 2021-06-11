<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostCategory extends Model {
        protected $guarded = ['id'];

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }

        public function Category() {
            return $this->belongsTo('App\Models\Category');
        }
    }
