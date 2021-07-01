<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ReportedPost extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo(User::class);
        }

        public function Post() {
            return $this->belongsTo(Post::class);
        }
    }
