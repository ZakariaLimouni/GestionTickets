

<x-app-layout>
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

        .heading {
            font-size: 21px;
        }

        .search-bar {
            margin-bottom: 1rem;
        }

        .search-input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            margin-right: 10px;
        }

        .search-criteria {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 150px;
        }

        /* Votre style personnalisé ici */
        .button-container {
            display: flex;
            gap: 5px;
        }

        .button-container button,
        .button-container a {
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover,
        .button-container a:hover {
            background-color: #005a55;
            color: white;
        }

        .blocked-user {
            background-color: #ff8080 !important;
        }

        .en_attente-user {
            background-color: #007bff !important;
        }

        /* Style pour le tableau */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Style pour les cellules */
        table td,
        table th {
            border: 1px solid #ddd;
            padding: 10px;

        }

        table th {
            text-align: center;
            background-color: #E1F1DF;
        }

        /* Style pour les boutons dans les cellules */
        .button-container button,
        .button-container a {
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
            margin-right: 5px
        }

        .button-container button:hover,
        .button-container a:hover {
            background-color: #0056b3;
        }

        /* Style pour les utilisateurs bloqués */
        .blocked-user {
            background-color: #ff8080 !important;
        }

        /* Style pour les utilisateurs en attente */
        .en_attente-user {
            background-color: #007bff !important;
        }

        /* Style pour les badges de rôle */
        .badge {
            background-color: #28a745;
            color: white;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 0.8rem;
        }

        /* Style pour la pagination */
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        /* Style pour la liste des utilisateurs */
        table tbody {
            font-size: 0.9rem;
            /* Taille de police réduite */
        }

        table tbody td {

            /* Texte en gras */
        }

        /* Alignement avec le champ de recherche */
        .heading-container {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px;padding-right: 8px;">
            {{ __('Gestion des Utilisateurs') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-white-100">
                    <div class="heading-container">
                        <h1 style=" border-bottom: 2px solid #006622; margin-bottom: 1rem; " class="heading"><b>
                                {{ __('Liste des utilisateurs') }}</h1></b>
                        <div class="search-bar">
                            <input type="text" id="searchInput" class="search-input" placeholder="Recherche..."
                                onkeyup="filterUsers()">
                            <select id="searchCriteria" class="search-criteria" onchange="filterUsers()">
                                <option value="matricule">Matricule</option>
                                <option value="name">Nom</option>
                                <option value="prenom">Prénom</option>
                            </select>
                        </div>
                    </div><br>
                    <script>
                        function filterUsers() {
                            var input, filter, table, tr, td, i, txtValue, criteria;
                            input = document.getElementById("searchInput");
                            filter = input.value.toUpperCase();
                            table = document.querySelector("table");
                            tr = table.getElementsByTagName("tr");
                            criteria = document.getElementById("searchCriteria").value;

                            console.log("Selected criteria:", criteria); // Add this line for debugging

                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[criteria === 'matricule' ? 0 : criteria === 'name' ?
                                    1 : 2];
                                if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                }
                            }
                        }
                    </script>
                    <table>
                        <thead>
                            <tr>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Rôles</th>
                                <th>Date de Création</th>
                                <th>Dernier Connexion</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if ($user->status === 'blocked')
                                    <tr class="{{ $user->status === 'blocked' ? 'blocked-user' : '' }}">
                                        <td>{{ $user->Matricule }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->Prenom }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                    <span class="badge badge-success">{{ $rolename }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y/m/d') }}</td>
                                        <td>{{$user->last_login_at}}</td>
                                        <td class="table-buttons">
                                            <div class="button-container">
                                                <a href="{{ route('admin.showUser', ['id' => $user->id]) }}"
                                                    style="background-color: #20595D;background-color 0.3s;
                                                    "onmouseover="this.style.backgroundColor='#3b767c ';"
                                                    onmouseout="this.style.backgroundColor='#20595D';"
                                                    class="button-style"> <i
                                                        class="fas fa-eye"></i></a>
                                                @can('update user')
                                                <a
                                                    href="{{ route('admin.editUser', $user->id) }}"style="background-color: #075719;transition: background-color 0.3s;
                                                    "onmouseover="this.style.backgroundColor='#4CAF50';"
                                                    onmouseout="this.style.backgroundColor='#075719';"
                                                    class="button-style">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('unblocker user')
                                                    <form action="{{ route('admin.unblockUser', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="block-button"
                                                            style="background-color: #007bff; background-color 0.3s;
                                                            "onmouseover="this.style.backgroundColor='#0066ff ';"
                                                            onmouseout="this.style.backgroundColor='#007bff';"
                                                            class="button-style"> <i
                                                                class="fas fa-ban"></i></button>
                                                    </form>
                                                @endcan
                                                @can('delete user')
                                                    <form action="{{ route('admin.deleteUser', $user->id) }}"
                                                        method="POST" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="background-color: #6C1E0B;transition: background-color 0.3s;
                                                        "onmouseover="this.style.backgroundColor='#8c3820';"
                                                        onmouseout="this.style.backgroundColor='#6C1E0B';"
                                                        class="button-style">
                                                            <i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endcan

                                                <script>
                                                    function confirmDelete() {

                                                        return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?");
                                                    }
                                                </script>
                                            </div>
                                        </td>
                                    </tr>
                                @elseif($user->status === 'en_attente')
                                    <tr class="{{ $user->status === 'en_attente' ? 'en_attente-user' : '' }} "
                                        style="background-color: #007bff;">
                                        <td>{{ $user->Matricule }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->Prenom }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                    <span class="badge badge-success">{{ $rolename }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y/m/d') }}</td>
                                        <td>{{$user->last_login_at}}</td>
                                        <td class="table-buttons">
                                            <div class="button-container">
                                                <a href="{{ route('admin.showUser', ['id' => $user->id]) }}"
                                                    style="background-color: #075719;">Afficher</a>
                                                <a href="{{ route('admin.editUser', $user->id) }}"
                                                    style="background-color: #20595D;"><i class="fas fa-pencil-alt"></a>
                                                <form action="{{ route('admin.validateUser', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        style="background-color: #007bff; border: 1px solid #0066cc; cursor: pointer; transition: background-color 0.3s ease;"
                                                        class="unblock-button">Valider</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ $user->Matricule }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->Prenom }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                    <span class="badge badge-success">{{ $rolename }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y/m/d') }}</td>
                                        <td>{{$user->last_login_at}}</td>
                                        <td class="table-buttons">
                                            <div class="button-container">
                                                <a href="{{ route('admin.showUser', ['id' => $user->id]) }}"
                                                    style="background-color: #20595D;background-color 0.3s;
                                                    "onmouseover="this.style.backgroundColor='#3b767c ';"
                                                    onmouseout="this.style.backgroundColor='#20595D';"
                                                    class="button-style"> <i
                                                        class="fas fa-eye"></i></a>
                                                @can('update user')
                                                <a
                                                    href="{{ route('admin.editUser', $user->id) }}"style="background-color: #075719;transition: background-color 0.3s;
                                                    "onmouseover="this.style.backgroundColor='#4CAF50';"
                                                    onmouseout="this.style.backgroundColor='#075719';"
                                                    class="button-style">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('blocker user')
                                                    <form action="{{ route('admin.blockUser', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="block-button"
                                                            style="background-color: #ff0000; background-color 0.3s;
                                                            "onmouseover="this.style.backgroundColor='#cc0000 ';"
                                                            onmouseout="this.style.backgroundColor='#ff0000';"
                                                            class="button-style"> <i
                                                                class="fas fa-ban"></i></button>
                                                    </form>
                                                @endcan
                                                @can('delete user')
                                                    <form action="{{ route('admin.deleteUser', $user->id) }}"
                                                        method="POST" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="background-color: #6C1E0B;transition: background-color 0.3s;
                                                        "onmouseover="this.style.backgroundColor='#8c3820';"
                                                        onmouseout="this.style.backgroundColor='#6C1E0B';"
                                                        class="button-style">
                                                            <i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endcan

                                                <script>
                                                    function confirmDelete() {

                                                        return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?");
                                                    }
                                                </script>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
