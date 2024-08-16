<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Flights Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-end w-full mb-10">
                <a href="{{ route('admin.flights.create') }}" class="px-4 py-2 font-bold text-white transition duration-300 ease-in-out bg-green-700 shadow hover:bg-green-900">New</a>
            </div>
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <table class="w-full p-4 bg-white rounded shadow">
                    <thead>
                        <tr>
                            <th class="px-2 py-4 text-left">#</th>
                            <th class="px-2 py-4 text-left">Origin/Destination</th>
                            <th class="px-2 py-4 text-left">Flight Date</th>
                            <th class="px-2 py-4 text-left">Departure Time</th>
                            <th class="px-2 py-4 text-left">Company</th>
                            <th class="px-2 py-4 text-left">Created At</th>
                            <th class="px-2 py-4 text-left">Status</th>
                            <th class="px-2 py-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($flights as $index => $flight)
                            <tr>
                                <td class="px-2 py-4 text-left">{{ $index + 1 }}</td> <!-- Index incrementado para a coluna # -->
                                <td class="px-2 py-4 text-left">
                                    <a href="{{ url('/admin/flights/' . $flight->slug) }}" class="hover:underline">
                                        {{ $flight->origin . ' / ' . $flight->destination }}
                                    </a>
                                </td>
                                <td class="px-2 py-4 text-left">{{ $flight->flight_date }}</td>
                                <td class="px-2 py-4 text-left">{{ $flight->departure_time }}</td>
                                <td class="px-2 py-4 text-left">{{ $flight->company_name }}</td>
                                <td class="px-2 py-4 text-left">{{ $flight->created_at->format('Y/m/d H:i:s') }}</td>
                                <td class="px-2 py-4 text-left">
                                    <span class="font-bold {{ $flight->is_active ? 'text-green-800' : 'text-red-800' }}">{{ $flight->is_active ? 'Active' : 'Inactive' }}</span>
                                </td>

                                <td class="flex gap-2 px-2 py-4 text-left">
                                    <a href="{{ route('admin.flights.edit', $flight->id) }}"
                                        class="px-4 py-2 font-bold text-white transition duration-300 bg-blue-700 rounded shadow hover:bg-blue-900 ease-in-ou">Edit
                                    </a>

                                    <form action="{{ route('admin.flights.destroy', $flight->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-4 py-2 font-bold text-white transition duration-300 ease-in-out bg-red-700 rounded shadow text-bold hover:bg-red-900">Delete</button>
                                    </form>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $flights->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
