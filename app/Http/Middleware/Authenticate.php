<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $route = $request->is('dashboard/*') ? route('dashboard.login.show') : route('login.show');
        //login.show و لو غير كدا هيروح علي dashboard.login.show هيروح علي dashboard بدا بكلمه uriلو ال
        //فقط authاللي معمول عليها routeالكلام دا هيحصل علي ال
        return $request->expectsJson() ? null : $route;
    }
}
