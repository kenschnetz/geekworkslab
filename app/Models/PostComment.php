<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class PostComment extends Model {
        use SoftDeletes;

        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo(User::class);
        }

        public function Post() {
            return $this->belongsTo(Post::class);
        }

        public function Comment() {
            return $this->belongsTo(PostComment::class);
        }

        public function Comments() {
            return $this->hasMany(PostComment::class)->with('Comments');
        }

        public function Replies() {
            return $this->hasMany(PostComment::class)->with('Replies');
        }

        public function Upvotes() {
            return $this->hasMany(PostCommentUpvote::class);
        }
    }
