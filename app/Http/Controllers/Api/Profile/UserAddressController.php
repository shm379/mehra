<?php

namespace App\Http\Controllers\Api\Profile;

use App\Exceptions\Api\Profile\Address\DestroyException;
use App\Exceptions\Api\Profile\Address\UpdateException;
use App\Exceptions\MehraApiException;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Profile\StoreUserAddressRequest;
use App\Http\Requests\Api\Profile\UpdateUserAddressRequest;
use App\Http\Resources\Api\UserAddressResource;
use App\Http\Resources\Api\UserAddressResourceCollection;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserAddressController extends Controller
{
    public function __construct()
    {
      //  $this->authorizeResource(UserAddress::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return UserAddressResourceCollection
     */
    public function index()
    {
        $addresses = auth()->user()->addresses()->paginate($this->perPage);
        return new UserAddressResourceCollection($addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserAddressRequest $request)
    {
        try {
            $userAddress = auth()->user()->addresses()->create($request->validated());
        } catch (MehraApiException $exception){}

        return $this->successResponse('آدرس با موفقیت ایجاد گردید');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($userAddressId)
    {
        try {
            $userAddress = UserAddress::query()->where('user_id',auth()->id())->findOrFail($userAddressId);
            return UserAddressResource::make($userAddress);
        } catch (ModelNotFoundException $exception){
            return $this->errorResponse('آدرس یافت نشد!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserAddressRequest $request, $userAddressId)
    {
        try {
            $userAddress = UserAddress::query()->findOrFail($userAddressId);
            if($userAddress->user_id == auth()->id())
                $userAddress->update($request->validated());

        } catch (ModelNotFoundException $exception){
            return $this->errorResponse('آدرس یافت نشد!');
        } catch (UpdateException $exception){}

        return $this->successResponse('آدرس با موفقیت ویرایش گردید.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($userAddressId)
    {
        try {
            $userAddress = UserAddress::query()->findOrFail($userAddressId);
            if($userAddress->user_id == auth()->id())
                $userAddress->delete();
            else
                return $this->errorResponse('دسترسی غیر مجاز!');
        } catch (ModelNotFoundException $exception){
            return $this->errorResponse('آدرس یافت نشد!');
        } catch (DestroyException $exception){}

        return $this->successResponse('آدرس با موفقیت حذف گردید');
    }
}
