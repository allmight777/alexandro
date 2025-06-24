@extends('employee.homedash')
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Mes équipements assignés</h5>
        </div>
        <div class="card-body">
            {{-- Message d’alerte succès/erreur --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Tableau --}}
         @if(count($equipements)>0)
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Photo</th>
                            <th>Date de retour</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Exemple de ligne (à remplacer par ta boucle) --}}
                     @foreach ($equipements as $eq)
                        <tr>
                            <td>{{ $eq->nom }}</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{$eq->id}}">
                                    <img src="/{{$eq->image_path}}" alt="Photo" width="80" class="rounded shadow-sm">
                                </a>
                            </td>
                            <td>{{ $eq->pivot->date_retour ? $eq->pivot->date_retour:"aucune date de retour" }}</td>
                        </tr>
                  
                     @endforeach

                        {{-- Ajoute ici ta boucle avec les données --}}
                    </tbody>
                </table>
            </div>
            @else
                 <span>Aucun equipement pour le moment</span>
            @endif
            @foreach ($equipements as $eq)
                    <div class="modal fade" id="imageModal{{$eq->id}}" tabindex="-1" aria-labelledby="imageModalLabel{{$eq->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel{{$eq->id}}">{{ $eq->nom }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="/{{$eq->image_path}}" class="img-fluid rounded shadow" alt="Image de {{ $eq->nom }}">
                        </div>
                        </div>
                    </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
