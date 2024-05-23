<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function profileEdit($id)
    {
        $profile = Profile::where('user_id', $id)->first();
        return view ('profile.editProfile',compact('profile'));
    }
    public function passwordChange(Request $request,$id)
    {
        $user = User::findOrFail($id);

        // Check if the old password matches
        if (!Hash::check($request->input('old-password'), $user->password)) {
            // If the old password does not match, return an error response
            return redirect()->back()->withErrors(['Old password does not match our records.']);
        }

        // Check if the new password and confirm password match
        if ($request->input('new-password') !== $request->input('confirm-password')) {
            // If the new password and confirm password do not match, return an error response
            return redirect()->back()->withErrors(['New password & confirm password does not match.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->input('new-password'));
        $user->save();

        // If the password update is successful, return a success response
        return redirect()->back()->with('success', 'Password updated successfully');

    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id); // Retrieve the user record
        $emailExists = User::where('email', $request->input('email'))->where('id', '!=', $id)->exists();
        // Check if email already exists for another user

        if ($emailExists) {
            return redirect()->back()->withErrors(['email' => 'This email address is already taken.'])->withInput();
            // Redirect back to the form with an error message
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        $profile = Profile::where('user_id', $id)->first();

        $requestData = [
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
        ];

        if ($request->hasFile('image')) {
            $requestData['image'] = $this->uploadImage(request()->file('image'));
        }

        $profile->update($requestData);

        // Redirect back to the form
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function uploadImage($file){
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $filePath = 'storage/profiles/' . $fileName;
        Image::make($file)
            ->resize(600,600)
            ->save(storage_path().'/app/public/profiles/'.$fileName);

            return $filePath;
    }

    }
