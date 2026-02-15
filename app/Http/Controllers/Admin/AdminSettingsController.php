<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();

        return view('admin.settings.edit', compact('settings', 'user'));
    }

    public function update(Request $request)
    {
        // ... (validation lines) ...
        $request->validate([
            'favicon' => 'nullable|image|mimes:ico,png,gif,jpg,jpeg|max:1024',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $settingsData = $request->input('settings', []);

        // 1. Process Global Site Settings
        // Process Favicon Upload
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('settings', $filename, 'public');
            $settingsData['favicon_url'] = 'storage/' . $path;
        }

        // Process Social Links into JSON
        $socialNames = $request->input('social_name', []);
        $socialUrls = $request->input('social_url', []);
        $socialLinks = [];
        foreach ($socialNames as $i => $name) {
            if (!empty($name) && !empty($socialUrls[$i])) {
                $socialLinks[] = [
                    'name' => $name,
                    'url' => $socialUrls[$i]
                ];
            }
        }
        $settingsData['social_links'] = json_encode($socialLinks);

        // Handle Maintenance Mode (checkbox)
        $settingsData['maintenance_mode'] = isset($settingsData['maintenance_mode']) ? '1' : '0';

        foreach ($settingsData as $key => $value) {
            SiteSetting::set($key, $value);
        }

        // 2. Process User Account Settings
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();
        $userData = $request->input('user', []);

        if (!empty($userData) || $request->hasFile('avatar')) {
            $userUpdateData = [];
            if (isset($userData['name'])) $userUpdateData['name'] = $userData['name'];
            if (isset($userData['email'])) $userUpdateData['email'] = $userData['email'];

            // Process Avatar Upload
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('avatars', $filename, 'public');
                $userUpdateData['avatar_url'] = 'storage/' . $path;
            }

            // Handle 2FA Preference
            $userUpdateData['two_factor_enabled'] = isset($userData['two_factor_enabled']) ? true : false;

            // Handle Password Change
            if (!empty($request->input('current_password'))) {
                $request->validate([
                    'current_password' => 'required|current_password',
                    'new_password' => 'required|string|min:8|confirmed',
                ]);
                $userUpdateData['password'] = bcrypt($request->input('new_password'));
            }

            $user->update($userUpdateData);
        }

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully.');
    }
}
