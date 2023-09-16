<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Account Tokens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-2xl">
                        @if (count($tokens) != 0)
                    {{ __("Curent Active Tokens:") }}
                    @else
                    {{ __("No active tokens") }}
                    @endif

                    </p>
                    
                    @foreach ($tokens as $token)
                    <div class="p-4 mt-7 sm:p-5 my-2 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('partials.delete-token-form')
                        </div>
                    </div>
                    @endforeach
                    @if (isset ($newTokenName))
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                                <p class="text-lg"><b>Name:</b> {{ $newTokenName }}</p>
                                <p class="text"><pre>{{ $newTokenCode }}</pre></p>
                            </div>
                        </div>
                    @endif
                    
                </div>
                
            </div>
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-2xl">
                        {{ __("Create a new token") }}
                    </p>
                    @include('partials.create-token-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
