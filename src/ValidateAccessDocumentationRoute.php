<?php

namespace Julio\EndpointDocs\Src;

use Closure;
use Illuminate\Http\Request;

class ValidateAccessDocumentationRoute
{
    /**
     * Handle an incoming request.
     * @throws \App\Exceptions\UnauthorizedException
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $requestKey = $request->input('key');
        $devKey = config('documentation.key');
        $minutes = 10;
        $seconds = 60;
        $addTenMinutes = time() + $seconds * $minutes;

        if (empty($_COOKIE['dev-key']) && $requestKey !== $devKey) {
            return redirect()->route('access-docs');
        }

        if (isset($_COOKIE['dev-key']) && $_COOKIE['dev-key'] !== $devKey) {
            return redirect()->route('access-docs');
        }

        setcookie('dev-key', $requestKey, $addTenMinutes);

        return $next($request);
    }
}
