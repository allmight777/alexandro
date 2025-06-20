@extends('admin.layouts.adminlay')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @session('success')
                <div class="alert alert-green">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ $value }}
                </div>
            @endsession

            <!-- Formulaire d'ajout d'équipement -->
            <div class="card form-card">
                <div class="form-header">
                    <div class="d-flex align-items-center">
                        <div class="form-icon">
                            <i class="mdi mdi-laptop"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Ajouter un nouvel équipement</h4>
                            <p class="mb-0">Remplissez les détails de l'équipement à ajouter à l'inventaire</p>
                        </div>
                    </div>
                </div>
                <div class="form-body">
                    <form method="POST" action="{{ route('addTool') }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="equipmentName" class="form-label required-label">Nom de l'équipement</label>
                                    <input type="text" class="form-control" id="equipmentName"
                                        placeholder="Entrez le nom de l'équipement" required name="nom">
                                    @error('nom')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="equipmentState" class="form-label required-label">État</label>
                                    <select class="form-select" id="equipmentState" required name="etat">
                                        <option value="" selected disabled>Sélectionnez un état</option>
                                        <option value="disponible">Disponible</option>
                                        <option value="usagé">Usagé</option>
                                        <option value="en panne">En panne</option>
                                        <option value="réparé">Réparé</option>
                                    </select>
                                    @error('etat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="equipmentBrand" class="form-label">Marque</label>
                                    <input type="text" class="form-control" id="equipmentBrand"
                                        placeholder="Entrez la marque" name="marque">
                                    @error('marque')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="equipmentCategory" class="form-label required-label">Catégorie</label>
                                    <select class="form-select" id="equipmentCategory" required name="categorie">
                                        <option value="" selected disabled>Sélectionnez une catégorie</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->nom }}">{{ $cat->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('categorie')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="equipmentDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="equipmentDescription" rows="3"
                                        placeholder="Entrez une description de l'équipement" name="description"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="acquisitionDate" class="form-label">Date d'acquisition</label>
                                    <input type="date" class="form-control" id="acquisitionDate" name="date_acquisition">
                                    @error('date_acquisition')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="equipmentImage" class="form-label">Image de l'équipement</label>
                                    <input type="file" class="form-control" id="equipmentImage" accept="image/*"
                                        name="image_path">
                                    @error('image_path')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-footer">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-reset me-3">
                                    <i class="mdi mdi-refresh me-1"></i> Réinitialiser
                                </button>
                                <button type="submit" class="btn btn-submit">
                                    <i class="mdi mdi-plus-circle me-1"></i> Ajouter l'équipement
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fin du formulaire d'ajout d'équipement -->
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
