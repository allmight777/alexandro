@extends('employee.homedash')
@section('content')
    <div class="container" style="margin-top:74px;">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Mes équipements assignés</h5>
            </div>
            <div class="card-body">
                {{-- Message d’alerte succès --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                @endif

                {{-- Tableau --}}
                @if (count($affectation) > 0)
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
                                @foreach ($affectation as $aff)
                                    <tr>
                                        <td class="text-wrap">{{ $aff->equipement->nom }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#imageModal{{ $aff->equipement->id }}">
                                                <img src="/{{ $aff->equipement->image_path }}" alt="Photo"
                                                    class="img-fluid rounded shadow-sm" style="max-width: 80px;">
                                            </a>
                                        </td>
                                        <td>
                                            {{ $aff->date_retour ? \Carbon\Carbon::parse($aff->date_retour)->format('d/m/Y') : 'Aucune date de retour' }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Aucun équipement assigné pour le moment.</p>
                @endif

                {{-- Modaux d'image --}}
                @foreach ($affectation as $aff)
                    <div class="modal fade" id="imageModal{{ $aff->equipement->id }}" tabindex="-1"
                        aria-labelledby="imageModalLabel{{ $aff->equipement->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $aff->equipement->nom }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="/{{ $aff->equipement->image_path }}" class="img-fluid rounded shadow"
                                        alt="Image de {{ $aff->equipement->nom }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-2">{{$affectation->links() }}</div>
    </div>
@endsection
