<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Http\Resources\Admin\SettingResource;
use App\Http\Resources\SuccessResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::filter(
            $request->only(['name', 'value']),
        )->get();

        return SettingResource::collection($settings);
    }

    public function store(SettingRequest $request)
    {
        $data = $request->validated();
        $setting = Setting::updateOrCreate(['name' => $data['name']], [
            'value' => $data['value'],
            'type'=> $data['type']
        ]);

        if(key_exists('media', $data) && !is_null($data['media'])){
            $setting->clearMediaCollection('profile_image');
            $setting->addMedia($data['profile_image'])->toMediaCollection('profile_image');
        }

        return new SuccessResource([], "Stored successfully");
    }

    public function show(Setting $setting)
    {
        return new SettingResource($setting);
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return new SuccessResource([], "Deleted successfully");
    }
}
