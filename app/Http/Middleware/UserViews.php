<?php

namespace App\Http\Middleware;

use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class UserViews
{
    private $routes = [
        'api.v1.pages.show'=>'page',
        'api.v1.books.show'=>'book'
    ];
    private function viewed($model){
        if($model->count()>0) {
            $model->first()->views()->updateOrCreate([
                'user_id' => auth()->id(),
            ]);
            $model->first()->views()->update(['count' => $model->first()->views()->first('count')->count + 1]);
        }
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->guard('sanctum')->check()){
           if ($request->routeIs(array_keys($this->routes))) {
               foreach ($this->routes as $parameter) {
                   if($request->route()->hasParameter($parameter))
                       $this->viewed($request->route()->parameter($parameter));
               }
           }
        }
        return $next($request);
    }
}
