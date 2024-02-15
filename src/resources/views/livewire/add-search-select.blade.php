<div class="d-flex rounded w-100 h-100 align-items-start">
    <button type="button" class="btn btn-light rounded-0 rounded-start border py-3">
        <i class="bi bi-search px-2"></i>
    </button>
    <div class="flex-fill border-top border-bottom h-100" style="max-height: 57px;">
        @if ($selectedParty)
            <div class="d-flex justify-content-between align-items-center h-100 overflow-hidden">
                @include('panel::includes.select-option-card', [
                    'selectedParty' => $selectedParty,
                ])
                <button class="btn btn-light h-100 border-0 rounded-0" wire:click="removeParty({{ $selectedParty->id }})">
                    <i class="bi bi-x-lg text-danger px-2"></i>
                </button>
            </div>
        @else
            <input 
                id="partySearchInput" 
                type="search" 
                wire:model.live="search" 
                class="form-control border-0 rounded-0 text-bg-light w-100 h-100" 
                placeholder="{{ $label }}"
                autocomplete="off"
            >    
            @if ($this->filteredParties->isNotEmpty())
                <ul class="list-group rounded-0" style="z-index: 10000;">
                    @foreach ($this->filteredParties as $party)
                        <li class="list-group-item list-group-flush px-2" wire:click="selectParty({{ $party->id }})">
                            @include('panel::includes.select-option-card', [
                                'selectedParty' => $party,
                            ])
                        </li>
                    @endforeach
                </ul>
            @else
                @if (strlen($search) > 2)
                    <div class="p-2">No results found</div>
                @endif
            @endif
        @endif
    </div>
    <a class="btn btn-light rounded-0 rounded-end border py-3" href="{{ route($modelCreateRoute) }}">
        <i class="bi bi-plus-lg px-2"></i>
    </a>
</div>



