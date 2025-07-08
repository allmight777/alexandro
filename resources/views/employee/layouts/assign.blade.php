@extends('employee.homedash')

@section('content')
<div class="container" style="margin-top:74px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Mes équipements assignés</h5>
        </div>
        <div class="card-body">
            {{-- Message d’alerte succès --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            {{-- Tableau --}}
            @if(count($equipements) > 0)
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
                            @foreach ($equipements as $eq)
                                <tr>
                                    <td class="text-wrap">{{ $eq->nom }}</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $eq->id }}">
                                            <img src="/{{ $eq->image_path }}" alt="Photo" class="img-fluid rounded shadow-sm" style="max-width: 80px;">
                                        </a>
                                    </td>
                                    <td>{{ $eq->pivot->date_retour ?? 'Aucune date de retour' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Aucun équipement assigné pour le moment.</p>
            @endif

            {{-- Modaux d'image --}}
            @foreach ($equipements as $eq)
                <div class="modal fade" id="imageModal{{ $eq->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $eq->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $eq->nom }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="/{{ $eq->image_path }}" class="img-fluid rounded shadow" alt="Image de {{ $eq->nom }}">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
