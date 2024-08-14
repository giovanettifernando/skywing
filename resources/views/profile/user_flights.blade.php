<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div class="flex-1">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Your booked flights') }}
                </h2>
            </div>
            <div class="flex items-center justify-center flex-shrink-0 w-32 h-8 bg-gray-500 rounded-lg">
                <span class="text-sm font-medium text-white">
                    USD {{ number_format(Auth::user()->wallet_balance / 100, 2) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-4 bg-white rounded shadow">
                    @forelse ($userFlights as $userFlight)
                        <div class="block p-2 m-4">

                            <h1 class="mb-2 text-xl font-bold">
                                {{ $userFlight->flight->origin }} / {{ $userFlight->flight->destination }}
                            </h1>

                            @if($userFlight->flight->logo_url)
                                <div class="mb-2">
                                    <div>
                                        <img src="{{ $userFlight->flight->logo_url }}" alt="{{ $userFlight->flight->company_name }}" class="float-left object-cover w-16 h-16 mx-auto mb-2 mr-4">
                                    </div>
                                    <div>
                                        <p class="italic text-left">{{ $userFlight->flight->company_name }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="italic text-gray-500">Logo not available</p>
                            @endif

                            <p>Date: {{ $userFlight->flight->flight_date }} | Departure at {{ $userFlight->flight->departure_time }} – Arrival at {{ $userFlight->flight->arrival_time }}</p>
                            <p>Price (USD): {{ $userFlight->flight->price_usd }}</p>

                            <a href="{{ url('/flights/' . $userFlight->flight->slug) }}">
                                <button class="block p-1 mt-1 mb-2 text-white bg-gray-500 rounded hover:bg-gray-800">
                                    View Flight Details
                                </button>
                            </a>
                            <hr>
                        </div>

                    @empty
                        <h3>No flights booked</h3>
                    @endforelse
                    <div class="mx-5 mt-1 mb-3">
                        {{ $userFlights->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
