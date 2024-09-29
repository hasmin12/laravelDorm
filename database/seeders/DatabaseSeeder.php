<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,
            MaintenanceListSeeder::class,

        ]);
        \App\Models\User::factory(40)->create()->each(function($user) {
            $user->assignRole('user');
        });
        \App\Models\UserProfile::factory(43)->create();

        \App\Models\DormitoryRoom::factory()->count(10)->create();

        // \App\Models\DormitoryBed::factory()->count(20)->create();

        // \App\Models\HostelRoom::factory()->count(10)->create();
        \App\Models\Reservation::factory()->count(50)->create();
        \App\Models\Announcement::factory()->count(10)->create();
        \App\Models\Payment::factory()->count(50)->create();
        \App\Models\MaintenanceRequest::factory()->count(10)->create();
        \App\Models\LostAndFound::factory()->count(10)->create();
        \App\Models\Violation::factory()->count(10)->create();
        \App\Models\Visitor::factory()->count(10)->create();
        \App\Models\Log::factory()->count(10)->create();
        \App\Models\Complaint::factory()->count(10)->create();
        \App\Models\LaundrySchedule::factory()->count(10)->create();
        \App\Models\HostelRoomImage::factory()->count(10)->create();
        \App\Models\HostelImage::factory()->count(20)->create();
        \App\Models\SleepLog::factory()->count(50)->create();
        \App\Models\Notification::factory()->count(50)->create();
        \App\Models\HostelRoomRating::factory()->count(50)->create();


    }
}
