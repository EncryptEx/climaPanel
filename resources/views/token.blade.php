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
                    {{ __("No tokens") }}
                    @endif

                    </p>
               
                    @foreach ($tokens as $token)
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('partials.token-form')
                        </div>
                    </div>
                    <!-- <div class="p-2 text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-800">
                        <p class="text-md">
                            
                        </p>
                    </div> -->
                    <!-- <input type="text" id="tkn{{ $token->name }}" value="{{ $token->plainTextToken }}" class="my-4 w-full rounded bg-white dark:bg-gray-800 dark:border-current" disabled> -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
