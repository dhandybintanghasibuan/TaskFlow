<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
    $validatedData = $request->validated();
    
    // Convert array notification_preferences to JSON string for the model
    if (isset($validatedData['notification_preferences'])) {
        $validatedData['notification_preferences'] = json_encode($validatedData['notification_preferences']);
    } else {
        $validatedData['notification_preferences'] = json_encode([]);
    }

    $request->user()->fill($validatedData);
    
    // ... (kode if email changed) ...
    
    $request->user()->save();
    return Redirect::route('profile.settings')->with('status', 'profile-updated'); // Ubah rute redirect
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

    public function settings(Request $request): View
    {
        return view('profile.settings', [
            'user' => $request->user(),
        ]);
    }
}
