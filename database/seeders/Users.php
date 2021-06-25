<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class Users extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('roles')->insert([
                [
                    'name' => 'admin',
                    'description' => 'Geekworks staff'
                ],
                [
                    'name' => 'moderator' ,
                    'description' => 'Community moderators'
                ],
                [
                    'name' => 'member' ,
                    'description' => 'Community members'
                ],
                [
                    'name' => 'muted' ,
                    'description' => 'Temporarily muted community member'
                ],
                [
                    'name' => 'banned' ,
                    'description' => 'Community members who have been banned'
                ],
            ]);
            DB::table('permissions')->insert([
                [
                    'name' => 'Super Admin',
                    'description' => 'Can do anything!'
                ],
                [
                    'name' => 'Unpublish Posts',
                    'description' => 'Ability to unpublish posts'
                ],
                [
                    'name' => 'Unpublish Comments',
                    'description' => 'Ability to unpublish comments'
                ],
                [
                    'name' => 'Publish Posts',
                    'description' => 'Ability to publish posts'
                ],
                [
                    'name' => 'Upvote Posts',
                    'description' => 'Ability to upvote posts'
                ],
                [
                    'name' => 'Publish Comments',
                    'description' => 'Ability to publish comments'
                ],
                [
                    'name' => 'Upvote Comments',
                    'description' => 'Ability to upvote posts'
                ],
            ]);
            DB::table('role_permissions')->insert([
                [
                    'role_id' => 1,
                    'permission_id' => 1
                ],
                [
                    'role_id' => 2,
                    'permission_id' => 2
                ],
                [
                    'role_id' => 2,
                    'permission_id' => 3
                ],
                [
                    'role_id' => 2,
                    'permission_id' => 4
                ],
                [
                    'role_id' => 2,
                    'permission_id' => 5
                ],
                [
                    'role_id' => 2,
                    'permission_id' => 6
                ],
                [
                    'role_id' => 2,
                    'permission_id' => 7
                ],
                [
                    'role_id' => 3,
                    'permission_id' => 4
                ],
                [
                    'role_id' => 3,
                    'permission_id' => 5
                ],
                [
                    'role_id' => 3,
                    'permission_id' => 6
                ],
                [
                    'role_id' => 3,
                    'permission_id' => 7
                ],
            ]);
            DB::table('users')->insert([
                [
                    'name' => 'Ken',
                    'email' => 'ken@syntaxflow.com',
                    'password' => bcrypt('geekworksUser1!'),
                    'role_id' => 1,
                ],
                [
                    'name' => 'Chris',
                    'email' => 'leviticusx@gmail.com',
                    'password' => bcrypt('geekworksUser2!'),
                    'role_id' => 1,
                ],
                [
                    'name' => 'Jason',
                    'email' => 'jasonstever@yahoo.com',
                    'password' => bcrypt('geekworksUser3!'),
                    'role_id' => 1,
                ],
            ]);
        }
    }
