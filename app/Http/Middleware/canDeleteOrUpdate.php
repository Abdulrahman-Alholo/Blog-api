<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class canDeleteOrUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::findOrFail($request->route('id'));
        if ($post->user_id === auth()->user()->id) {
            return $next($request);
        }
        else{
            return response()->json(['message' => 'Unauthorized'], 401);
        }

    }
}
