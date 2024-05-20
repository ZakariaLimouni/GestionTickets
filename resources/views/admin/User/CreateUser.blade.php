<?php

use Illuminate\Support\Facades\Storage;

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px;padding-right: 8px;">
            {{ __('Créer Utilisateur') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-white-100">
                    <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                        color: #333;
                        margin: 0;
                        padding: 0;
                    }

                    .container {
                        max-width: 1200px;
                        margin: 0 auto;
                        padding: 0px;
                    }
                    </style>
                    <div class="container mx-auto px-4">
                        <form method="POST" action="{{ route('createUser.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-12 gap-4">

                                <div class="col-span-4">
                                    <!-- Photo Profile -->
                                    <div class="mt-1">
                                        <x-input-label for="photo_profile" :value="__('Photo Profile')" />
                                        <input id="photo_profile" type="file" name="photo_profile" accept="image/*">
                                        <x-input-error :messages="$errors->get('photo_profile')" class="mt-2" />
                                    </div>
                                    <!-- Matricule -->
                                    <div class="mt-1">
                                        <x-input-label for="Matricule" :value="__('Matricule')" />
                                        <x-text-input id="Matricule" class="block mt-1 w-full" type="text"
                                            name="Matricule" :value="old('Matricule')" required autofocus
                                            autocomplete="Matricule" />
                                        <x-input-error :messages="$errors->get('Matricule')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-span-8 grid grid-cols-2 gap-4">
                                    <!-- Name -->
                                    <div class="mt-1">
                                        <x-input-label for="name" :value="__('Nom')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                            :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <!-- Prenom -->
                                    <div class="mt-1">
                                        <x-input-label for="Prenom" :value="__('Prénom')" />
                                        <x-text-input id="Prenom" class="block mt-1 w-full" type="text" name="Prenom"
                                            :value="old('Prenom')" required autofocus autocomplete="Prenom" />
                                        <x-input-error :messages="$errors->get('Prenom')" class="mt-2" />
                                    </div>
                                    <!-- Email Address -->
                                    <div class="mt-1">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <!-- Telephone -->
                                    <div class="mt-1">
                                        <x-input-label for="Telephone" :value="__('Téléphone')" />
                                        <x-text-input id="Telephone" class="block mt-1 w-full" type="text"
                                            name="Telephone" :value="old('Telephone')" required autofocus
                                            autocomplete="Telephone" />
                                        <x-input-error :messages="$errors->get('Telephone')" class="mt-2" />
                                    </div>
                                    <!-- ville_id -->
                                    <div class="mt-1">
                                        <x-input-label for="ville_id" :value="__('Ville')" />
                                        <select id="ville_id" name="ville_id"
                                            class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                            <option value="">Selectionner Ville</option>
                                            @foreach($villes as $ville)
                                            <option value="{{$ville->id}}">{{$ville->ville}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('ville_id')" class="mt-2" />
                                    </div>
                                    <!-- agence_id -->
                                    <div class="mt-1">
                                        <x-input-label for="agence_id" :value="__('Agence')" />
                                        <select id="agence_id" name="agence_id"
                                            class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                            <option value="">Selectionner Agence</option>
                                            @foreach($agences as $agence)
                                            <option value="{{$agence->id}}">{{$agence->agence}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('agence_id')" class="mt-2" />
                                    </div>
                                    <!-- status -->
                                    <div class="mt-1">
                                        <x-input-label for="status" :value="__('Status')" />
                                        <select id="status" name="status"
                                            class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                            <option value="">Selectionner le Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                    </div>
                                    <!-- Role -->
                                    {{-- <div class="mt-1">
                                        <x-input-label for="roles" :value="__('Roles')" />
                                        <select id="roles" name="roles[]"
                                            class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900" >
                                            <option value="">Selectionner la Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role}}">{{$role}}</option>   
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                                    </div> --}}
                                    <div class="mt-1">
                                        <x-input-label for="roles" :value="__('Roles')" />
                                        <select id="roles" name="roles[]"
                                            class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900" multiple>
                                            <option value="">Selectionner la Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role}}">{{$role}}</option>   
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                                    </div>
                                    </div>
                                
                                    <!-- Password -->
                                    <div class="mt-1">
                                        <x-input-label for="password" :value="__('Le    Mot de passe')" />

                                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-1">
                                        <x-input-label for="password_confirmation"
                                            :value="__('Confirmer Le Mot de passe')" />

                                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password" name="password_confirmation" required
                                            autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-1 col-span-2">
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                            href="{{ route('admin.gestionUser') }}">
                                            {{ __('Annuler') }}
                                        </a>

                                        <x-primary-button class="ms-4" style="background-color:green; color:white">
                                            {{ __('Enregistrer') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>