<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@datains.id',
            'password' => bcrypt('12345678'),
            'image' => 'image.jpg',
            'organization' => 'Datains',
            'phone' => '0821953042'
        ]);

        $admin->assignRole('admin');

        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@datains.id',
            'password' => bcrypt('12345678'),
            'image' => 'image.jpg',
            'organization' => 'Datains',
            'phone' => '0821953042'
        ]);

        $editor->assignRole('editor');

        $contributor = User::create([
            'name' => 'Contributor',
            'email' => 'contributor@datains.id',
            'password' => bcrypt('12345678'),
            'image' => 'image.jpg',
            'organization' => 'Datains',
            'phone' => '0821953042'
        ]);

        $contributor->assignRole('contributor');
    }
}
