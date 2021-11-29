<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Carbon;

    class User extends Authenticatable {
        use HasFactory, Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name',
            'email',
            'terms_accepted',
            'terms_accepted_date',
            'role_id',
            'unread_global_messages',
            'password',
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'email',
            'password',
            'remember_token',
        ];

        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

        public function Muted() {
            return $this->hasOne(MutedUser::class)->where('expiration', '>', Carbon::now())->exists();
        }

        public function Banned() {
            return $this->hasOne(BannedUser::class)->exists();
        }

        public function Role() {
            return $this->belongsTo(Role::class)->with('Permissions');
        }

        public function Images() {
            return $this->hasMany(Image::class);
        }

        public function Posts() {
            return $this->hasMany(Post::class);
        }

        public function Contributions() {
            return $this->belongsToMany(Post::class, 'post_contributors');
        }

        public function Comments() {
            return $this->hasMany(PostComment::class);
        }

        public function PostUpvotes() {
            return $this->hasMany(PostUpvote::class);
        }

        public function CommentUpvotes() {
            return $this->hasMany(PostCommentUpvote::class);
        }

        public function ReportedPosts() {
            return $this->hasMany(ReportedPost::class);
        }

        public function ReportedComments() {
            return $this->hasMany(ReportedPostComment::class);
        }

        public function Collections() {
            return $this->hasMany(Collection::class);
        }

        public function EarnedBadges() {
            return $this->hasMany(UserBadge::class)->where('earned', true)->with('Badge');
        }

        public function InProgressBadges() {
            return $this->hasMany(UserBadge::class)->where('earned', false)->with('Badge');
        }

        public function Messages() {
            return $this->hasMany(PrivateMessage::class);
        }
    }
