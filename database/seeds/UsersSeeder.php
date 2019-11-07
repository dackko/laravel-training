<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        factory(User::class, null)->create([
            'type_id' => \App\Models\UserType::ADMIN,
            'email' => 'admin@jira-clone.local',
        ]);
        factory(User::class, 100)->create();
    }
}
