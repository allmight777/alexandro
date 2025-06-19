@extends('gestionnaire.rapports.layouts.gestionlay')
@section('content')
<h2>Mes Rapports</h2>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Contenu (extrait)</th>
            <th>PDF</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rapports as $rapport)
            <tr>
                <td>{{ $rapport->id }}</td>
                <td>{{ $rapport->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ Str::limit($rapport->contenu, 50) }}</td>
                <td>
                    <a href="{{ route('gestionnaire.rapports.download', $rapport->id) }}" target="_blank">📥 Voir / Télécharger</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
