<?php

    namespace App\Jobs;

    use App\Models\User as UserModel;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Queue\SerializesModels;

    class GlobalMessengerAlerts implements ShouldQueue {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        public $author_user_id;

        /**
         * Create a new job instance.
         *
         * @return void
         */
        public function __construct($author_user_id) {
            $this->connection = 'redis';
            $this->queue = 'global_messenger_alerts';
            $this->author_user_id = $author_user_id;
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle() {
            UserModel::where('id', '!=', $this->author_user_id)->increment('unread_global_messages');
        }
    }
