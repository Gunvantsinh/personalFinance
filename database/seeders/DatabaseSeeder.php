<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('test@123'),
        ]);
        // $account = Account::create([
        //     'name' => 'Cash',
        // ]);
        // $account = Account::create([
        //     'name' => 'Online',
        // ]);
        $this->call([
            CategorySeeder::class,
            ModeSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
