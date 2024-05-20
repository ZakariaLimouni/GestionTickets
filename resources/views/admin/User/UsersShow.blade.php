<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px;padding-right: 8px;">
            {{$user->name}} {{$user->Prenom}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-white-100">
                    <head>
                        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        .user-info-container {
                            display: flex;
                            align-items: center;
                            margin-bottom: 20px;
                        }

                        .user-info-container img {
                            margin-right: 20px;
                            width: 200px;
                            height: 200px;
                        }

                        .user-details {
                            font-size: 1.2rem;
                        }

                        .user-details > div {
                            margin-bottom: 10px;
                        }
                    </style>
                    </head><b>
                    <h1 style="font-size: 15px; border-bottom: 2px solid #006622; margin-bottom: 1rem; text-align:center">
                        {{ __('Tous les Informations sur')   }} {{$user->name}} {{$user->Prenom}}</h1></b>
                    <div style="border:2px solid #006622 ;padding: 10px;">
                        <div class="user-info-container">
                            @if($user->photo_profile)
                                <img src="{{ Storage::url($user->photo_profile) }}" alt="Profile Photo">
                            @endif
                            <div class="user-details">
                                <div><strong>Matricule:</strong> {{ $user->Matricule }}</div>
                                <div><strong>Nom:</strong> {{ $user->name }}</div>
                                <div><strong>Prénom:</strong> {{ $user->Prenom }}</div>
                            </div>
                        </div>
                        <div>
                            <div><strong>Rôle:</strong>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $rolename)
                                        <span class="badge badge-success">{{ $rolename }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div><strong>Ville:</strong> {{ $user->ville->ville }}</div>
                            <div><strong>Agence:</strong> {{ $user->agence->agence }}</div>
                            <div><strong>Email:</strong> {{ $user->email }}</div>
                            <div><strong>Numéro de téléphone:</strong> {{ $user->Telephone }}</div>
                            <div><strong>Status:</strong> {{ $user->status }}</div>
                        </div>
                        {{-- <form method="post" action="{{ route('admin.updateUserPassword', $user->id) }}"
                            class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div>
                                <x-input-label for="update_password_password" :value="__('Nouveau Mot de passe')" />
                                <x-text-input id="update_password_password" name="password" type="password"
                                    class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password_confirmation"
                                    :value="__('Confirmation du Nouveau Mot de passe')" />
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                    type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"
                                    class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button style="color:white;background-color:green">{{ __('Enregistrer') }}
                                </x-primary-button><br>
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif

                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
