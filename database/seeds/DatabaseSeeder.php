<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
      //  App\Tag::truncate();
      //  DB::table('article_tag')->truncate();
        $tags = config('project.tags');

        foreach($tags as $slug =>$name){
          App\Tag::create([
            'name'=>$name,
            'slug'=>Str::slug($slug),
          ]);
        }
      $this->command->info('seeded:tags table');

      //variables
      $faker = app(Faker\Generator::class);
      $users = App\User::all();
      $articles = App\Article::all();
      $tags = App\Tag::all();

      //article and tag conneection
      foreach($articles as $article){
        $article->tags()->sync(
          $faker->randomElements($tags->pluck('id')->toArray(), rand(1,3))
        );
      }
      $this->command->info('seeded:article_tag table');

      //parent comments
      $articles->each(function ($article){
        $article->comments()->save(factory(App\Comment::class)->make());
        $article->comments()->save(factory(App\Comment::class)->make());
      });
      //child comments
      $articles->each(function ($article) use ($faker){
        $commentIds = App\Comment::pluck('id')->toArray();

        foreach(range(1,5) as $index){
          $article->comments()->save(
              factory(App\Comment::class)->make([
                'parent_id'=>$faker->randomElement($commentIds),
              ])
          );
        }
      });

      $this->command->info('Seeded:comments table');
    }
}
