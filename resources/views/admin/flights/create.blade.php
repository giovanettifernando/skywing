<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create new flight') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-5 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <form action="{{ route('admin.flights.store') }}" method="post">
                    @csrf
                    <!-- essa diretiva vai gerar um input com as configurações name _token value token -->
                    <div class="w-full mb-6">
                        <label for="" class="block mb-2 ">Origin</label>
                        <input type="text" class="w-full rounded"  name="origin">
                        @error('origin')
                            <div class="w-full p-2 mt-2 font-bold text-red-700 bg-red-200 border border-red-700 rounded">
                               {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full mb-6" >
                        <label for="" class="block mb-2 ">Destination</label>
                        <input type="text" class="w-full rounded" name="destination">
                        @error('destination')
                            <div class="w-full p-2 mt-2 font-bold text-red-700 bg-red-200 border border-red-700 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full mb-6" name="flight_date">
                        <label for="" class="block">Flight Date</label>
                        <input type="text" class="w-full rounded" name="flight_date">
                        @error('flight_date')
                            <div class="w-full p-2 mt-2 font-bold text-red-700 bg-red-200 border border-red-700 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full mb-6">
                        <label for="" class="block mb-2">Departure Time</label>
                        <input type="text" class="w-full rounded" name="departure_time">
                        @error('departure_time')
                            <div class="w-full p-2 mt-2 font-bold text-red-700 bg-red-200 border border-red-700 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full mb-6">
                        <label for="" class="block mb-2 ">Arrival Time</label>
                        <input type="text" class="w-full rounded" name="arrival_time">
                    </div>

                    <div class="w-full mb-6" >
                        <label for="" class="block mb-2 ">Company</label>
                        <input type="text" class="w-full rounded" name="company_name">
                        @error('company_name')
                            <div class="w-full p-2 mt-2 font-bold text-red-700 bg-red-200 border border-red-700 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full mb-6" >
                        <label for="" class="block mb-2 ">Gate</label>
                        <input type="text" class="w-full rounded" name="gate">
                        @error('gate')
                            <div class="w-full p-2 mt-2 font-bold text-red-700 bg-red-200 border border-red-700 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full mb-6" >
                        <label for="" class="block mb-2 ">Price(USD)</label>
                        <input type="text" class="w-full rounded" name="price_usd">
                        @error('price_usd')
                            <div class="w-full p-2 mt-2 font-bold text-red-700 bg-red-200 border border-red-700 rounded">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full mb-6">
                        <label for="" class="block" >Status</label>
                        <div class="flex justify-start gap-3">
                            <div><input type="radio" class="" name="is_active" value="1" checked> Active</div>
                            <div><input type="radio" class="" name="is_active" value="0"> Inactive</div>
                        </div>
                    </div>

                    <button class="px-4 py-2 mt-10 text-xl font-bold text-white transition duration-300 bg-green-700 rounded shadow hover:bg-green-900 ease-in-ou">Create</button>
                </form>
            </div>
        </div>
    </div>



</x-app-layout>
