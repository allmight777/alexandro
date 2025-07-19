@extends('admin.layouts.adminlay')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-toolzy-primary text-white mr-2">
                <i class="mdi mdi-laptop"></i>
            </span>
            Inventaire des équipements
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Gestion des équipements</a></li>
                <li class="breadcrumb-item active" aria-current="page">Inventaire</li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Liste des équipements</h4>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Catégorie</th>
                                    <th>Qte</th>
                                    <th>Statut</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($equipements as $equip)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $equip->image_path }}" alt="{{ $equip->nom }}"
                                                    class="equipment-img"
                                                    onclick="showImagePopup('{{ $equip->image_path }}', '{{ $equip->nom }}')">
                                                <span>{{ $equip->nom }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $equip->description }}</td>
                                        <td>{{ $equip->categorie->nom }}</td>
                                        <td>{{ $equip->quantite }}</td>
                                        <td>
                                            <span class="status-badge status-available">{{ $equip->etat }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $qte = $equip->quantite;
                                                if ($qte <= 2) {
                                                    $status = ['Insuffisant', 'danger']; // rouge
                                                } elseif ($qte <= 4) {
                                                    $status = ['Faible', 'warning']; // orange
                                                } elseif ($qte <= 10) {
                                                    $status = ['Moyen', 'info']; // bleu clair
                                                } else {
                                                    $status = ['Suffisant', 'success']; // vert
                                                }
                                            @endphp

                                            <span class="badge badge-{{ $status[1] }}">
                                                {{ $status[0] }}
                                            </span>
                                        </td>

                                        <td>
                                            <a href="{{ route('putToolpage', $equip->id) }}">
                                                <i class="mdi mdi-pencil edit-icon action-icon" title="Modifier"></i>
                                            </a>
                                            <a href="{{ route('DeleteTool', $equip->id) }}">
                                                <i class="mdi mdi-delete delete-icon action-icon" title="Supprimer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            Aucun équipement existant.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($equipements->count())
                        <div class="row mt-4">
                            <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                                <span class="text-muted">
                                    Affichage de {{ $equipements->firstItem() }} à
                                    {{ $equipements->lastItem() }} sur {{ $equipements->total() }} équipements
                                </span>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                                <div class="pagination-wrapper">
                                    {{ $equipements->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('popups')
    <div class="image-popup" id="imagePopup">
        <div class="image-popup-content">
            <span class="close-popup" onclick="closeImagePopup()">&times;</span>
            <img id="popupImage" src="" alt="Image agrandie">
            <div class="image-popup-title" id="popupImageTitle"></div>
        </div>
    </div>
@endpush
