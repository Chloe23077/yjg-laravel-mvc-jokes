<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Permissions for ') }} {{ $user->name }}
        </h2>
    </x-slot>

    <article class="-mx-4">
        <header class="bg-zinc-700 text-zinc-200 rounded-t-lg -mx-4 -mt-8 p-8 text-2xl font-bold flex flex-row items-center">
            <h2 class="grow">
                Permissions for {{ $user->name }}
            </h2>
            <div class="order-first">
                <i class="fa-solid fa-user min-w-8 text-white"></i>
            </div>
        </header>

        <div class="flex flex-col flex-wrap my-4 mt-8">
            <section class="grid grid-cols-1 gap-4 px-4 mt-4 sm:px-8">

                <section class="min-w-full items-center bg-zinc-50 border border-zinc-600 rounded overflow-hidden">

                    <form action="{{ route('users.updatePermissions', ['user' => $user->id]) }}" method="POST" class="p-6">
                        @csrf

                        <div class="field mb-4">
                            <label class="tag is-info">{{ $user->name }}</label>
                            <div class="control">
                                @foreach($permissions as $permission)
                                    <label class="checkbox">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        {{ $permission->name }}
                                    </label>
                                    <br>
                                @endforeach
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="btn btn-warning btn-sm mt-2 mb-2">
                                    <i class="fa-solid fa-save pr-2 order-first"></i>
                                    Update Permissions
                                </button>
                            </div>
                            <div class="control">
                                <a href="{{ route('users.index') }}" class="btn btn-info btn-sm mt-2">
                                    <i class="fa-solid fa-arrow-left pr-2 order-first"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                    </form>

                </section>

            </section>
        </div>
    </article>

</x-app-layout>
