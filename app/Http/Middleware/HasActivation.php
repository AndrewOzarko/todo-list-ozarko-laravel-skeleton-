<?php

namespace App\Http\Middleware;

use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Traits\CallableTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasActivation
{
    use CallableTrait;
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $hasActivation = ($user && is_null($user->email_verified_at));

        if ($hasActivation) {
            return redirect('/settings/email');
        }

        return $next($request);
    }
}
