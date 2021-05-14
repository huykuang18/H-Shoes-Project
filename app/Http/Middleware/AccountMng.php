<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class AccountMng
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $account = Admin::where('username',session('admin'))->first();
        if($account->role == 1)
        {
            return $next($request);
        } else {
            return redirect('admin');
        }
    }
}
