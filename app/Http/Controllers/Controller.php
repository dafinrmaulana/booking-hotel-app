<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public static function lamanya($tanggal_checkin, $tanggal_checkout) {
        $date1=date_create($tanggal_checkin);
        $date2=date_create($tanggal_checkout);
        $diff=date_diff($date1,$date2);
        return $diff->format("%a");
    }
}
