<?php

namespace Fpaipl\Panel\Http\Livewire;

use Livewire\Component;
use Fpaipl\Brandy\Models\Party;

class AddSearchSelect extends Component
{
    public $search;
    public $selectedParty;
    public $label;

    public $partyName;
    public $partyMobile;
    public $partyGstin;
    public $partyEmail;

    public $datalist;
    public $modelCreateRoute;

    public function mount($datalist, $label, $modelCreateRoute)
    {
        $this->label = $label;
        $this->datalist = $datalist;
        $this->modelCreateRoute = $modelCreateRoute;
        $this->search = '';
        $this->selectedParty = null;
    }

    public function getFilteredPartiesProperty()
    {
        return strlen($this->search) > 2 
            ? $this->datalist->filter(function ($party) {
                return stripos($party->tags, $this->search) !== false;
            }) : collect();
    }

    public function selectParty($partyId)
    {
        $this->selectedParty = Party::find($partyId);
        $this->search = '';
        $this->emitUp('selectedParty', $this->selectedParty->id);
    }

    public function removeParty($partyId)
    {
        $this->selectedParty = null;
        $this->search = '';
    }

    public function render()
    {
        return view('panel::livewire.add-search-select');
    }
}
