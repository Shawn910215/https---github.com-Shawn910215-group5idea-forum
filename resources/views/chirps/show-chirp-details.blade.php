<x-app-layout>
 <x-slot name="header">
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
   {{ __('Chirp Details') }}
  </h2>
 </x-slot>

 <div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
   <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <!-- Chirp content -->
    <div class="mb-4">
     <h1 class="text-xl font-semibold">{{ $chirp->message }}</h1>
     <p class="text-gray-600">{{ $chirp->user->name }} · {{ $chirp->created_at->format('j M Y, g:i a') }}</p>
    </div>

    <!-- Upvote section -->
    <div class="flex items-center space-x-2 text-gray-600">
     <form method="POST" action="{{ route('chirps.upvote', $chirp) }}">
      @csrf
      <button type="submit" class="focus:outline-none">
       <i class="fas fa-thumbs-up text-gray-400 hover:text-blue-500"></i>
      </button>
     </form>
     <span>{{ $chirp->upvotes->count() }} Upvotes</span>
    </div>



    <!-- add comment -->
    <div class="mt-4">
     <form method="POST" action="{{ route('chirps.comment', $chirp) }}">
      @csrf
      <textarea name="content" placeholder="Write your comment here..." class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
      <x-input-error :messages="$errors->get('content')" class="mt-2" />
      <x-primary-button class="mt-2">{{ __('Comment') }}</x-primary-button>
     </form>
    </div>

    <!-- Comment section -->
    <div class="mt-4">
     <!-- Display comments -->
     @foreach ($chirp->comments as $comment)
     <p class="text-gray-600">{{ $comment->user->name }}: {{ $comment->content }}</p>
     @endforeach
    </div>
   </div>
  </div>
 </div>
</x-app-layout>