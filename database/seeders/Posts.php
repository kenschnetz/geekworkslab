<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class Posts extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('posts')->insert([
                [
                    'user_id' => 1,
                    'system_id' => 1,
                    'category_id' => 1,
                    'type' => 0,
                    'published' => true,
                    'title' => 'Amulet Of Awesomeness',
                    'slug' => 'amulet-of-awesomeness',
                    'description' => 'Makes you tougher!',
                    'content' => 'Your Constitution score is 19 while you wear this amulet. It has no effect on you if your Constitution is already 19 or higher without it.',
                ],
                [
                    'user_id' => 2,
                    'system_id' => 1,
                    'category_id' => 2,
                    'type' => 0,
                    'published' => true,
                    'title' => 'Five Headed Dragon',
                    'slug' => 'five-headed-dragon',
                    'description' => 'More heads, more danger...',
                    'content' => 'The dragon can take 4 legendary actions, choosing from the options below. Only one legendary action option can be used at a time and only at the end of another creature’s turn. The dragon regains spent legendary actions at the start of its turn.
Poison Breath (Costs 2 Actions). The dragon exhales poisonous gas in a 60-foot cone. Each creature in that area must make a DC 24 Constitution saving throw, taking 19d6 poison damage on a failed save, or half as much damage on a successful one.
Fire Breath (Costs 2 Actions). The dragon exhales fire in a 90-foot cone. Each creature in that area must make a DC 24 Dexterity saving throw, taking 7d20 fire damage on a failed save, or half as much damage on a successful one.
Acid Breath (Costs 2 Actions). The dragon exhales acid in a 100-foot line that is 5 feet wide. Each creature in that line must make a DC 24 Dexterity saving throw, taking 16d8 acid damage on a failed save, or half as much damage on a successful one.
Lightning Breath (Costs 2 Actions). The dragon exhales lightning in a 100-foot line that is 5 feet wide. Each creature in that line must make a DC 24 Dexterity saving throw, taking 13d10 lightning damage on a failed save, or half as much damage on a successful one.
Cold Breath (Costs 2 Actions). The dragon exhales an icy blast in a 90-foot cone. Each creature in that area must make a DC 24 Constitution saving throw, taking 54 8d12 cold damage on a failed save, or half as much damage on a successful one.',
                ],
                [
                    'user_id' => 3,
                    'system_id' => 1,
                    'category_id' => 3,
                    'type' => 0,
                    'published' => true,
                    'title' => 'Midtown Mystery',
                    'slug' => 'midtown-mystery',
                    'description' => 'Where has everyone gone?',
                    'content' => 'A mysterious figure has visited the dreams of several strangers, summoning them all to an obscure town in the middle of nowhere. As the adventurers arrive, none of them know each other.
The town has been recently completely abandoned, with bloody signs that many were dragged into the sewers. The keep in the center of the town is inaccessible as some magic bubble prevents the adventurers from entering.
It seems that the only way to unravel this mystery is to venture into the sewers...',
                ],
                [
                    'user_id' => 1,
                    'system_id' => 1,
                    'category_id' => 4,
                    'type' => 0,
                    'published' => true,
                    'title' => 'Turn Arrows',
                    'slug' => 'turn-arrows',
                    'description' => 'Because sometimes you need to shoot something you can\'t see...',
                    'content' => 'As an expert archer, you can fire arrows that turn around objects to strike a target. The target must be within 5 feet of the object edge. Turned arrow attacks have advantage.',
                ],
                [
                    'user_id' => 2,
                    'system_id' => 1,
                    'category_id' => 5,
                    'type' => 1,
                    'published' => true,
                    'title' => 'Horrifying Hydra',
                    'slug' => 'horrifying-hydra',
                    'description' => 'Terrifying multi-headed menace',
                    'content' => null
                ],
                [
                    'user_id' => 3,
                    'system_id' => 1,
                    'category_id' => null,
                    'type' => 2,
                    'published' => true,
                    'title' => 'Inspiration needed for a rogue build!!',
                    'slug' => 'inspiration-needed-for-a-rogue-build',
                    'description' => null,
                    'content' => 'I am about to join a new campaign and would like some inspiration on which archetypes, background, etc.',
                ],
            ]);
            DB::table('post_images')->insert([
                [
                    'post_id' => 1,
                    'image_id' => 1
                ],
                [
                    'post_id' => 2,
                    'image_id' => 2
                ],
                [
                    'post_id' => 3,
                    'image_id' => 3
                ],
                [
                    'post_id' => 4,
                    'image_id' => 4
                ],
            ]);
            DB::table('post_contributors')->insert([
                [
                    'post_id' => 1,
                    'user_id' => 2
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
            DB::table('post_attributes')->insert([
                [
                    'post_id' => 1,
                    'attribute_id' => 1,
                    'value' => 'Jewelry',
                ],
                [
                    'post_id' => 1,
                    'attribute_id' => 2,
                    'value' => 'Attunement, Barbarian Class',
                ],
                [
                    'post_id' => 1,
                    'attribute_id' => 3,
                    'value' => 'Rare',
                ],
                [
                    'post_id' => 1,
                    'attribute_id' => 4,
                    'value' => 'Constitution',
                ],
            ]);
            DB::table('post_comments')->insert([
                [
                    'post_id' => 1,
                    'user_id' => 1,
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
            DB::table('post_upvotes')->insert([
                [
                    'post_id' => 1,
                    'user_id' => 1,
                ],
                [
                    'post_id' => 2,
                    'user_id' => 1,
                ],
                [
                    'post_id' => 3,
                    'user_id' => 1,
                ],
            ]);
        }
    }
