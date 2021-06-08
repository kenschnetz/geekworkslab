<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostContent extends Model {
        protected $fillable = ['post_id', 'name', 'description', 'image_url', 'content', 'status', 'version'];

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }
    }
