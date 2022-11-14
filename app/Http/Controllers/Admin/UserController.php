<?php

namespace App\Http\Controllers\Admin;

use App\Builder\Sorts\NameSort;
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

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('mobile', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        $per_page = abs($request->perPage) > 0 ? abs($request->perPage) : 15;

        $users = QueryBuilder::for(User::class)
            ->defaultSort('created_at')
            ->allowedSorts([
                'gender',
                'email',
                'created_at',
                AllowedSort::custom('name', new NameSort(), 'name'),
            ])
            ->allowedFilters(['email', $globalSearch])
            ->paginate($per_page)
            ->through(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'mobile' => $user->mobile,
                    'gender' => UserGender::getDescription((int)$user->gender),
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at
                ];
            })
            ->withQueryString();
        return Inertia::render('User/Index')
            ->with(['users' => $users])
            ->table(function (InertiaTable $table) {
                $table
                    ->withGlobalSearch('جستجو در لیست کاربران ...')
                    ->defaultSort('created_at')
                    ->column(key: 'name', label: 'نام و نام خانوادگی', canBeHidden: false, sortable: true, searchable: true)
                    ->column(key: 'gender', label: 'جنسیت', sortable: true, searchable: true)
                    ->column(key: 'email', label: 'ایمیل', sortable: true, searchable: true)
                    ->column(key: 'mobile', label: 'موبایل', sortable: true, searchable: true)
                    ->column(key: 'created_at', label: 'تاریخ ثبت نام', sortable: true, searchable: true)
                    ->column(label: 'عملیات')
                    ->selectFilter(key: 'email', options: [
                        'gmail' => 'Gmail',
                        'live' => 'Live',
                    ], label: 'ایمیل');
            });
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
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        if (isset($request->password))
            $user->password = Hash::make($request->password);

        if ($user->save())
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
