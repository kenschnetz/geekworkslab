<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostAttribute extends Model {
        protected $guarded = ['id'];

        public function Post() {
            return $this->belongsTo(Post::class);
        }

        public function Attribute() {
            return $this->belongsTo(Attribute::class);
        }
    }
