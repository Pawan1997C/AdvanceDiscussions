<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create(['name' => 'Laravel 5.8']);

        Channel::create(['name' => 'JQuery']);

        Channel::create(['name' => 'CSS3']);

        Channel::create(['name' => 'Python']);

        Channel::create(['name' => 'Django']);

        Channel::create(['name' => 'React Js']);

        Channel::create(['name' => 'Angular']);

        Channel::create(['name' => 'Vue Js']);
    }
}
