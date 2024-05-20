<x-app-layout>

    @if (session('status'))
                    <div class="alert alert-success">{{session('statuts')}}</div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-BLACK-200 leading-tight"
            style="display: inline-block; border-bottom: 3px solid #006622; padding-left: 8px;padding-right: 8px;">
            {{ __('Ajouter Permission to Role') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900 dark:text-white-100">
                    <h1 style="font-size: 2.5rem; border-bottom: 2px solid #006622; margin-bottom: 1rem;"
                            class="heading">
                            {{ __('Role :') }} {{$role->name}}</h1>
                    <form method="POST" action="{{ route('admin.givePermissionToRole', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="">Permissions</label>
                            <div>
                                @foreach($permissions as $permission)
                                    <div>
                                        <label for="">
                                            <input 
                                              type="checkbox"
                                              name="permission[]"
                                              value="{{$permission->name}}"
                                              {{in_array($permission->id,$rolePermissions) ? 'checked' : ''  }}
                                            />
                                            {{$permission->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-1 col-span-2">
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('admin.gestionRole') }}">
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
</x-app-layout>