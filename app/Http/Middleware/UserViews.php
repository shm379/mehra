<?php

namespace App\Http\Middleware;

use App\Models\Page;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class UserViews
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
        if(auth()->check()){
           if ($request->routeIs(['page.show'])){
               $page = Page::find($request->route()->parameter('page'));
               if($page->count()>0) {
                   $page->first()->views()->updateOrCreate([
                       'user_id' => auth()->id(),
                   ]);
                   $page->first()->views()->update(['count' => $page->first()->views()->first('count')->count + 1]);
               }
           }
        }
        return $next($request);
    }
}
