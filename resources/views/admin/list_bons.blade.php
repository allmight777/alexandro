@extends('admin.layouts.adminlay')
@section('content')
<h4 class="mb-4">Liste des Bons</h4>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Date de création</th>
            <th>Type</th>
            <th>Téléchargement</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bons as $bon)
            <tr>
                <td>{{ $bon->id }}</td>
                <td>{{ $bon->created_at->format('d/m/Y H:i') }}</td>
                <td>{{$bon->statut}}</td>
                <td>
                    @if ($bon->fichier_pdf)
                        <a href="{{ asset('storage/' . $bon->fichier_pdf) }}" class="btn btn-sm btn-primary" download>
                            Télécharger
                        </a>
                    @else
                        <span class="text-muted">Non disponible</span>
                    @endif
                </td>
            </tr>
        @empty
             <span>Aucun bon disponible pour le moment</span>
        @endforelse
    </tbody>
</table>
@endsection
