<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Post extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo(User::class);
        }

        public function Post() {
            return $this->belongsTo(Post::class);
        }

        public function System() {
            return $this->belongsTo(System::class);
        }

        public function Posts() {
            return $this->hasMany(Post::class);
        }

        public function Category() {
            return $this->belongsTo(Category::class);
        }

        public function Tags() {
            return $this->belongsToMany(Tag::class, 'post_tags');
        }

        public function Images() {
            return $this->belongsToMany(Image::class, 'post_images');
        }

        public function Attributes() {
            return $this->belongsToMany(Attribute::class, 'post_attributes');
        }

        public function Contributors() {
            return $this->belongsToMany(User::class, 'post_contributors');
        }

        public function Comments() {
            return $this->hasMany(PostComment::class)
                ->whereNull('post_comment_id')
                ->with('Comments')
                ->withCount('Upvotes');
        }

        public function AllComments() {
            return $this->hasMany(PostComment::class);
        }

        public function Upvotes() {
            return $this->hasMany(PostUpvote::class);
        }

        public function Reports() {
            return $this->hasMany(ReportedPost::class);
        }

        public function Collections() {
            return $this->belongsToMany(Collection::class, 'collection_posts');
        }
    }
