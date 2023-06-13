<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\ArticleService;
use App\Services\Interfaces\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use jcobhams\NewsApi\NewsApi;

class ArticleController extends Controller
{
    private $service;
    private $userService;
    private $newsapi;

    public function __construct(ArticleService $articleService, UserService $userService)
    {
        $this->service = $articleService;
        $this->userService = $userService;
        $this->newsapi = new NewsApi(env("NEW_API_KEY"));
        $this->middleware('auth:api')->except(['getCategories', 'getLanguages', 'search']);
    }

    public function search(Request $request)
    {
        if(!Auth::hasUser()) {
            $all_articles = $this->newsapi->getTopHeadlines("", null, "us", null, 12, 1);
        } else {
            $keyword = $request->get('keyword');
            $date = $request->get('date');
            $category = $request->get('category');
            $source = $request->get('source');
            $page = $request->get('page');
            $userSetting = $this->userService->getSettingByUserId(Auth::user()->id);
            $country = $request->get('country', isset($userSetting->country) ? $userSetting->country : 'us');
            Log::info($keyword.$source.$userSetting->country.$category.$userSetting->pageSize.$page);
            $all_articles = $this->newsapi->getTopHeadlines($keyword, $source, $source ? null : ($country ? $country : 'us'), $source ? null : $category, $userSetting->pageSize, $page);
        }
        return response()->json($all_articles);
    }

    public function getSources(Request $request)
    {
        $userSetting = $this->userService->getSettingByUserId(Auth::user()->id);
        $sources = $this->newsapi->getSources($request->get('category'), 'en', $request->get('country', $userSetting->country));

        return response()->json($sources->sources);
    }

    public function getCategories(Request $request)
    {
        $categories = $this->newsapi->getCategories();
        if(Auth::hasUser()) {
            $userSetting = $this->userService->getSettingByUserId(Auth::user()->id);
            if(isset($userSetting->categories) && $userSetting->categories && $request->has('is_own') && $request->get('is_own')) {
                $categories = explode(",", $userSetting->categories);
            }
        }
        return response()->json($categories);
    }

    public function getLanguages(Request $request)
    {
        $language = $this->newsapi->getLanguages();

        return response()->json($language);
    }

    public function getCountries(Request $request)
    {
        $countries = $this->newsapi->getCountries();

        return response()->json($countries);
    }
}
