<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Badge extends Model {
        protected $guarded = ['id'];

        public function Users() {
            return $this->belongsToMany(User::class, 'user_badges');
        }
    }
