<?php

namespace Database\Seeders;

use App\Models\Mode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class ModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Cash','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Credit Card','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Debit Card','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Net Banking','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Cheque','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Google Pay','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Phonepe','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Paytm','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'AmazonPe','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'ATM','created_at'=>now(), 'updated_at'=>now()],
        ];
        
        Schema::enableForeignKeyConstraints();
        DB::table('modes')->truncate();
        Schema::disableForeignKeyConstraints();
        Mode::insert($data);
    }
}
