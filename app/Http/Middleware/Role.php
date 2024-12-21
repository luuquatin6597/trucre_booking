<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        //dd($roles); 
        //is now an array with all the roles you provided to the route.

        if (!$request->user() || !in_array($request->user()->role, $roles)) {
            // Redirect...

            return redirect()->route('homepage');
        }

        return $next($request);
    }
    // public function handle(Request $request, Closure $next, $roles): Response
    // {
    //     // Tách danh sách các vai trò (role1,role2,role3)
    //     $roles = explode(',', $roles);

    //     // Kiểm tra nếu vai trò người dùng nằm trong danh sách
    //     if (!in_array($request->user()->role, $roles)) {
    //         if ($request->user()->role === 'admin' || $request->user()->role === 'staff') {
    //             return redirect()->route('admin.dashboard');
    //         } elseif ($request->user()->role === 'owner') {
    //             return redirect()->route('owner.dashboard');
    //         } else {
    //             return redirect()->route('homepage');
    //         }
    //     }

    //     return $next($request);
    // }


}
