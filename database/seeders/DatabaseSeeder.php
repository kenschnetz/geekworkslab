<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run() {
            $this->call([
                Users::class,
//                ContentTypes::class,
//                Systems::class,
//                Categories::class,
//                Tags::class,
//                Attributes::class,
//                Images::class,
//                Posts::class,
//                Badges::class,
            ]);
        }
    }
