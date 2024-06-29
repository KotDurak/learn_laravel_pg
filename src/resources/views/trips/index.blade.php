<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trips') }}
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
                            Route
                        </th>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Description
                        </th>
                        <th scope="col">
                            Status
                        </th>
                    </tr>
                    </thead>

                    <!-- Table body -->
                    <tbody>
                    @foreach($trips as $trip)
                        <tr class="border-b dark:border-neutral-600">
                            <th scope="row" class="px-6 py-4 border-x dark:border-neutral-600">
                                {{$trip->id}}
                            </th>
                            <td class="px-6 py-4 border-x dark:border-neutral-600">{{$trip->route}}</td>
                            <td class="px-6 py-4 border-x dark:border-neutral-600">{{$trip->description}}</td>
                            <td class="px-6 py-4 border-x dark:border-neutral-600">{{$trip->status}}</td>
                        </tr>
                    @endforeach


                    </tbody>

                </table>
            </div>

            <div class="paginate">
                {{$trips->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
