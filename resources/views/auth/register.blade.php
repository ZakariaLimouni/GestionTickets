<?php
use App\Models\Ville;
use App\Models\Agence;
$villes = Ville::all();        
$agences = Agence::all();
?>

<style>
    /* Base styles */
    * {
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333333;
    }

    body {
        background-image: url('{{ asset('img/background-img.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f3f4f6;
        margin: 0;
    }

    .registration-wrapper {
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 992px;
        margin: 85px auto 0;
    }

    .form-field-group {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .form-field-group div {
        flex: 1;
        margin-right: 10px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        color: #555555;
    }

    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #cccccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .photo-profile-container {
        margin-top: 30px;
        border: 1px solid #cccccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        padding: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 50%;
        margin: auto;
    }

    .photo-profile-container:hover {
        background-color: #F8FEF7;
    }

    .photo-profile-input {
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .primary {
        background-color: #007bff;
        color: #ffffff;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-right: 25px;
    }

    .primary:hover {
        background-color: #0056b3;
    }

    .registered-link {
        font-size: 16px;
        color: #4a5568;
        transition: color 0.3s ease;
    }
</style>

<div class="registration-wrapper">
    <!-- Form section -->
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <h1>Formulaire d'inscription</h1>
        <!-- Photo Profile -->
        <div class="form-field-group">
            <div class="photo-profile-container">
                <div class="mt-1">
                    <x-input-label for="photo_profile" :value="__('Photo Profile')" />
                    <input id="photo_profile" type="file" name="photo_profile" accept="image/*" >
                    <x-input-error :messages="$errors->get('photo_profile')" class="mt-2" />
                </div>
            </div>
        </div>

        

        <!-- Name and Prenom -->
        <div class="form-field-group">
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="Prenom">Prenom</label>
                <input id="Prenom" type="text" name="Prenom" value="{{ old('Prenom') }}" required autofocus>
                @error('Prenom')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Email and Telephone -->
        <div class="form-field-group">
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="Telephone">Telephone</label>
                <input id="Telephone" type="tel" name="Telephone" value="{{ old('Telephone') }}" required>
                @error('Telephone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Ville and Agence -->
        <div class="form-field-group">
            <div>
                <label for="ville_id">Ville</label>
                <select id="ville_id" name="ville_id" required>
                    <option value="">Votre Ville</option>
                    @foreach($villes as $ville)
                        <option value="{{ $ville->id }}">{{ $ville->ville }}</option>
                    @endforeach
                </select>
                @error('ville_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="agence_id">Agence</label>
                <select id="agence_id" name="agence_id" required>
                    <option value="">Votre Agence</option>
                    @foreach($agences as $agence)
                        <option value="{{ $agence->id }}">{{ $agence->agence }}</option>
                    @endforeach
                </select>
                @error('agence_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div class="form-field-group">
            <div>
                <label for="password">Le Mot de passe</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation">Confirmer Le Mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Register Button -->
        <div class="form-field-group">
            <div class="button-container">
                <button type="submit" class="primary">{{ __("S'inscrire") }}</button>
                <a class="registered-link" href="{{ route('login') }}">{{ __('Déjà inscrit?') }}</a>
            </div>
        </div>
    </form>
</div>