<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class DatabaseSeeder extends Seeder {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run() {
            DB::table('users')->insert([
                [
                    'name' => 'Ken',
                    'email' => 'ken@syntaxflow.com',
                    'password' => bcrypt('geekworksUser1!')
                ],
                [
                    'name' => 'Chris',
                    'email' => 'leviticusx@gmail.com',
                    'password' => bcrypt('geekworksUser2!')
                ],
                [
                    'name' => 'Jason',
                    'email' => 'jasonstever@yahoo.com',
                    'password' => bcrypt('geekworksUser3!')
                ],
            ]);
            DB::table('categories')->insert([
                [
                    'name' => 'Items',
                    'description' => 'RPG items'
                ],
                [
                    'name' => 'Monsters',
                    'description' => 'RPG monsters'
                ],
                [
                    'name' => 'Hooks',
                    'description' => 'RPG story hooks'
                ],
                [
                    'name' => 'Abilities',
                    'description' => 'RPG abilities such as spells, traits, etc.'
                ],
                [
                    'name' => 'Art',
                    'description' => 'RPG art'
                ],
            ]);
            DB::table('tags')->insert([
                [
                    'name' => 'Jewelry',
                    'description' => 'Personal ornaments such as rings, necklaces, bracelets, etc.'
                ],
                [
                    'name' => 'Attuned',
                    'description' => ''
                ],
                [
                    'name' => 'Rare',
                    'description' => ''
                ],
                [
                    'name' => 'Constitution',
                    'description' => ''
                ],
            ]);
            DB::table('posts')->insert([
                [
                    'user_id' => 1,
                    'type' => 0,
                    'published' => 1,
                ],
                [
                    'user_id' => 1,
                    'type' => 0,
                    'published' => 1,
                ],
                [
                    'user_id' => 1,
                    'type' => 0,
                    'published' => 1,
                ],
                [
                    'user_id' => 1,
                    'type' => 0,
                    'published' => 1,
                ],
                [
                    'user_id' => 1,
                    'type' => 0,
                    'published' => 1,
                ],
            ]);
            DB::table('post_metas')->insert([
                [
                    'post_id' => 1,
                    'name' => 'Amulet of Awesomeness',
                    'description' => 'Makes you tougher...',
                    'image_url' => '/storage/post-images/amulet-of-awesomeness.jpeg',
                    'content' => 'Your Constitution score is 19 while you wear this amulet. It has no effect on you if your Constitution is already 19 or higher without it.',
                    'status' => 1,
                    'version' => 1
                ],
                [
                    'post_id' => 1,
                    'name' => 'Amulet Of Awesomeness',
                    'description' => 'Makes you tougher!',
                    'image_url' => '/storage/post-images/amulet-of-awesomeness.jpeg',
                    'content' => 'Your Constitution score is 19 while you wear this amulet. It has no effect on you if your Constitution is already 19 or higher without it.',
                    'status' => 1,
                    'version' => 2
                ],
                [
                    'post_id' => 2,
                    'name' => 'Five Headed Dragon',
                    'description' => 'More heads, more danger...',
                    'image_url' => '/storage/post-images/5-headed-dragon.jpeg',
                    'content' => 'The dragon can take 4 legendary actions, choosing from the options below. Only one legendary action option can be used at a time and only at the end of another creature’s turn. The dragon regains spent legendary actions at the start of its turn.
Poison Breath (Costs 2 Actions). The dragon exhales poisonous gas in a 60-foot cone. Each creature in that area must make a DC 24 Constitution saving throw, taking 19d6 poison damage on a failed save, or half as much damage on a successful one.
Fire Breath (Costs 2 Actions). The dragon exhales fire in a 90-foot cone. Each creature in that area must make a DC 24 Dexterity saving throw, taking 7d20 fire damage on a failed save, or half as much damage on a successful one.
Acid Breath (Costs 2 Actions). The dragon exhales acid in a 100-foot line that is 5 feet wide. Each creature in that line must make a DC 24 Dexterity saving throw, taking 16d8 acid damage on a failed save, or half as much damage on a successful one.
Lightning Breath (Costs 2 Actions). The dragon exhales lightning in a 100-foot line that is 5 feet wide. Each creature in that line must make a DC 24 Dexterity saving throw, taking 13d10 lightning damage on a failed save, or half as much damage on a successful one.
Cold Breath (Costs 2 Actions). The dragon exhales an icy blast in a 90-foot cone. Each creature in that area must make a DC 24 Constitution saving throw, taking 54 8d12 cold damage on a failed save, or half as much damage on a successful one.',
                    'status' => 1,
                    'version' => 1
                ],
                [
                    'post_id' => 3,
                    'name' => 'Midtown Mystery',
                    'description' => 'Where has everyone gone?',
                    'image_url' => '/storage/post-images/midtown-mystery.jpeg',
                    'content' => 'A mysterious figure has visited the dreams of several strangers, summoning them all to an obscure town in the middle of nowhere. As the adventurers arrive, none of them know each other.
The town has been recently completely abandoned, with bloody signs that many were dragged into the sewers. The keep in the center of the town is inaccessible as some magic bubble prevents the adventurers from entering.
It seems that the only way to unravel this mystery is to venture into the sewers...',
                    'status' => 1,
                    'version' => 1
                ],
                [
                    'post_id' => 4,
                    'name' => 'Turn Arrows',
                    'description' => 'Because sometimes, you need to shoot something you can\'t see',
                    'image_url' => '/storage/post-images/default-placeholder.png',
                    'content' => 'As an expert archer, you can fire arrows that turn around objects to strike a target. The target must be within 5 feet of the object edge. Turned arrow attacks have advantage.',
                    'status' => 1,
                    'version' => 1
                ],
                [
                    'post_id' => 5,
                    'name' => 'Hydra',
                    'description' => 'Terrifying multi-headed menace',
                    'image_url' => '/storage/post-images/hydra.jpeg',
                    'content' => '',
                    'status' => 1,
                    'version' => 1
                ],
            ]);
            DB::table('post_fields')->insert([
                [
                    'post_meta_id' => 1,
                    'name' => 'Item type',
                    'value' => 'jewelry',
                ],
                [
                    'post_meta_id' => 1,
                    'name' => 'Modifies',
                    'value' => 'constitution',
                ],
                [
                    'post_meta_id' => 1,
                    'name' => 'Rarity',
                    'value' => 'rare',
                ],
                [
                    'post_meta_id' => 1,
                    'name' => 'Requires attunement',
                    'value' => 'yes',
                ],
                [
                    'post_meta_id' => 2,
                    'name' => 'Item type',
                    'value' => 'Jewelry',
                ],
                [
                    'post_meta_id' => 2,
                    'name' => 'Modifies',
                    'value' => 'Constitution',
                ],
                [
                    'post_meta_id' => 2,
                    'name' => 'Rarity',
                    'value' => 'Rare',
                ],
                [
                    'post_meta_id' => 2,
                    'name' => 'Requires attunement',
                    'value' => 'Yes',
                ],
                [
                    'post_meta_id' => 3,
                    'name' => 'Armor Class',
                    'value' => '24 (natural armor)',
                ],
                [
                    'post_meta_id' => 4,
                    'name' => 'Setting',
                    'value' => 'Mystery',
                ],
            ]);
            DB::table('post_votes')->insert([
                [
                    'user_id' => 1,
                    'post_id' => 1,
                    'vote' => true,
                ],
                [
                    'user_id' => 2,
                    'post_id' => 1,
                    'vote' => true,
                ],
                [
                    'user_id' => 3,
                    'post_id' => 1,
                    'vote' => false,
                ],
            ]);
            DB::table('post_categories')->insert([
                [
                    'post_id' => 1,
                    'category_id' => 1,
                ],
                [
                    'post_id' => 2,
                    'category_id' => 2,
                ],
                [
                    'post_id' => 3,
                    'category_id' => 3,
                ],
                [
                    'post_id' => 4,
                    'category_id' => 4,
                ],
                [
                    'post_id' => 5,
                    'category_id' => 5,
                ],
            ]);
            DB::table('post_tags')->insert([
                [
                    'post_id' => 1,
                    'tag_id' => 1,
                ],
                [
                    'post_id' => 1,
                    'tag_id' => 2,
                ],
                [
                    'post_id' => 1,
                    'tag_id' => 3,
                ],
                [
                    'post_id' => 1,
                    'tag_id' => 4,
                ],
            ]);
            DB::table('post_comments')->insert([
                [
                    'user_id' => 1,
                    'post_id' => 1,
                    'post_comment_id' => null,
                    'content' => 'This is cool!',
                ],
                [
                    'user_id' => 3,
                    'post_id' => 1,
                    'post_comment_id' => 1,
                    'content' => 'I agree',
                ],
                [
                    'user_id' => 2,
                    'post_id' => 1,
                    'post_comment_id' => 2,
                    'content' => 'I\'m not so sure...',
                ],
                [
                    'user_id' => 1,
                    'post_id' => 1,
                    'post_comment_id' => 3,
                    'content' => 'How come?',
                ],
                [
                    'user_id' => 2,
                    'post_id' => 1,
                    'post_comment_id' => 4,
                    'content' => 'I think it\'s a little too simplistic.',
                ],
                [
                    'user_id' => 3,
                    'post_id' => 1,
                    'post_comment_id' => 3,
                    'content' => 'It\'s a good start though',
                ],
                [
                    'user_id' => 2,
                    'post_id' => 1,
                    'post_comment_id' => null,
                    'content' => 'I think it needs more of a description, but this is an interesting start for sure!',
                ],
            ]);
        }
    }
