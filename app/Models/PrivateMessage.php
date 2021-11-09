<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PrivateMessage extends Model {
        protected $guarded = ['id'];
        protected $attributes = [
            'user_id' => null,
            'recipient_id' => null,
            'content' => null,
            'read' => false,
        ];

        public function User() {
            return $this->belongsTo(User::class);
        }

        public function Recipient() {
            return $this->belongsTo(User::class, 'recipient_id');
        }
    }
