<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use App\Services\Interfaces\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    private $service;
    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api');
        $this->service = $userService;
    }

    public function index(Request $request)
    {
        $userSettings = $this->service->getSettingByUserId(Auth::user()->id);
        return response()->json($userSettings);
    }

    public function update(UserSetting $userSetting, Request $request)
    {
        try {
            $this->service->updateUserSettings($userSetting, $request->all());
            return response()->json(['msg' => "success"]);
        } catch (\Exception $error)
        {
            return response("Error", 400)->json(["error" => $error->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        try {
            $this->service->createUserSettings($request->all());
            return response()->json(['msg' => "success"]);
        } catch (\Exception $error)
        {
            return response("Error", 400)->json(["error" => $error->getMessage()]);
        }
    }
}
