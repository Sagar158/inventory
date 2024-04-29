<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Products;
use App\Models\UserType;
use App\Models\HealthCare;
use App\Models\Appointments;
use App\Models\Specializations;
use App\Models\ContactInformation;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static $gender = array('male' => 'Male', 'female' => 'Female', 'other' => 'Other');
    public static $type = array('visit' => 'Visit', 'recording' => 'Recording');

    public static $status = ['active' => 'Active', 'inactive' => 'Inactive'];

    public static $weekdays = array('monday' => 'Monday', 'tuesday' => 'Tuesday', 'wednesday' => 'Wednesday', 'thursday' => 'Thursday', 'friday' => 'Friday','saturday' => 'Saturday','sunday' => 'Sunday');

    public static function checkUserPermission($permissionName)
    {
        $permissions = self::userPermissions();
        return ($permissions->{$permissionName} == 1) ? true : false;
    }

    public static function userPermissions()
    {
        $userTypeId = auth()->user()->user_type_id;
        $permissions = UserType::select('permissions')->where('id', $userTypeId)->first()->permissions;

        return json_decode($permissions);
    }
    public static function fetchUserType()
    {
        return UserType::select('id','name')->pluck('name','id')->toArray();
    }

    public static function fetchPatients()
    {
        $users = User::where('user_type_id', 3)->get(['id', 'first_name', 'last_name']);

        $patients = $users->mapWithKeys(function ($user) {
            return [$user->id => $user->fullname .'(P-'.$user->id.')'];
        });
        return $patients->toArray();
    }

    public static function imageUpload($file, $existingFile = '')
    {
        $path = $file->store('public/uploads');
        return Storage::url($path);
    }

    public static function generateUniqueKey()
    {
        do {
            $randomNumber = mt_rand(100000, 999999);
            $uniqueKey = 'P-' . $randomNumber;
            $existingRequest = Products::where('product_number', $uniqueKey)->first();

            if (!$existingRequest)
                return $uniqueKey;
        } while (true);
    }

    public static function information()
    {
        return ContactInformation::first();
    }

}
?>
