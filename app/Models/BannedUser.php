<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class BannedUser extends Model {
        protected $guarded = ['id'];

        public function User() {
            return $this->belongsTo(User::class);
        }
    }
