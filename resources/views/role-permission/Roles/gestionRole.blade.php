<x-app-layout>

    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                color: #333;
                margin: 0;
                padding: 0;
            }

            table {
                width: 100%;
                border: 1px solid;
                border-radius: 5px;
                margin-bottom: 1rem;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 0.75rem;
                border-bottom: 1px solid #e2e8f0;
            }

            tr.even {
                background-color: #F0F7F5;
            }

            tr.odd {
                background-color: white;
            }




            .add-role-button {
                background-color: #016C01;
                color: white;
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 0.25rem;
                cursor: pointer;
            }

            .add-role-button:hover {
                background-color: #45a049;
            }

            .icon-add {
                margin-right: 0.5rem;
            }

            .icon-modify,
            .icon-delete {
                margin-right: 0.5rem;
                color: #718096;
                cursor: pointer;
            }

            .header-row {
                background-color: #E1F1DF;
                /* Couleur de fond des en-têtes */
                font-weight: bold;
                /* Police en gras pour les en-têtes */
                justify-content: center;
                /* Centrer horizontalement le contenu */
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 5px 10px;
                margin-left: 2px;
                border: 1px solid #ccc;
                border-radius: 3px;
                background-color: #faf0e6;
                color: black;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                background-color: #2f1b0c;
                color: white;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                background-color: #03224c;
                color: white;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
                background-color: #ccc;
                color: #666;
                cursor: default;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
                background-color: #ccc;
                color: #666;
            }
            .table-buttons .button-container {
                        display: flex;
                        align-items: center;
                    }

                    .table-buttons .button-container>* {
                        margin-right: 15px;

                    }

                    .table-buttons .button-container a,
                    .table-buttons .button-container button,
                    .table-buttons .button-container form button[type="submit"] {
                        padding: 10px 16px;
                        border: 1px solid #006622;
                        background-color: #006622;
                        color: white;
                        border-radius: 4px;
                        text-decoration: none;
                        cursor: pointer;
                        transition: background-color 0.3s ease;

                    }

                    .table-buttons .button-container a:hover,
                    .table-buttons .button-container button:hover,
                    .table-buttons .button-container form button[type="submit"]:hover {
                        background-color: #45a049;
                        border-color: #45a049;
                    }

                    /* Delete button style */
                    .table-buttons .button-container form button[type="submit"] {
                        background-color: #f44336;
                        /* Red color */
                        border-color: #f44336;
                        /* Red color */
                    }

                    .table-buttons .button-container form button[type="submit"]:hover {
                        background-color: #d32f2f;
                        /* Darker red for hover */
                        border-color: #d32f2f;
                        /* Darker red for hover */
                    }
        </style>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px; padding-right: 8px;">
            {{ __('Gestion des Roles') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-white-100">
                    <div class="container mx-auto px-4">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold"
                                style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px; padding-right: 8px;">
                                Liste des Roles</h2>
                            <button id="createRoleButton" class="add-role-button toggle-element">
                                <span class="toggle-element"> <i class="fas fa-plus icon-plus"
                                        style="padding: 5px;"></i>
                                    {{ __('Ajouter') }}
                                </span>
                            </button>
                        </div>

                        <table>
                            <thead>
                                <tr class="header-row">
                                    <th style="text-align:center;">Nom Role</th>
                                    <th style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                                        <td>{{ $role->name }}</td>
                                        <td class="table-buttons">
                                            <div style="display: flex; align-items: center;"class="button-container">
                                                <i id="modifyButton_{{ $role->id }}"
                                                    class="fas fa-pencil-alt icon-modify"
                                                    onclick="toggleEditForm('{{ $role->id }}')"
                                                    style="font-size:20px; background-color: #075719; color: white; padding: 7px; border-radius: 3px; width:50px; height:40px; text-align:center;display: flex; justify-content: center; align-items: center; transition: background-color 0.3s;"
                                                    onmouseover="this.style.backgroundColor='#4CAF50';"
                                                    onmouseout="this.style.backgroundColor='#075719';"></i>
                                                <form action="{{ route('admin.deleteRole', $role->id) }}" method="POST"
                                                    onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="icon-delete">
                                                        <i class="fas fa-trash-alt"
                                                            style="font-size:20px;color: white; border-radius: 3px; text-align:center; display: flex; justify-content: center; align-items: center; "></i>
                                                    </button>
                                                </form>

                                                @can('add Permission to Role')
                                                    <a href="{{ route('admin.addPermissionToRole', $role->id) }}">
                                                        Ajouter/Editer Role Permission</a>
                                                @endcan
                                            </div>
                                        </td>



                                    </tr>
                                    <tr id="editRoleFormRow_{{ $role->id }}" style="display: none;">
                                        <form id="editRoleForm_{{ $role->id }}" method="POST"
                                            action="{{ route('admin.updateRole', $role->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <td>
                                                <div>
                                                    <x-text-input id="name" class="block mt-1 w-full"
                                                        type="text" name="name" value="{{ $role->name }}"
                                                        required autofocus autocomplete="name" />
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex items-center justify-center">
                                                    <x-primary-button id="cancelButton_{{ $role->id }}"
                                                        style="background-color:#F73419; color:white;margin-right: 10px; width:500"
                                                        onclick="toggleEditForm('{{ $role->id }}')"
                                                        type="button">Annuler

                                                    </x-primary-button>

                                                    <x-primary-button
                                                        style="background-color:#006622; color:white;">Enregistrer

                                                    </x-primary-button>

                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                <tr id="createRoleFormRow" style="display: none;">
                                    <form id="createRoleForm" method="POST" action="{{ route('ajouterRole.store') }}">
                                        @csrf
                                        <td>
                                            <div>
                                                <x-input-label for="name" :value="__('Name Role')" />
                                                <x-text-input id="name" class="block mt-1 w-full" type="text"
                                                    name="name" :value="old('name')" required autofocus
                                                    autocomplete="name" />
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex items-center justify-center">
                                                <x-primary-button id="cancelCreateRoleButton"
                                                    style="background-color:#f44336; color:white;margin-right: 10px;"
                                                    onclick="toggleCreateForm()" type="button">
                                                    {{ __('Annuler') }}
                                                </x-primary-button>
                                                <x-primary-button style="background-color:green; color:white;">
                                                    {{ __('Enregistrer') }}
                                                </x-primary-button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <script>
                        const toggleElement = document.querySelector('#createRoleButton .toggle-element');

                        document.getElementById('createRoleButton').addEventListener('click', function() {
                            const formRow = document.getElementById('createRoleFormRow');
                            var addButton = document.getElementById('createRoleButton');

                            if (formRow.style.display === 'none') {
                                formRow.style.display = 'table-row';
                                addButton.style.display = 'none'; // Hide both icon and text
                            } else {
                                formRow.style.display = 'none';
                                addButton.style.display = 'inline-block'; // Display both icon and text
                            }
                        });

                        function toggleCreateForm() {
                            var formRow = document.getElementById('createRoleFormRow');
                            var addButton = document.getElementById('createRoleButton');

                            if (formRow.style.display === 'none') {
                                formRow.style.display = 'table-row';
                                addButton.style.display = 'none'; // Hide the icon
                            } else {
                                formRow.style.display = 'none';
                                addButton.style.display = 'inline-block'; // Display the icon
                            }
                        }

                        function toggleEditForm(roleId) {
                            var editFormRow = document.getElementById('editRoleFormRow_' + roleId);
                            var modifyButton = document.getElementById('modifyButton_' + roleId);
                            var cancelButton = document.getElementById('cancelButton_' + roleId);

                            if (editFormRow.style.display === 'none') {
                                editFormRow.style.display = 'table-row';
                                modifyButton.style.display = 'none';
                                cancelButton.style.display = 'block';
                            } else {
                                editFormRow.style.display = 'none';
                                modifyButton.style.display = 'block';
                                cancelButton.style.display = 'none';
                            }
                        }

                        function confirmDelete() {
                            return confirm("Êtes-vous sûr de vouloir supprimer cette Role?");
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
