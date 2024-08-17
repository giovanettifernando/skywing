<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div class="flex-1">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Flight details') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-4 bg-white rounded shadow">
                    <div class="flex items-center mb-4 space-x-4">
                        @if($flight->logo_url)
                            <div class="flex-shrink-0">
                                <img src="{{ $flight->logo_url }}" alt="{{ $flight->company_name }}" class="object-cover w-16 h-16">
                            </div>
                            <div>
                                <p class="text-xl font-bold">{{ $flight->company_name }}</p>
                            </div>
                        @else
                            <div class="flex-shrink-0">
                                <p class="italic text-gray-500">Logo not available</p>
                            </div>
                        @endif
                    </div>

                    <div>
                        <h1 class="mb-2 text-xl font-bold">
                            {{ $flight->origin }} / {{ $flight->destination }}
                        </h1>
                        <p>Flight Date: {{ $flight->flight_date }}</p>
                        <p>Departure at {{ $flight->departure_time }}</p>
                        <p>Arrival at {{ $flight->arrival_time }}</p>
                        <p>Gate: {{ $flight->gate }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <table class="w-full p-4 bg-white rounded shadow">
                    <thead>
                        <tr>
                            <th class="px-2 py-4 text-left">#</th>
                            <th class="px-2 py-4 text-left">Name</th>
                            <th class="px-2 py-4 text-left">E-mail</th>
                            <th class="px-2 py-4 text-left">Seat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userFlights as $index => $userFlight)
                            <tr>
                                <td class="px-2 py-4 text-left">{{ $index + 1 }}</td>
                                <td class="px-2 py-4 text-left">{{ $userFlight->name }}</td>
                                <td class="px-2 py-4 text-left">{{ $userFlight->email }}</td>
                                <td class="px-2 py-4 text-left">{{ $userFlight->pivot->seat_number }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
