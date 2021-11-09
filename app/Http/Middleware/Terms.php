<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class Terms {
        /**
         * Handle an incoming request.
         *
         * @param Request $request
         * @param Closure $next
         * @return mixed
         */
        public function handle(Request $request, Closure $next) {
            if(!empty(Auth::user())) {
                if (!Auth::user()->terms_accepted) {
                    return redirect('accept-terms');
                }
            }
            return $next($request);
        }
    }
