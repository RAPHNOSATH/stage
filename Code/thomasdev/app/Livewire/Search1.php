<?php

namespace App\Livewire;

use App\Models\Projet;
use Livewire\Component;
use Livewire\WithPagination;

class Search1 extends Component
{
    use WithPagination;
    public string $search = '';
    public function render()
    {
        $projetQuery = Projet::query();
        if(!empty($this->search)){
            $projetQuery->where('intitule_projet', 'like', '%' . $this->search . '%');
        }
        $projets = $projetQuery->where('est_accepte','true')->where('en_recherche','false')->paginate(10);

        return view('livewire.search1',compact('projets'));
    }
}
