<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheHeaders
{
    private const PUBLIC_ROUTE_NAMES = [
        'frontend.home',
        'frontend.destinations',
        'frontend.destination.show',
        'frontend.domestic',
        'frontend.international',
        'frontend.tour.show',
        'frontend.about',
        'frontend.gallery',
        'frontend.privacy',
        'frontend.terms',
        'frontend.page.show',
        'frontend.services',
        'frontend.service.show',
        'frontend.blog',
        'frontend.blog.show',
        'frontend.faq',
        'frontend.contact',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$request->isMethod('GET')) {
            return $response;
        }

        if ($request->is('quote/*', 'pay/*') || $request->routeIs('quotation.*', 'payment.*')) {
            $response->headers->set('Cache-Control', 'private, no-store, max-age=0');
            $response->headers->set('Pragma', 'no-cache');

            return $response;
        }

        if (!auth()->check() && $request->routeIs(...self::PUBLIC_ROUTE_NAMES)) {
            $response->headers->set('Cache-Control', 'public, max-age=300, s-maxage=600');

            return $response;
        }

        $response->headers->set('Cache-Control', 'private, no-store, max-age=0');

        return $response;
    }
}
