<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ReportedPostComment extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo(User::class);
        }

        public function Comment() {
            return $this->belongsTo(PostComment::class);
        }
    }
