<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class ContentTypes extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('content_types')->insert([
                [
                    'name' => 'Standard',
                    'description' => 'Standard content post',
                ],
                [
                    'name' => 'Art',
                    'description' => 'Art only post',
                ],
                [
                    'name' => 'Forum',
                    'description' => 'Post within the forum',
                ],
            ]);
            DB::table('content_subtypes')->insert([
                [
                    'name' => 'Original',
                    'description' => 'This is an original post',
                ],
                [
                    'name' => 'Clone',
                    'description' => 'This is a standard post that is a clone of an Art post. This allows content authors to use unlocked Art for their posts.',
                ],
                [
                    'name' => 'Conversion',
                    'description' => 'This is a conversion of an original, standard post',
                ],
                [
                    'name' => 'Contribution',
                    'description' => 'This is an invisible copy of a standard post with recommended edits for the Author to review and incorporate or discard.',
                ],
            ]);
        }
    }
