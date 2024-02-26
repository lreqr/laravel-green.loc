<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\GreenListing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(5)->create();

        //User::factory() - создают тестовые поля
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => '123456',
        ]);


        //GreenListing::factory(6) - создает 6 постов
        //'user_id' - имя поля
        // $user->id - заранее созданое поле установить отношение между пользователями и их записями
         GreenListing::factory(6)->create([
             'user_id' => $user->id,
         ]);

    }
}
