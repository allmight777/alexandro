@extends('admin.layouts.adminlay')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Matériels non retournés</h4>
            </div>
            <div class="card-body">
                @if ($equipement_lost->isEmpty())
                    <p class="text-center text-muted">Aucun matériel en retard n'a été trouvé.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Matériel</th>
                                    <th>Employé</th>
                                    <th>Date prévue de retour</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipement_lost as $affectation)
                                    <tr>
                                        <td>{{ $affectation->equipement->nom ?? 'Inconnu' }}</td>
                                        <td>{{ $affectation->user->nom ?? '-' }} {{ $affectation->user->prenom ?? '' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($affectation->date_retour)->format('d/m/Y') }}</td>
                                        <td>
                                            <form action=""
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="mdi mdi-undo"></i> Retourner
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
