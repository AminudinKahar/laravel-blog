<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh the database?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');
        }
        // \App\Models\User::factory(10)->create();
        $this->call([
            UsersTableSeeder::class, 
            BlogPostsTableSeeder::class, 
            CommentssTableSeeder::class
        ]);

        // test total users created in table
        // dd($users->count());

        

    }
    
}
