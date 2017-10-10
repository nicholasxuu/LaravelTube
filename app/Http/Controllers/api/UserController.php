<?php

namespace App\Http\Controllers\api;


use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository as User;
use App\Transformers\UserTransformer;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserController.
 */
class UserController extends ApiGuardController
{
    /**
     * @var UserTransformer
     */
    protected $userTransformer;

    /**
     * @var array
     */
    protected $apiMethods = [
        'getAllUsers' => [
            'level' => 100,
        ],
        'delete' => [
            'level' => 100,
        ],
        'show' => [
            'keyAuthentication' => false,
        ],
    ];

    /**
     * UserController constructor.
     *
     * @param User            $user
     * @param UserTransformer $userTransformer
     */
    public function __construct(User $user, UserTransformer $userTransformer)
    {
        parent::__construct();

        $this->userTransformer = $userTransformer;
        $this->user = $user;
    }

    /**
     * Get all users.
     *
     * @return mixed
     */
    public function getAllUsers()
    {
        $user = $this->user->all();

        return $this->response->withCollection($user, $this->userTransformer);
    }

    /**
     * Get user find id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return $this->response->withItem($user, $this->userTransformer);
    }

    /**
     * Update user.
     *
     * @param UserUpdateRequest $request
     * @param $id
     *
     * @return mixed
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if (!$this->checkModPermission($request->user(), $id)) {
            return response('Unauthorized.', 401);
        }

        $user = $this->user->findOrFail($id);

        if ($request->avatar != '') {
            $path = $this->storeImage($request->avatar, $user);
        } else {
            $path = $user->avatar;
        }

        $newLevel = $request->input('level');
        if ($user->level < $newLevel) {
            // if upgrade level
            if ($request->user()->level < $newLevel) {
                $newLevel = $request->user()->level;
            }
        }

        $data = [
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'level' => $newLevel,
            'avatar'   => $path,
        ];

        if ($request->input('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        if ($newLevel !== null) {
            $apiKey = ApiKey::where('user_id', $id)->update(['level' => $newLevel]);
        }

        $this->user->update($data, $id);

        $user = $this->user->findOrFail($id);

        return $this->response->withItem($user, $this->userTransformer);
    }

    /**
     * Delete user.
     *
     * @param $id
     */
    public function delete($id)
    {
        $this->user->delete($id);
    }

    /**
     * Store image avatar.
     *
     * @param $image
     * @param $user
     *
     * @return mixed
     */
    private function storeImage($image, $user)
    {
        $path = Storage::url('images/avatars/'.$user->id.'.'.$image->getClientOriginalExtension());

        Storage::disk('public')->put(
            'images/avatars/'.$user->id.'.'.$image->getClientOriginalExtension(),
            file_get_contents($image->getRealPath())
        );

        return $path;
    }

    /**
     * @param $user
     * @param $userId
     * @return bool
     */
    protected function checkModPermission($user, $userId)
    {
        if ($user->level <= 100 && $user->id !== $userId) {
            return false;
        }
        return true;
    }
}
