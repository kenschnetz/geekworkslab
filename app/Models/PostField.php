<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PostField extends Model {
        protected $fillable = ['post_id', 'name', 'description', 'key', 'type', 'string_value', 'integer_value', 'boolean_value', 'timestamp_value'];

        public function Post() {
            return $this->belongsTo('App\Models\Post');
        }
    }
