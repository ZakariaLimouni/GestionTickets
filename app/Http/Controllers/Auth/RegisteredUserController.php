<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'photo_profile'=>'image',
            'name' => ['required', 'string', 'max:255'],
            'Prenom' => ['required', 'string', 'max:255'],
            'ville_id'=>'required',
            'agence_id'=>'required',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'Telephone' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        if ($request->hasFile('photo_profile')) {

            $image = $request->file('photo_profile');
            $imageName = $request->name.$request->Prenom.'.'.$image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);
        }

        $user = User::create([
            'photo_profile'=>$imageName,
            'name' => $request->name,
            'Prenom' => $request->Prenom,
            'ville_id'=>$request->ville_id,
            'agence_id'=>$request->agence_id,
            'email' => $request->email,
            'Telephone' => $request->Telephone,
            'userType' => 'user',
            'password' => Hash::make($request->password),  
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
