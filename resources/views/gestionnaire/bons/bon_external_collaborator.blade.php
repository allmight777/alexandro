@extends('gestionnaire.bons.layouts.gestionlay')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Générer un bon pour un collaborateur externe</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                @endif
                <form action="{{route('gestionnaire.bons.handle_external')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="collaborateur" class="form-label">Collaborateur externe</label>
                        <select class="form-select" name="collaborateur_id" id="collaborateur" required>
                            <option value="" disabled selected>-- Sélectionnez un collaborateur --</option>
                            @foreach ($collaborateurs as $collab)
                                <option value="{{ $collab->id }}">
                                    {{ $collab->nom }} {{ $collab->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('collaborateur_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="motif" class="form-label">Motif</label>
                        <textarea name="motif" id="motif" rows="4" class="form-control" required placeholder="Décrivez le motif du bon..."></textarea>
                        @error('motif')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                      <div class="mb-3">
                        <label for="type" class="form-label">Type de bon</label>
                        <select class="form-select" name="type" id="type" required>
                            <option value="" disabled selected>-- Sélectionnez un type --</option>
                            <option value="entrée">Entrée</option>
                            <option value="sortie">Sortie</option>
                        </select>
                        @error('type')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <i class="mdi mdi-file-document-outline me-1"></i> Générer le bon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    @if(session('pdf'))
        <script>
            window.onload = function () {
                const link = document.createElement('a');
                link.href = "{{ session('pdf') }}";
                link.download = "";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        </script>
    @endif
@endpush
