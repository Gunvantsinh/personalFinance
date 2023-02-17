<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Bill','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Business','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Clothing','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Education','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Food','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Fuel','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Fun','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Hospital','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Hotel','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Insurance','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Loan','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Medical','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Movie','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Other','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Personal','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Pets','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Restaurant','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Salary','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Shopping','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Transfer','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Tips','created_at'=>now(), 'updated_at'=>now()],
            ['name'=>'Transport','created_at'=>now(), 'updated_at'=>now()],
        ];
        
        Schema::enableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::disableForeignKeyConstraints();
        Category::insert($data);
    }
}
