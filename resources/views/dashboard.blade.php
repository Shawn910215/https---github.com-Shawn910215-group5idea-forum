<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 dashboard-bg ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="p-6 text-gray-900">
                {{ __("Hello, ") }} {{ Auth::user()->name }} {{ __(".You're logged in!") }}
                <h2 class="text-lg font-semibold mt-4">Weather in Ottawa</h2>
                <p class="mt-2">Temperature: {{ round($weatherData['main']['temp'] - 273.15, 2)}} °C</p>
                <p>Humidity: {{ $weatherData['main']['humidity'] }}%</p>
                <!-- Display other weather information as needed -->
            </div>
        </div>
    </div>
</x-app-layout>