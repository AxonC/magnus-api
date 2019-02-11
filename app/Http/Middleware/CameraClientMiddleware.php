<?php

namespace App\Http\Middleware;

use Closure;
use App\Camera;
use Illuminate\Http\Request;
use App\Repositories\CameraRepository;

class CameraClientMiddleware
{
    protected $camera;

    public function __construct(CameraRepository $camera)
    {
        $this->camera = $camera;
    }

    public function handle(Request $request, Closure $next)
    {
        if (!$this->camera->validCamera($request->header('Token'), $request->header('Address'))) {
            return abort(403);
        }

        return $next($request);
    }
}