<div>
    <div class="mb-3 d-flex justify-content-between">
        <h4>Projets en cours de recherche</h4>
        <div class="input-container">
            <input style="border:1px solid #ccc; color:#666" class=" focus:none rounded-pill " placeholder="domaine..." wire:model="search">
            <svg class="text-primary" style="width: 15px; height:15px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div>
        <div  class="input-container">
            <input style="border:1px solid #ccc; color:#666" class=" focus-ring rounded-pill" placeholder="sous-domaine...">
            <svg class="text-primary" style="width: 15px; height:15px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th >Intitulé</th>
                <th >Domaine</th>
                <th >Sous domaine</th>
                <th>Description</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($projets)>0)
            @forelse($projets as $projet)
            <tr>
                    <td>{{$projet->intitule_projet}}</td>
                    <td>{{$projet->sous_domaine->domaine->nom_d}}</td>
                    <td>{{$projet->sous_domaine->nom_s}}</td>
                    <td>{{$projet->description_projet}}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            @if (auth('membre')->check())
                                <a href="/gestion/dps1/{{$projet->id}}" class="btn btn-secondary">Détails</a>
                            @elseif (auth()->check())
                                <a href="/gestion/dps/{{$projet->id}}" class="btn btn-secondary">Détails</a>
                            @endif
                        </div>
                    </td>
            </tr>

            @empty
            <tr>
                <td colspan="4">
                    <div>Aucun élement</div>
                </td>
            </tr>
            @endforelse
            @endif
        </tbody>
    </table>
    {{$projets->links('pagination::bootstrap-5')}}
</div>


