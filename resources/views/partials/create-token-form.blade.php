<section>
    <form method="post" action="{{ route('createToken') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div class="items-center gap-4">
            <div>
                <x-input-label for="token_name" :value="__('Token\'s Name')" />
                <x-text-input id="token_name" name="token_name" type="text" class="mt-1 block w-full" />
            </div>
            <br>
            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>
    </form>
</section>
