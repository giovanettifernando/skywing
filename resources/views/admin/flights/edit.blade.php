<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit flight') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-5 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <form action="{{ route('admin.flights.update', $flight->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="w-full mb-6">
                        <label for="origin" class="block mb-2 ">Origin</label>
                        <input type="text" id="origin" class="w-full rounded"  name="origin" value="{{ $flight->origin }}">
                    </div>

                    <div class="w-full mb-6" >
                        <label for="destination" class="block mb-2 ">Destination</label>
                        <input type="text" id="destination" class="w-full rounded" name="destination" value="{{ $flight->destination }}">
                    </div>

                    <div class="w-full mb-6" name="flight_date">
                        <label for="flight_date" class="block">Flight Date</label>
                        <input type="text" id="flight_date" class="w-full rounded" name="flight_date" value="{{ $flight->flight_date }}">
                    </div>

                    <div class="w-full mb-6">
                        <label for="departure_time" class="block mb-2">Departure Time</label>
                        <input type="text" id="departure_time" class="w-full rounded" name="departure_time" value="{{ $flight->departure_time }}">
                    </div>

                    <div class="w-full mb-6">
                        <label for="arrival_time" class="block mb-2 ">Arrival Time</label>
                        <input type="text" id="arrival_time" class="w-full rounded" name="arrival_time" value="{{ $flight->arrival_time }}">
                    </div>

                    <div class="w-full mb-6" >
                        <label for="company_name" class="block mb-2 ">Company</label>
                        <input type="text" id="company_name" class="w-full rounded" name="company_name" value="{{ $flight->company_name }}">
                    </div>

                    <div class="w-full mb-6" >
                        <label for="gate" class="block mb-2 ">Gate</label>
                        <input type="text" id="gate" class="w-full rounded" name="gate" value="{{ $flight->gate }}">
                    </div>

                    <div class="w-full mb-6" >
                        <label for="price_usd" class="block mb-2 ">Price(USD)</label>
                        <input type="text" id="price_usd" class="w-full rounded" name="price_usd" value="{{ $flight->price_usd }}">
                    </div>

                    <div class="w-full mb-6">
                        <label for="is_active" class="block" >Status</label>
                        <div class="flex justify-start gap-3">
                            <div><input type="radio" class="" name="is_active" value="1" @if($flight->is_active) checked @endif> Active</div>
                            <div><input type="radio" class="" name="is_active" value="0" @if(!$flight->is_active) checked @endif> Inactive</div>
                        </div>
                    </div>

                    <button type="submit" class="px-4 py-2 mt-10 text-xl font-bold text-white transition duration-300 ease-in-out bg-green-700 rounded shadow hover:bg-green-900">Update</button>
                </form>
            </div>
        </div>
    </div>






</x-app-layout>
