<?php

namespace App\Libraries;

use App\User;
use Carbon\Carbon;
class CommonFunction {

    /**
     * @param Carbon|string $updated_at
     * @param string $updated_by
     * @return string
     * @internal param $Users->id /string $updated_by
     */
    public static function showAuditLog($updated_at = '', $updated_by = '') {
        $update_was = 'Unknown';
        if ($updated_at && $updated_at > '0') {
            $update_was = Carbon::createFromFormat('Y-m-d H:i:s', $updated_at)->diffForHumans();
        }

        $user_name = 'Unknown';
        if ($updated_by) {
            $name = User::where('id', $updated_by)->first();
            if ($name) {
                $user_name = $name->user_full_name;
            }
        }
        return '<span class="help-block">Last updated : <i>' . $update_was . '</i> by <b>' . $user_name . '</b></span>';
    }



    /*     * ****************************End of Class***************************** */
}
