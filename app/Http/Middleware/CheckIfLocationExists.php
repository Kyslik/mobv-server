<?php

namespace App\Http\Middleware;

use App\Location;
use Closure;
use Illuminate\Http\Request;

class CheckIfLocationExists
{
    private $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function handle($request, Closure $next)
    {
        if (isset($request->route()[2]['location_id'])) {
            $this->location->findOrFail($request->route()[2]['location_id']);
            return $next($request);
        }

        return response()->json([
            'error' => 'Location not found.',
        ], 404);
    }
}
