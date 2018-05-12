<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserCreateRequest;
use App\Http\Resources\Api\UserResource;
use App\Model\User;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(User::paginate());
    }
    
    /**
     * @param UserCreateRequest $request
     *
     * @return UserResource
     */
    public function store(UserCreateRequest $request)
    {
        $user = new User($request->only(['name', 'password', 'email']));
        $user->save();
        $user->createToken('App');
        
        return new UserResource($user);
    }
    
    /**
     * @param User $task
     *
     * @return UserResource
     */
    public function show(User $task)
    {
        return new UserResource($task);
    }
}