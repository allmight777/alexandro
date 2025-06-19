@extends("admin.layouts.adminlay")
@section("content")
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Liste des Pannes Signalées</h4>
        </div>
        <div class="card-body">
            @if($pannes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th  class="text-white">Équipement</th>
                                <th  class="text-white">Description</th>
                                <th  class="text-white">Utilisateur</th>
                                <th  class="text-white">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pannes as $panne)
                                <tr>
                                    <td >{{ $panne->equipement->nom }}</td>
                                    <td>{{ $panne->description }}</td>
                                    <td>{{ $panne->user->nom }} {{ $panne->user->prenom }}</td>
                                    <td>{{ $panne->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center">
                    Aucune panne signalée pour le moment.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
