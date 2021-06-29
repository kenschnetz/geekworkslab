<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ContentType extends Model {
        protected $guarded = ['id'];

        public function Posts() {
            return $this->hasMany(Post::class);
        }
    }
