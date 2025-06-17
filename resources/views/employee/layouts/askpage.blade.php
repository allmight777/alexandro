@extends('employee.homedash')
@section('content')
    

        <div class="content-wrapper">
            <div class="row justify-content-center">
                <div class="col-md-10 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Faire une demande d'équipement</h4>
                            <form method="POST" action="">
                                @csrf
                                <div class="form-group">
                                    <label for="lieu_usage">Lieu d’usage</label>
                                    <input type="text" name="lieu_usage" class="form-control" required>
                                </div>

                                <hr>

                                <div id="equipement-wrapper">
                                    <div class="equipement-item row mb-3">
                                        <div class="col-md-6">
                                            <label>Équipement</label>
                                            <select name="equipements[]" class="form-control" required>
                                                <option value="">-- Sélectionner un équipement --</option>
                                                @foreach ($equipements as $equipement)
                                                    <option value="{{ $equipement->id }}">{{ $equipement->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Quantité</label>
                                            <input type="number" name="quantites[]" class="form-control" min="1"
                                                required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-btn">Supprimer</button>
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

        <!-- page-body-wrapper ends -->
    </div>

  
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="/vendors1/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/js1/template.js"></script>
    <!-- endinject -->
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="/vendors1/chart.js/Chart.min.js"></script>
    <script src="/vendors1/progressbar.js/progressbar.min.js"></script>
    <script src="/vendors1/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
    <script src="/vendors1/justgage/raphael-2.1.4.min.js"></script>
    <script src="/vendors1/justgage/justgage.js"></script>
    <script src="/js1/jquery.cookie.js" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="/js1/dashboard.js"></script>
    <script>
        document.getElementById('add-equipement').addEventListener('click', function() {
            let wrapper = document.getElementById('equipement-wrapper');

            let newField = document.createElement('div');
            newField.classList.add('equipement-item', 'row', 'mb-3');
            newField.innerHTML = `
        <div class="col-md-6">
            <select name="equipements[]" class="form-control" required>
                <option value="">-- Sélectionner un équipement --</option>
                @foreach ($equipements as $equipement)
                    <option value="{{ $equipement->id }}">{{ $equipement->nom }}
                    </option>
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

        // Supprimer une ligne
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-btn')) {
                e.target.closest('.equipement-item').remove();
            }
        });
    </script>

    <!-- End custom js for this page-->

@endsection


