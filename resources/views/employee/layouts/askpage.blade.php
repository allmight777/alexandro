@extends('employee.homedash')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Faire une demande d'équipement</h4>

                        {{-- ✅ Message de succès --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{route("demande.soumise")}}">
                            @method("POST")
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="lieu">Lieu</label>
                                    <input type="text" name="lieu" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="motif">Usage</label>
                                    <textarea name="motif" class="form-control" rows="5" required></textarea>
                                </div>
                            </div>

                            <hr>

                            <div id="equipement-wrapper">
                                <div class="equipement-item row mb-3">
                                    <div class="col-md-6">
                                        <label>Équipement</label>
                                        <select name="equipements[]" class="form-control" required>
                                            <option value="">-- Sélectionner un équipement --</option>
                                            @foreach ($equipements as $equipement)
                                                <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Quantité</label>
                                        <input type="number" name="quantites[]" class="form-control" min="1" required>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-btn">Supprimer</button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-accent mb-3" id="add-equipement">
                                <i class="mdi mdi-plus"></i> Ajouter un équipement
                            </button>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Soumettre la demande</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('add-equipement').addEventListener('click', function () {
            let wrapper = document.getElementById('equipement-wrapper');

            let newField = document.createElement('div');
            newField.classList.add('equipement-item', 'row', 'mb-3');
            newField.innerHTML = `
        <div class="col-md-6">
            <select name="equipements[]" class="form-control" required>
                <option value="">-- Sélectionner un équipement --</option>
                @foreach ($equipements as $equipement)
                    <option value="{{ $equipement->id }}">{{ $equipement->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" name="quantites[]" class="form-control" min="1" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-sm remove-btn">Supprimer</button>
        </div>
        `;
            wrapper.appendChild(newField);
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-btn')) {
                e.target.closest('.equipement-item').remove();
            }
        });
    </script>
@endsection
