<div>
    <form method="post" action="{{ route('delToken', $token->id) }}">
        @csrf
        @method('delete')

        <div class="flex items-center gap-4">
            <span class="text-lg"><b>Token:</b> {{ $token->name }}</span>
        
            
            <x-danger-button>{{ __('Delete') }}</x-danger-button>
        </div>
    </form>
</div>
