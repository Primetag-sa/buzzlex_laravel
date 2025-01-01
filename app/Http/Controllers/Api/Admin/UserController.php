<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::filter($request->only([
            'name',
            'email',
            'phone',
            'gender',
            'join_date'
        ]))->paginate();
        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'integer', 'exists:users,id']
        ]);
        User::whereIn('id', $request->ids);
        return new SuccessResource([], "Deleted Successfully");
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update(Arr::only($data, [
            'name',
            'email',
            'phone',
            'gender',
            'dob',
            'latitude',
            'longitude',
        ]));

        if(key_exists('profile_image', $data) && !is_null($data['profile_image'])){
            $user->clearMediaCollection('profile_image');
            $user->addMedia($data['profile_image'])->toMediaCollection('profile_image');
        }

        return new SuccessResource([], "Updated Successfully");
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create(Arr::only($data, [
           'name',
            'email',
            'phone',
            'gender',
            'dob',
            'latitude',
            'longitude',
        ]));

        if(key_exists('profile_image', $data) && !is_null($data['profile_image'])){
            $user->addMedia($data['profile_image'])->toMediaCollection('profile_image');
        }

        return new SuccessResource([], "Created Successfully");
    }
}
