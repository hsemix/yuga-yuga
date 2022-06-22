<?php

namespace App\Middleware;

use Closure;
use Yuga\Http\Request;
use Yuga\JWTAuth\UsesJWTTokens;
use Yuga\Application\Application;
use Yuga\Http\Middleware\IMiddleware;

class ApiMiddleware implements IMiddleware
{
    use UsesJWTTokens;
    /**
     * @var \Yuga\Application\Application | null
     */
    protected $app;
    /**
     * -------------------------------------------------------------------------
     * Inject any objects (in the contructor) you want to use in this middleware
     * We will worry about instantiating them for you
     * -------------------------------------------------------------------------
     */
    public function __construct(Application $app)
    {
        $this->app      = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Yuga\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function run(Request $request, Closure $next)
    {
        try {
            $token = $request->getBearerToken();

            try {
                $this->verifyToken($token);
                return $next($request);
            } catch (\Exception $e) {
                return response()->json([
                    'app_status' => false, 
                    'message' => $e->getMessage(),
                    'data' => null
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'app_status' => false, 
                'message' => 'Unauthorized Access',
                'data' => null
            ], null, 401);
        }
        
    }
}