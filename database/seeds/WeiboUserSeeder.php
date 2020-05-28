<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class WeiboUserSeeder extends Seeder
{
    public function run()
    {
        $users = factory(User::class, 50)->create();
    }
}
