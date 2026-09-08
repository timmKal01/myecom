<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!FacadesAuth::check()) {
            return redirect()->route('login');
        }
        $authUserRole = FacadesAuth::user()->role;
        switch ($role){
            case 'admin':
                if($authUserRole == 0){
                    return $next($request);
                }
                break;
            case 'vendor':
                if($authUserRole == 1){
                    return $next($request);
                }
                break;
            case 'customer':
                if($authUserRole == 2){
                    return $next($request);
                }
                break;
        }

        switch ($authUserRole){
            case 0:
                return redirect()->route('admin');
            case 1:
                return redirect()->route('vendor');
            case 2:
                return redirect()->route('dashboard');
        }


        // If the user's role does not match, redirect or abort
        return redirect()->route('login')->withErrors(['unauthorized' => 'You are not authorized to access this page.']);
    }
}
