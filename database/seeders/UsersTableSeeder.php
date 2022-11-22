<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'employee_id' => '0202240',
                'name'      => 'Samuel Adriel Romaito Manurung',
                'email'     => 'samuel@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthMaster',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202261',
                'name'      => 'Teguh Dana Prayuda',
                'email'     => 'teguhdana@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => '0202232',
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202232',
                'name'      => 'Anggi Saputra Edwarsa Siregar',
                'email'     => 'anggisaputra@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0201826',
                'name'      => 'Cut Amalia',
                'email'     => 'cutamalia@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthCRO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
