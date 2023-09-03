<section>
    <form method="post" action="{{ route('delToken', $token->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('delete')

        <div class="flex items-center gap-4">
            <span class="text-lg"><b>Name:</b> {{ $token->name }}</span>
            <x-primary-button>{{ __('Delete') }}</x-primary-button>
        </div>
    </form>
</section>
