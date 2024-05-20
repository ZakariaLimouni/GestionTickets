<?php 
use App\Models\Ville;
use App\Models\Agence;
$villes = Ville::all();        
$agences = Agence::all();
?>

<style>
*:before,
*:after {
    box-sizing: inherit;
}

h1 {
    text-align: center;
}

body {
    background-image: url('{{ asset('img/background-img.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #C8E6C9;
}

.registration-wrapper {
    background-color: #C8E6C9;
    margin: 85px auto 0;
    position: relative;
    width: 992px;
    display: flex;
}

.registration-form {
    margin-left: 25;
    padding: 20px;
    position: relative;
    z-index: 1;
    width: 570px;
}

.registration-image {
    
    margin-top: 150px;
}

.registration-image img {
    width: 265;
    height: 265;
}

.form-field-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.form-field-group div {
    flex: 1;
    margin-right: 10px;
}

.col:last-child {
    margin-right: 0;
}

label {
    display: inline-block;
    margin-bottom: 10px;
}

input[type="text"],
input[type="tel"],
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
}

.text-sm {
    font-size: 0.875rem;
}

.photo-profile-container {
    position: relative;
    overflow: hidden;
    margin-top: 30px;
    border: 1px solid #ccc;
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
    text-align: center;
    position: absolute;
    top: 0;
    left: 0;
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
    background-color: #092911;
    color: white;
    padding: 7px 20px;
    border: none;
    font-size: 17px;
    border-radius: 7px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.primary:hover {
    background-color: #ADF2CE;
    color: darkgreen;
}

.registered-link {
    font-size: 16px;
    color: #4a5568;
    transition: color 0.3s ease;
    margin-left: 25px;
}
</style>

    <div class="registration-wrapper">
        <!-- Image section -->
        <div class="registration-image">
            <img src="{{ asset('img/sdtm_sa_logo.jpg') }}" alt="Image" />
        </div>
        <!-- Form section -->
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="registration-form">
            @csrf
            <h1>Formulaire d'inscription</h1>
            <!-- Photo Profile -->
            <div class="mt-1">
                <x-input-label for="photo_profile" :value="__('Photo Profile')" />
                <input id="photo_profile" type="file" name="photo_profile" accept="image/*">
                <x-input-error :messages="$errors->get('photo_profile')" class="mt-2" />
            </div>

            <!-- Name and Prenom -->
            <div class="form-field-group">
                <div class="mt-1">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mt-1">
                    <x-input-label for="Prenom" :value="__('Prenom')" />
                    <x-text-input id="Prenom" class="block mt-1 w-full" type="text" name="Prenom" :value="old('Prenom')" required autofocus autocomplete="Prenom" />
                    <x-input-error :messages="$errors->get('Prenom')" class="mt-2" />
                </div>
            </div>
            <!-- Email and Telephone -->
            <div class="form-field-group">
                <div class="mt-1">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mt-1">
                    <x-input-label for="Telephone" :value="__('Telephone')" />
                    <x-text-input id="Telephone" class="block mt-1 w-full" type="text" name="Telephone" :value="old('Telephone')" required autofocus autocomplete="Telephone" />
                    <x-input-error :messages="$errors->get('Telephone')" class="mt-2" />
                </div>
            </div>
            <!-- Ville and Agence -->
            <div class="form-field-group">
                <div class="mt-1">
                    <x-input-label for="ville_id" :value="__('Ville')" />
                    <select id="ville_id" name="ville_id" class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                        <option value="">Votre Ville</option>
                        @foreach($villes as $ville)
                        <option value="{{$ville->id}}">{{$ville->ville}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('ville_id')" class="mt-2" />
                </div>
                <div class="mt-1">
                    <x-input-label for="agence_id" :value="__('Agence')" />
                    <select id="agence_id" name="agence_id" class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                        <option value="">Votre Agence</option>
                        @foreach($agences as $agence)
                        <option value="{{$agence->id}}">{{$agence->agence}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('agence_id')" class="mt-2" />
                </div>
            </div>
            <!-- Password -->
            <div class="form-field-group">
                <div class="mt-1">
                    <x-input-label for="password" :value="__('Le Mot de passe')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Confirm Password -->
                <div class="mt-1">
                    <x-input-label for="password_confirmation" :value="__('Confirmer Le Mot de passe')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
            <!-- Register Button -->
            <div class="form-field-group">
                <div class="flex items-center justify-end mt-4">
                    <div class="button-container">
                        <x-primary-button class="primary">{{ __("S'inscrire") }}</x-primary-button>
                        <a class="registered-link" href="{{ route('login') }}">{{ __('Déjà inscrit?') }}</a>
                    </div>
                </div>
            </div>
        </form>
        </form>
    </div>
