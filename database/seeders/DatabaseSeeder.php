<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\GetPercent;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['login' => 'admin'], [
            'email' => 'admin@gmail.com',
            'login' => 'admin',
            'password' => bcrypt('12345678'),
        ]);
        $userDriver1=User::firstOrCreate(['login' => 'driver1'], [
            'email' => 'driver1@gmail.com',
            'login' => 'driver1',
            'password' => bcrypt('driver12'),
        ]);
        Driver::firstOrCreate(['user_id'=>$userDriver1->id],[
            'user_id'=>$userDriver1->id,
            'first_name'=>'fd1',
            'last_name'=>'ld1',
            'balance'=>100000
        ]);
        $userDriver2=User::firstOrCreate(['login' => 'driver23'], [
            'email' => 'driver2@gmail.com',
            'login' => 'driver2',
            'password' => bcrypt('driver23'),
        ]);
        Driver::firstOrCreate(['user_id'=>$userDriver2->id],[
            'user_id'=>$userDriver2->id,
            'first_name'=>'fd2',
            'last_name'=>'ld2',
            'balance'=>100000
        ]);
        GetPercent::firstOrCreate(['percent' => 10], [
            'user_id' => User::where('login', 'admin')->first()->id,
            'percent' => 10,
        ]);
        $this->call([
            OrderSeeder::class,
        ]);
    }
}
