<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting migration of photos from storage to public/uploads...\n";

// Ensure directories exist
$publicVehiclePhotos = public_path('uploads/vehicle_photos');
$publicProfilePhotos = public_path('uploads/profile_photos');

if (!File::exists($publicVehiclePhotos)) {
    File::makeDirectory($publicVehiclePhotos, 0777, true);
    echo "Created directory: {$publicVehiclePhotos}\n";
} else {
    @chmod($publicVehiclePhotos, 0777);
}
if (!File::exists($publicProfilePhotos)) {
    File::makeDirectory($publicProfilePhotos, 0777, true);
    echo "Created directory: {$publicProfilePhotos}\n";
} else {
    @chmod($publicProfilePhotos, 0777);
}

// 1. Migrate vehicle photos
$vehicleChecks = DB::table('vehicle_checks')->whereNotNull('vehicle_photo')->get();
$migratedVehicle = 0;

foreach ($vehicleChecks as $check) {
    if (str_starts_with($check->vehicle_photo, 'vehicle_photos/')) {
        $oldPath = storage_path('app/public/' . $check->vehicle_photo);
        $newPathRelative = 'uploads/' . $check->vehicle_photo;
        $newPathAbsolute = public_path($newPathRelative);

        if (File::exists($oldPath)) {
            File::copy($oldPath, $newPathAbsolute);
            
            DB::table('vehicle_checks')
                ->where('id', $check->id)
                ->update(['vehicle_photo' => $newPathRelative]);
                
            $migratedVehicle++;
        }
    }
}
echo "Migrated {$migratedVehicle} vehicle photos.\n";

// 2. Migrate profile photos
$users = DB::table('users')->whereNotNull('profile_photo')->get();
$migratedProfile = 0;

foreach ($users as $user) {
    if (str_starts_with($user->profile_photo, 'profile_photos/')) {
        $oldPath = storage_path('app/public/' . $user->profile_photo);
        $newPathRelative = 'uploads/' . $user->profile_photo;
        $newPathAbsolute = public_path($newPathRelative);

        if (File::exists($oldPath)) {
            File::copy($oldPath, $newPathAbsolute);
            
            DB::table('users')
                ->where('id', $user->id)
                ->update(['profile_photo' => $newPathRelative]);
                
            $migratedProfile++;
        }
    }
}
echo "Migrated {$migratedProfile} profile photos.\n";

echo "\nMigration complete! You can now safely run this script on the live server as well by uploading it and running `php sync_photos.php`.\n";
