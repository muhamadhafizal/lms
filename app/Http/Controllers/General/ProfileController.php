<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Profile\UpdatePasswordRequest;
use App\Http\Requests\General\Profile\UpdateProfileRequest;
use App\Http\Services\GeneratePasswordService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show(): View
    {
        $user = auth()->user();

        return view('general.profile.show', compact('user'));
    }

    public function edit(): View
    {
        $user = auth()->user();

        return view('general.profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validated = $request->safe();

        $user = auth()->user();

        $user->update($validated->only(['user_name', 'user_email', 'user_language']));

        return back()->with('successMessage', 'Successfully update your profile');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $validated = $request->validated();
        $user = auth()->user();

        $currentPassword = $validated['current_password'];

        if (! password_verify($currentPassword, $user->password)) {
            return back()->with('errorMessage', 'Invalid current password');
        }

        $hashPassword = GeneratePasswordService::getPassword($validated['new_password']);

        $user->update([
            'password' => $hashPassword,
        ]);

        return back()->with('successMessage', 'Successfully update your password');
    }
}
