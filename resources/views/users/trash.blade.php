<div class="flex flex-col flex-wrap my-4 mt-8">
    <section class="grid grid-cols-1 gap-4 px-4 mt-4 sm:px-8">

        <section class="min-w-full items-center bg-zinc-50 border border-zinc-600 rounded overflow-hidden">

            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                <thead
                    class="border-b border-neutral-200 bg-zinc-800 font-medium text-white dark:border-white/10">
                <tr>
                    <th scope="col" class="px-6 py-4">#</th>
                    <th scope="col" class="px-6 py-4">Name</th>
                    <th scope="col" class="px-6 py-4">eMail</th>
                    <th scope="col" class="px-6 py-4">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr class="border-b border-zinc-300 dark:border-white/10">
                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $loop->index + 1 }}</td>
                        <td class="whitespace-nowrap px-6 py-4">{{ $user->name }}</td>
                        <td class="whitespace-nowrap px-6 py-4 w-full">{{ $user->email }}</td>
                        <td class="whitespace-nowrap px-6 py-4">
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
{{--                            @if($user->trashed())--}}
                            <form action="{{ route('users.restore', $user) }}" method="POST" class="flex gap-4">
                                @csrf
                                @method('PATCH')
                                <x-secondary-button type="submit" class="bg-zinc-200">
                                    <span>Restore</span>
                                    <i class="fa-solid fa-undo pr-2 order-first"></i>
                                </x-secondary-button>
                            </form>
{{--                            @endif--}}

                            <form action="{{ route('users.forceDelete', $user) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button type="submit" class="bg-zinc-200">
                                    <span>Force Delete</span>
                                    <i class="fa-solid fa-times pr-2 order-first"></i>
                                </x-secondary-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </section>

    </section>

</div>
