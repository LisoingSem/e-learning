<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Dashboard;
use Auth;
use DB;

class DashboardController extends BaseApiController
{
    public function get(Request $request)
    {
        $user = Auth::user(); 

        $country = $request->has('country') ? $request->country : null;
        $factory = $request->has('factory') ? $request->factory : null;
        $branch = $request->has('branch') ? $request->branch : null;

        return $this->sendResponse([
            'summary' => Dashboard::getInstance()->getSummary($user, $country, $factory, $branch),
            'by_month' => Dashboard::getInstance()->getByMonth($user),
            'verify' => Dashboard::getInstance()->getVerifyPassport($user)
            
        ], 'Dashboard is successfully.');
    }
}