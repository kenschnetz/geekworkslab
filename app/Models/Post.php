<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Post extends Model {
        use SoftDeletes;

        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo(User::class);
        }

        public function Post() {
            return $this->belongsTo(Post::class);
        }

        public function ContentType() {
            return $this->belongsTo(ContentType::class);
        }

        public function ContentSubtype() {
            return $this->belongsTo(ContentSubtype::class);
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
            return $this->hasMany(PostAttribute::class)->with('Attribute');
        }

        public function Contributors() {
            return $this->belongsToMany(User::class, 'post_contributors');
        }

        public function Comments() {
            return $this->hasMany(PostComment::class)
                ->whereNull('post_comment_id')
                ->with('Comments')
                ->withCount('Comments')
                ->withCount('Upvotes')
                ->orderBy('created_at', 'desc');
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

        public function Views() {
            return $this->hasMany(PostView::class);
        }

        public function ViewCount() {
            return $this->hasMany(PostView::class)->count();
        }
    }
