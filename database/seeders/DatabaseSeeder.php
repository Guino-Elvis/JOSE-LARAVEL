<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        File::deleteDirectory('public/storage/galery');
       
        File::makeDirectory('public/storage/galery');

        Storage::deleteDirectory('galery');
      

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
        ]);

        $this->call(CategorySeeder::class);
        $this->call(ProductoSeeder::class);
    }
}
