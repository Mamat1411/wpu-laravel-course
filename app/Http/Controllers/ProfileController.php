<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Barryvdh\Debugbar\Facades\Debugbar;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'title' => 'Profile',
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Laravel Upload
        // if ($request->hasFile('avatar')) {
        //     if (!empty($request->user()->avatar)) {
        //         Storage::disk('public')->delete($request->user()->avatar);
        //     }
        //     $path = $request->file('avatar')->store('img', 'public');
        //     $validatedData['avatar'] = $path;
        // }


        // Laravel + FilePond Upload
        if ($request->avatar) {
            if (!empty($request->user()->avatar)) {
                Storage::disk('public')->delete($request->user()->avatar);
            }

            $newFileName = Str::after($request->avatar, 'tmp/');
            $avatar = 'img/' . $request->username . '-' . $newFileName;
            Storage::disk('public')->move($request->avatar, $avatar);

            $validatedData['avatar'] = $avatar;
        }

        $request->user()->update($validatedData);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function upload(Request $request) {
        Debugbar::disable();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = date("Ymd", time()).'.'.$extension;
            $path = $request->file('avatar')->storeAs('tmp', $filename, 'public');
        }

        return $path;
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
