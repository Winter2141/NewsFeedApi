<?php

namespace App\Services\Interfaces;

use App\Models\User;
use App\Models\UserSetting;

interface UserService {
    public function getSettingByUserId($id);
    public function createUser($data);
    public function updateUser(User $user, $data);
    public function createUserSettings($data);
    public function updateUserSettings(UserSetting $userSetting, $data);
}
