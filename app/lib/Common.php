<?php

namespace App\lib;

use App\Models\Election;

class Common
{
    public static function isElectionEnded($id)
    {
        $election = Election::find($id);
        if ($election->is_active == false) {
            return false;
        } elseif ($election->is_active == true) {
            date_default_timezone_set("Asia/Dhaka");
            if (date('Y-m-d H:i:s') >= $election->start_time && date('Y-m-d H:i:s') > $election->end_time) {
                return true;
            }
        }
        return false;
    }

    public function isElectionGoingOn($id)
    {
        $election = Election::find($id);
        if ($election->is_active == false) {
            return false;
        } elseif ($election->is_active == true) {
            date_default_timezone_set("Asia/Dhaka");
            if (date('Y-m-d H:i:s') >= $election->start_time && date('Y-m-d H:i:s') < $election->end_time) {
                return true;
            }
        }
        return false;
    }
}
