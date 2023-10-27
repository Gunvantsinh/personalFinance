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
        // $data = [
        //     ['name' => 'Bank of Baroda', 'is_default' => '1', 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'SBI', 'is_default' => '0', 'created_at' => now(), 'updated_at' => now()],
        // ];
        //Account::insert($data);
        $this->call([
            CategorySeeder::class,
            ModeSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
