<?php

namespace App\Http\Controllers\Admin;

use App\Builder\Filters\FiltersName;
use App\Builder\Sorts\GenderSort;
use App\Builder\Sorts\NameSort;
use App\Builder\Sorts\WalletBalanceSort;
use App\Enums\UserCity;
use App\Enums\UserGender;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        // global input search
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                \Illuminate\Database\Eloquent\Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhereRaw("concat(first_name, ' ', last_name) like '%$value%' ")
                        ->orWhere('mobile', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        // get per page number
        $per_page = abs($request->perPage) > 0 ? abs($request->perPage) : 15;
        QueryBuilderRequest::setArrayValueDelimiter('|');
        // get users from query builder
        $users = QueryBuilder::for(User::class)
            ->with('wallet')
            ->withCount('comments')
            ->defaultSort('created_at')
            ->join('wallets', 'users.id', '=', 'user_id')
            ->allowedSorts([
                'email',
                'mobile',
                'comments_count',
                'created_at',
                AllowedSort::custom('name', new NameSort(), 'name'),
                AllowedSort::custom('gender', new GenderSort(), 'gender'),
                'wallets.balance',
            ])
            ->allowedIncludes(['comments','wallet'])
            ->allowedFilters([
                AllowedFilter::custom('name', new FiltersName(),'name'),
                'comments_count',
                'wallets.balance',
                'city',
                'email',
                'gender',
                $globalSearch])
            ->paginate($per_page)
            ->through(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'mobile' => $user->mobile,
                    'gender' => UserGender::getDescription((int)$user->gender),
                    'email' => $user->email,
                    'email_verified_at' => jdate($user->email_verified_at)->format('j F Y'),
                    'comments_count' => $user->comments_count,
                    'wallets.balance' => number_format(optional($user->wallet)->balance) . ' تومان',
                    'created_at' => jdate($user->created_at)->format('j F Y')
                ];
            })
            ->withQueryString();
        // return table in inertia with columns
        return Inertia::render('User/Index')
            ->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return Inertia::render('User/Profile');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required',  'email'],
            'password' => ['nullable', 'min:6', 'confirmed'],
        ]);

        $user = User::find(Auth::id());
        $updated = [];
        if($request->has('first_name') || $request->has('last_name')){
            $updated['name'] = $request->first_name . ' ' . $request->last_name;
        }
        $updated['email'] = $request->email;
        if (isset($request->password))
            $updated['password'] = Hash::make($request->password);

        $user->update($updated);
        if ($user->wasChanged())
        Redirect::route('admin.users.profile')->with('success', 'اطلاعات کاربری با موفقیت به روز شد.');
        else
            Redirect::route('admin.users.profile')->with('error', 'لطفا اطلاعات را درست وارد کنید');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return Inertia::render('User/Show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
