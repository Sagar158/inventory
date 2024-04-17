<?php
namespace App\Helpers;

use App\Models\Appointments;
use App\Models\User;
use App\Models\UserType;
use App\Models\HealthCare;
use App\Models\Specializations;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static $gender = array('male' => 'Male', 'female' => 'Female', 'other' => 'Other');
    public static $type = array('visit' => 'Visit', 'recording' => 'Recording');

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

    public static function fetchSpecializations()
    {
        return Specializations::select('id','name')->pluck('name','id')->toArray();
    }
    public static function fetchHealthCare()
    {
        return HealthCare::select('id','name')->pluck('name','id')->toArray();
    }

    public static function imageUpload($file, $existingFile = '')
    {
        $path = $file->store('public/uploads');
        return Storage::url($path);
    }

    public static function fetchHealthCareCenters()
    {
        return HealthCare::select('id','name')->get();
    }
    public static function generateUniqueKey($model)
    {
        do {
            $randomNumber = mt_rand(100000, 999999);
            $uniqueKey = 'AP-' . $randomNumber;
            $existingRequest = Appointments::where('appointment_number', $uniqueKey)->first();

            if (!$existingRequest)
                return $uniqueKey;
        } while (true);
    }

    public static function fetchCompletedAppointments()
    {
        return Appointments::where('status','completed')->where('type','recording')->pluck('appointment_number','id')->toArray();
    }


}
?>
