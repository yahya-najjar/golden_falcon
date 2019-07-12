<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Cache;
use Illuminate\Support\Facades\File;
use Session;

class SettingController extends Controller
{
    public function __construct(Setting $setting)
    {
        $this->model = $setting;
        // $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.settings.edit');
    }

    public function store(Request $request)
    {

        $settings = $this->model->rows();

        $input = $request->except(['_token', '_method']);

        if ($request->hasFile('logo')) {
            $input['logo'] = $request->file('logo')->store('basics', 'public');

            @unlink(storage_path('app/public/' . $settings->logo));
        }

        if ($request->hasFile('favicon')) {
            $input['favicon'] = $request->file('favicon')->store('basics', 'public');

            @unlink(storage_path('app/public/' . $settings->favicon));
        }

        if ($request->hasFile('videoThumb')) {
            $input['videoThumb'] = $request->file('videoThumb')->store('basics', 'public');

            @unlink(storage_path('app/public/' . $settings->videoThumb));
        }

        if ($request->hasFile('video')) {
            $input['video'] = $request->file('video')->store('basics', 'public');

            @unlink(storage_path('app/public/' . $settings->video));
        }


        foreach ($input as $key => $value) {
            if (!is_null($value)) {
                $this->model->set($key, $value);
            }
        }

        Cache::forget('site_settings');
        $settings = Cache::rememberForever('site_settings', function () {
            $settings = $this->model->rows();
            return $settings;
        });

        return back()->with('success', 'Saved!');
    }


}
