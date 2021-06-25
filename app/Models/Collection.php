<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Collection extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo(User::class);
        }

        public function Posts() {
            return $this->belongsToMany(Post::class, 'collection_posts');
        }
    }
