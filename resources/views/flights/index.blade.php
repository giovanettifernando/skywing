<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div class="flex-1">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Your next destination is here!') }}
                </h2>
            </div>
            @auth
                <div class="flex items-center justify-center flex-shrink-0 w-32 h-8 bg-gray-500 rounded-lg">
                    <span class="text-sm font-medium text-white">
                        USD {{  number_format($user->wallet_balance / 100, 2,) }}
                    </span>
                </div>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-200 rounded alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-red-800 bg-red-200 rounded alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @auth
            <div class="flex justify-end w-full mb-10">
                <form method="POST" action="{{ route('wallet.add') }}" class="flex items-center space-x-4">
                    @csrf
                    <input type="number" name="amount" id="amount" class="w-24 p-2 border rounded-lg" min="0" required placeholder="USD 0.00">
                    <button type="submit" class="px-4 py-1 text-white bg-gray-500 rounded-lg hover:bg-gray-700">Add</button>
                </form>
            </div>
            @endauth

            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <table class="w-full p-4 bg-white rounded shadow">
                    @forelse ($flights as $flight)
                        @php
                            $isBooked = Auth::check() ? Auth::user()->flights->contains($flight->id) : false;
                        @endphp
                        <div class="block p-2 m-4">
                            <h1 class="mb-2 text-xl font-bold">{{ $flight->origin }} / {{ $flight->destination }}</h1>

                            @if($flight->logo_url)
                                <div class="mb-2">
                                    <div>
                                        <img src="{{ $flight->logo_url }}" alt="{{ $flight->company_name }}" class="float-left object-cover w-16 h-16 mx-auto mb-2 mr-4">
                                    </div>
                                    <div>
                                    <p class="italic text-left">{{ $flight->company_name }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="italic text-gray-500">Logo not available</p>
                            @endif

                            <p>Date: {{ $flight->flight_date }} | Departure at {{ $flight->departure_time }} – Arrival at {{ $flight->arrival_time }}</p>
                            <p>Price (USD): {{ $flight->price_usd }}</p>
                            @auth
                                <form action="{{ route('flights.book', $flight) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="block p-1 mt-1 mb-2 text-white rounded align-left
                                            {{ $isBooked ? 'bg-gray-800 cursor-not-allowed' : 'bg-gray-500 hover:bg-gray-800' }}"
                                        {{ $isBooked ? 'disabled' : '' }}>
                                        {{ $isBooked ? 'Booked' : 'Book now' }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('login') }}" method="GET">
                                    <button
                                        type="submit"
                                        class="block p-1 mt-1 mb-2 text-white bg-gray-500 rounded align-left hover:bg-gray-800">
                                        Book now
                                    </button>
                                </form>
                            @endauth
                            <hr>
                        </div>

                        @empty
                            <h3>Nenhum vôo disponível</h3>
                        @endforelse
                    <div class="mx-5 mt-1 mb-3">
                        {{ $flights->links() }}
                    </div>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
