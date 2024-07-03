<?php
    
    namespace App\Http\Middleware;
    
    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Carbon;
    use Symfony\Component\HttpFoundation\Response;
    
    class LastSeen {
        
        /**
         * ----------------------
         * @param Request $request
         * @param Closure $next
         * @return Response
         * this middleware is applied globally
         * updates user last seen on every authorized call
         *  ----------------------
         */
        
        public function handle ( Request $request, Closure $next ): Response {
            
            if ( $request -> user () ) {
                $request -> user () -> last_seen = Carbon ::now ();
                $request -> user () -> update ();
            }
            
            return $next( $request );
        }
    }
