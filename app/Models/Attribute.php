<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Attribute extends Model {
        protected $guarded = ['id'];
        public $timestamps = false;

        public function Posts() {
            return $this->belongsToMany(Post::class, 'post_attributes');
        }

        public function PostAttributes() {
            return $this->hasMany(PostAttribute::class);
        }
    }
