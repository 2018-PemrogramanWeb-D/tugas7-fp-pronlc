<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'title' => str_random(10),
            'body' => str_random(255),
            'id_user' => 1,
            'upvote'	=> rand()%100,
            'downvote'	=>	rand()%100,
            'view'	=>	rand()%1000,
        ]);
    }
}
