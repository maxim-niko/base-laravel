<?php

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        factory(\App\Models\User::class, 10)->create()->each(function (User $user) {
            factory(\App\Models\Article::class, random_int(1,10))->create(['user_id' => $user->id])->each(function (\App\Models\Article $article) use ($user) {
                factory(\App\Models\Comment::class, random_int(1,10))->create(['user_id' => $user, 'article_id' => $article->id]);
            });
        });

        $this->enableForeignKeys();
    }
}
