<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{
    /**
     * Display account settings.
     */
    public function edit()
    {
        $user = auth()->user();

        return view('admin.account-settings.edit', compact('user'));
    }

    /**
     * Update administrator account information.
     */
    public function updateAccount(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'current_password' => [
                'required',
                'current_password',
            ],
        ], [
            'current_password.current_password' =>
                'Your current password is incorrect.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        $user->save();

        return redirect()
            ->route('admin.account-settings.edit')
            ->with('success', 'Your account information has been updated successfully.');
    }

    /**
     * Change administrator password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:current_password',
            ],
        ], [
            'current_password.current_password' =>
                'Your current password is incorrect.',

            'password.different' =>
                'Your new password must be different from your current password.',

            'password.confirmed' =>
                'The password confirmation does not match.',
        ]);

        $user = auth()->user();

        $user->password = $validated['password'];

        $user->save();

        return redirect()
            ->route('admin.account-settings.edit')
            ->with('success', 'Your password has been changed successfully.');
    }
}