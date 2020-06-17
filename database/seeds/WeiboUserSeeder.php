<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class WeiboUserSeeder extends Seeder
{
    public function run()
    {
        $users = factory(User::class, 50)->create();
        $user = User::find(1);
        $user->name = 'chaos';
        $user->email = 'chaos@gmail.com';
        $user->is_admin = true;
        $user->save();
    }
}
