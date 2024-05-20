<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px;padding-right: 8px;">
            {{ __('Créer Ticket') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-white-100">
                    <div class="container mx-auto px-4">
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
                        <form method="POST" action="{{ route('createTicket.store') }}">
                            @csrf
                            <div class="col-span-8 grid grid-cols-2 gap-4">
                                <!-- type_ticket_id -->
                                <div class="mt-1">
                                    <x-input-label for="type_ticket_id" :value="__('Type de Ticket')" />
                                    <select id="type_ticket_id" name="type_ticket_id"
                                        class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                        <option value="">Selectionner le type</option>
                                        @foreach ($TypeTickets as $TypeTicket)
                                            <option value="{{ $TypeTicket->id }}">{{ $TypeTicket->libelle }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('type_ticket_id')" class="mt-2" />
                                </div>
                                <!-- status -->
                                <div class="mt-1">
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status"
                                        class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                        <option value="">Selectionner le Status</option>
                                        <option value="en_instance">en instance</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                                <!-- num_declaration -->
                                <div class="mt-1">
                                    <x-input-label for="num_declaration" :value="__('num_declaration')" />
                                    <x-text-input id="num_declaration" class="block mt-1 w-full" type="text" name="num_declaration"
                                        :value="old('num_declaration')" required autofocus autocomplete="num_declaration" />
                                    <x-input-error :messages="$errors->get('num_declaration')" class="mt-2" />
                                </div>
                                <!-- agence_id -->
                                <div class="mt-1">
                                    <x-input-label for="agence_id" :value="__('Agence')" />
                                    <select id="agence_id" name="agence_id"
                                        class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                        <option value="">Selectionner Agence</option>
                                        @foreach ($agences as $agence)
                                            <option value="{{ $agence->id }}">{{ $agence->agence }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('agence_id')" class="mt-2" />
                                </div>
                                <!-- client -->
                                <div class="mt-1">
                                    <x-input-label for="client" :value="__('Nom Client')" />
                                    <x-text-input id="client" class="block mt-1 w-full" type="text" name="client"
                                        :value="old('client')" required autofocus autocomplete="client" />
                                    <x-input-error :messages="$errors->get('client')" class="mt-2" />
                                </div>
                                <!-- Code client -->
                                <div class="mt-1">
                                    <x-input-label for="code_client" :value="__('Code Client')" />
                                    <x-text-input id="code_client" class="block mt-1 w-full" type="text"
                                        name="code_client" :value="old('code_client')" required autofocus
                                        autocomplete="code_client" />
                                    <x-input-error :messages="$errors->get('code_client')" class="mt-2" />
                                </div>

                                <!-- description -->
                                <div class="mt-1">
                                    <x-input-label for="description" :value="__('Description')" />
                                    <textarea id="description"style="resize: none"
                                        class="block mt-1 w-full h-20 px-4 py-2 border border-gray-300 rounded-md shadow-sm resize-none focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900"
                                        name="description" :value="old('description')" required autofocus autocomplete="description"></textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <!-- resolution -->
                                <div class="mt-1">
                                    <x-input-label for="resolution" :value="__('Résolution')" />
                                    <textarea id="resolution" style="resize: none; background-color: #f2f2f2; color: #999; border-color: #ddd;" class="block mt-1 w-full h-20 px-4 py-2 border border-gray-300 rounded-md shadow-sm resize-none focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900" name="resolution" :value="old('resolution')" required autofocus autocomplete="resolution" disabled></textarea>
                                    <x-input-error :messages="$errors->get('resolution')" class="mt-2" />
                                </div>
                                <!-- assigned_to -->
                                <div class="mt-1">
                                    <x-input-label for="assigned_to" :value="__('Assigné à')" />
                                    <select id="assigned_to" name="assigned_to"
                                        class="block w-full px-4 py-2 mt-1 text-base text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:text-black dark:border-gray-600 dark:bg-white dark:focus:border-gray-500 dark:focus:ring-gray-900">
                                        <option value="">Sélectionner un utilisateur</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->agence->agence . '/' . $user->name . ' ' . $user->Prenom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-1 col-span-2">
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                    href="{{ route('user.gestionTicket') }}">
                                    {{ __('Annuler') }}
                                </a>

                                <x-primary-button class="ms-4" style="background-color:green; color:white">
                                    {{ __('Enregistrer') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
