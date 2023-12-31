<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('chirps.store') }}">
            @csrf
            <textarea name="message" placeholder="{{ __('What\'s on your mind?') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Publish Idea') }}</x-primary-button>
        </form>
        <!-- display the Chirps below our form -->
        <div class="mt-6 space-y-4">
            @foreach ($chirps as $chirp)
            <div class="bg-black p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span class="text-gray-800 mr-1">{{ $chirp->user->name }}</span>
                        <small class="text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                        <!-- edit page -->
                        @unless ($chirp->created_at->eq($chirp->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                    </div>
                    @if ($chirp->user->is(auth()->user()))
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                {{ __('Edit') }}
                            </x-dropdown-link>
                            <!-- delete button -->
                            <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                @csrf
                                @method('delete')
                                <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @endif
                </div>
                <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
                <!-- Link to chirp details -->
                <div class="text-right mt-2">
                    <a href="{{ route('chirps.show', $chirp) }}" class="flex items-center text-blue-500 hover:underline justify-end">
                        <span class="mr-1">View Details ({{ $chirp->comments->count() }} comments, {{ $chirp->upvotes->count() }} upvotes)</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block text-gray-500 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
