<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostCategory extends Model {
        protected $fillable = ['post_id', 'category_id', 'rating'];

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }

        public function Category() {
            return $this->belongsTo('App\Models\Category');
        }
    }
