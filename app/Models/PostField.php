<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostField extends Model {
        protected $guarded = ['id'];

        public function PostMeta() {
            return $this->belongsTo('App\Models\PostMeta');
        }
    }
