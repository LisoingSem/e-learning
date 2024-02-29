<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use DB;
use Auth;
use Session;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $curren_route_name = Route::currentRouteName();
        $role_id = Auth::user()->role_id;
        $roles = DB::table('roles')->find($role_id);
        $links = DB::table('feature_links')
            ->join('system_features', 'system_features.id', 'feature_links.feature_id')
            ->whereIn('system_features.id', explode(',', $roles->permission))
            ->pluck('feature_links.name')->toArray();
        Session::put('linksss', $links);
        return $next($request);

    }

    public static function getMethod(){
        $user_role = Auth::user()->role_id;
        
        return $data;
    }

}
