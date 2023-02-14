<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class CheckBrowser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $is_bot = Agent::isRobot();
         $is_desktop =Agent::isDesktop();
         $is_tablet =Agent::isTablet();
         $is_phone =Agent::isPhone();

         $device = Agent::device();
         $platform = Agent::platform();
         $browser = Agent::browser();

        if ($is_bot == true) {
            abort(403);
        }

        // if ($is_desktop == true and fromSettings('allow_desktops') == 0) {
        //     return redirect(fromSettings('block_ip_redirect_url'));
        // }
        // if ($is_tablet == true and fromSettings('allow_tablets') == 0) {
        //     return redirect(fromSettings('block_ip_redirect_url'));
        // }
        // if ($is_phone == true and fromSettings('allow_phones') == 0) {
        //     return redirect(fromSettings('block_ip_redirect_url'));
        // }
        
        return $next($request);
    }
}
