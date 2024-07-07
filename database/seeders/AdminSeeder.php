<?php
/**
 * Class AdminSeeder.
 *
 
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class AdminSeeder
 */
class AdminSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                //Admin
                [
                    'first_name' => 'chris',
                    'last_name' => 'evans',
                    'slug' => 'chris-evans',
                    'email' => 'admin.worketic@yopmail.com',
                    'password' => bcrypt('google'),
                    'location_id' => 1,
                    'user_verified' => 1,
                    'badge_id' => null,
                    'expiry_date' => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
