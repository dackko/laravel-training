<?php

use Illuminate\Database\Seeder;

class UsersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $types = $this->getTypes();
        foreach ($types as $type) {
            \App\Models\UserType::create($type);
        }
    }

    private function getTypes(): array
    {
        return [
            [
                'key' => 'admin',
                'name' => 'Admin',
            ],
            [
                'key' => 'project_manager',
                'name' => 'Project Manager',
            ],
            [
                'key' => 'developer',
                'name' => 'Developer',
            ],
        ];
    }
}
