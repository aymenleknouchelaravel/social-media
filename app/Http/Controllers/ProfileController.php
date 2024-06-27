<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{

    public function show(User $user)
    {
        return view('user.profile', compact('user'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(User $user): View
    {
        // abort_if(auth()->user() != $user, 403 , 'YOU ARE NOT AUTHORIZED TO SEE THIS PAGE');
        // abort_if(auth()->user()->cannot('edit-update-profile', $user), 403);
        $this->authorize('edit-update-profile', $user);
        return view('user.edit', compact("user"));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->safe()->collect();

        if ($data['password'] == '') {
            unset($data['password']);
        } else {
            $data['password'] = encrypt($data['password']);
        }

        if ($data->has('image')) {
            $path = $request->file('image')->store('users', 'public');
            $data['image'] = '/' . $path;
        }

        $data['private_account'] = $request->has('private_account');

        $user->update($data->toArray());

        session()->flash("success", __('Your profile has been updated!'));

        return redirect()->route('profile.show', $user);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
