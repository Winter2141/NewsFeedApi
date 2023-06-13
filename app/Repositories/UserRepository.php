<?php


namespace App\Repositories;


use App\Models\User;
use App\Models\UserSetting;

class UserRepository
{
    public function getUserById($id)
    {
        return User::where('id', $id)->first();
    }

    public function getUserSettingById($id)
    {
        return UserSetting::where('id', $id)->first();
    }

    public function getUserSettingByUserId($id)
    {
        return UserSetting::where('user_id', $id)->first();
    }

    public function createUser($data)
    {
        $user = User::create($data);
        $data = [
            'user_id' => $user->id,
            'country' => 'us'
        ];
        $this->createUserSetting($data);
        return $user;
    }

    public function updateUser(User $user, $data)
    {
        $user->update($data);

        return $user;
    }

    public function createUserSetting($data)
    {
        return UserSetting::create($data);
    }

    public function updateUserSetting(UserSetting $userSetting, $data)
    {
        $userSetting->update($data);
        return $userSetting;
    }
}
