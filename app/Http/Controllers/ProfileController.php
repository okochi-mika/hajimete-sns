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

      // 編集ページ
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


    public function show() {
    $user = auth()->user();
    return view('profile.show', compact('user'));
    }

        // 作成ページ

    public function create()
    {
    return view('profile.create');
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'bio' => 'nullable|string|max:1000',
        'avatar' => 'nullable|image|max:2048', // 画像ならこのくらいのバリデーション
    ]);

    // アバター画像の保存（もしアップロードがあれば）
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $validated['avatar'] = $path;
    }

    // ユーザーにプロフィールを紐づけて保存する
    $user = auth()->user();
    $user->fill($validated);
    $user->save();

    return redirect()->route('profile.show')->with('status', 'プロフィールを作成しました！');
}



}
