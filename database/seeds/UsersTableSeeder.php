<?php

use Illuminate\Database\Seeder;
use App\User;
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
        // Start the time from now
        $time = Carbon::now();

        // Loop through users with id 1 to 5
        for ($id = 1; $id <= 5; $id++) {
            $user = User::find($id);

            if ($user) { // Check if user exists
                $user->created_at = $time; // Set created_at
                $user->updated_at = $time; // Optionally set updated_at
                $user->save(); // Save changes

                // Add 10 minutes for the next user
                $time = $time->addMinutes(10);
            }
        }
    }
}
