<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0;$i<5;$i++) {

            $visitor = new App\Visitor(['email' => Str::random(10).'@testgmail.com']);

            $question = new App\Question;
            $question->body = Str::random(50).'?';
            $question->save();

            $question->visitor()->save($visitor);

        }

    }
}
