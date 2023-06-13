<?php


namespace App\Services\Impl;


use App\Models\User;
use App\Models\UserSetting;
use App\Repositories\UserRepository;
use App\Services\Interfaces\UserService;

class UserServiceImpl implements UserService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser($data)
    {
        return $this->repository->createUser($data);
    }

    public function updateUser(User $user, $data)
    {
        return $this->repository->updateUser($user, $data);
    }

    public function createUserSettings($data)
    {
        return $this->repository->createUserSetting($data);
    }

    public function updateUserSettings(UserSetting $userSetting, $data)
    {
        return $this->repository->updateUserSetting($userSetting, $data);
    }

    public function getSettingByUserId($id)
    {
        return $this->repository->getUserSettingByUserId($id);
    }
}
