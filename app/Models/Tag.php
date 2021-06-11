<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Tag extends Model {
        protected $guarded = ['id'];

        public function Posts() {
            return $this->hasMany('App\Models\Post');
        }
    }
