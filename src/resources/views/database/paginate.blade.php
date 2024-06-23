<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Database') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <!-- Table responsive wrapper -->


                    <!-- Table -->
                    <table class="min-w-full text-left text-sm whitespace-nowrap">

                        <!-- Table head -->
                        <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                        <tr>
                            <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                id
                            </th>
                            <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                Email
                            </th>
                        </tr>
                        </thead>

                        <!-- Table body -->
                        <tbody>
                        @foreach($users as $user)
                        <tr class="border-b dark:border-neutral-600">
                            <th scope="row" class="px-6 py-4 border-x dark:border-neutral-600">
                                {{$user->id}}
                            </th>
                            <td class="px-6 py-4 border-x dark:border-neutral-600">{{$user->name}}</td>
                            <td class="px-6 py-4 border-x dark:border-neutral-600">{{$user->email}}</td>
                        </tr>
                        @endforeach


                        </tbody>

                    </table>
            </div>

            <div class="paginate">
                {{$users->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
