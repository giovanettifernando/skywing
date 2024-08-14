<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div class="flex-1">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Boarding Pass') }}
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
                        <h2>Passenger: {{ Auth::user()->name }}</h2>
                        <p>Flight Date: {{ $flight->flight_date }}</p>
                        <p>Departure at {{ $flight->departure_time }}</p>
                        <p>Arrival at {{ $flight->arrival_time }}</p>
                        <p>Gate: {{ $flight->gate }}</p>
                        <p>Seat: {{ $userFlight->seat_number }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
