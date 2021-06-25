<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class System extends Model {
        protected $guarded = ['id'];

        public function Posts() {
            return $this->hasMany(Post::class);
        }
    }
