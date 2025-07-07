<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <base href="/public">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Toolzy - Administration</title>
    <!-- plugins:css -->
   @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    @include('admin.style')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('admin.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                    <!-- Gestion des utilisateurs -->


                    <!-- Gestion des équipements -->

                    <!-- Affectations récentes -->

                    <!-- Rapports récents -->

                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <!-- partial -->
                </div>
                @include('admin.footer')
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        @stack('popups')
        <!-- plugins:js -->

        <!-- endinject -->
        <!-- Custom js for this page-->
         @stack('scripts')
        <script>
            // Personnalisation des graphiques pour Toolzy
            document.addEventListener('DOMContentLoaded', function() {
                if ($("#visit-sale-chart").length) {
                    Chart.defaults.global.legend.labels.usePointStyle = true;
                    var ctx = document.getElementById('visit-sale-chart').getContext("2d");

                    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 181);
                    gradientStroke1.addColorStop(0, '#4776E6');
                    gradientStroke1.addColorStop(1, '#8E54E9');

                    var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 360);
                    gradientStroke2.addColorStop(0, '#FF8008');
                    gradientStroke2.addColorStop(1, '#FFC837');

                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
                            datasets: [{
                                    label: 'Ordinateurs',
                                    borderColor: gradientStroke1,
                                    backgroundColor: gradientStroke1,
                                    pointBackgroundColor: gradientStroke1,
                                    pointBorderColor: 'rgba(255,255,255,0)',
                                    pointHoverBackgroundColor: gradientStroke1,
                                    pointBorderWidth: 0,
                                    pointHoverRadius: 0,
                                    pointHoverBorderWidth: 0,
                                    pointRadius: 0,
                                    fill: true,
                                    borderWidth: 2,
                                    data: [65, 59, 80, 81, 56, 55, 40]
                                },
                                {
                                    label: 'Autres équipements',
                                    borderColor: gradientStroke2,
                                    backgroundColor: gradientStroke2,
                                    pointBackgroundColor: gradientStroke2,
                                    pointBorderColor: 'rgba(255,255,255,0)',
                                    pointHoverBackgroundColor: gradientStroke2,
                                    pointBorderWidth: 0,
                                    pointHoverRadius: 0,
                                    pointHoverBorderWidth: 0,
                                    pointRadius: 0,
                                    fill: true,
                                    borderWidth: 2,
                                    data: [30, 40, 35, 50, 49, 60, 70]
                                }
                            ]
                        },
                        options: {
                            legend: {
                                display: false,
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        maxTicksLimit: 5,
                                        stepSize: 20,
                                        max: 100
                                    },
                                    gridLines: {
                                        borderDash: [3, 3],
                                        drawBorder: false,
                                        color: 'rgba(0,0,0,0.1)',
                                        zeroLineColor: 'rgba(0,0,0,0)',
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        display: false,
                                        drawBorder: false,
                                        color: 'rgba(0,0,0,0.1)',
                                        zeroLineColor: 'rgba(0,0,0,0)',
                                    },
                                    ticks: {
                                        padding: 20,
                                        fontColor: "#9c9fa6",
                                        autoSkip: true,
                                    }
                                }]
                            }
                        }
                    });
                    document.getElementById('visit-sale-chart-legend').innerHTML = myChart.generateLegend();
                }

                if ($("#traffic-chart").length) {
                    var ctx = document.getElementById('traffic-chart').getContext("2d");
                    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 181);
                    gradientStroke1.addColorStop(0, '#4776E6');
                    gradientStroke1.addColorStop(1, '#8E54E9');

                    var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 50);
                    gradientStroke2.addColorStop(0, '#FF8008');
                    gradientStroke2.addColorStop(1, '#FFC837');

                    var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 50);
                    gradientStroke3.addColorStop(0, '#11998e');
                    gradientStroke3.addColorStop(1, '#38ef7d');

                    var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 50);
                    gradientStroke4.addColorStop(0, '#f5515f');
                    gradientStroke4.addColorStop(1, '#ff9966');

                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: moisLabels, // ✅ données dynamiques injectées depuis homedash.blade.php
                            datasets: [{
                                label: 'Équipements ajoutés',
                                borderColor: gradientStroke1,
                                backgroundColor: gradientStroke1,
                                pointBackgroundColor: gradientStroke1,
                                pointBorderColor: 'rgba(255,255,255,0)',
                                pointHoverBackgroundColor: gradientStroke1,
                                pointBorderWidth: 0,
                                pointHoverRadius: 0,
                                pointHoverBorderWidth: 0,
                                pointRadius: 0,
                                fill: true,
                                borderWidth: 2,
                                data: equipementsParMois // ✅ données dynamiques Laravel
                            }]
                        },
                        options: {
                            legend: {
                                display: true,
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        maxTicksLimit: 6,
                                        stepSize: 1
                                    },
                                    gridLines: {
                                        borderDash: [3, 3],
                                        drawBorder: false,
                                        color: 'rgba(0,0,0,0.1)',
                                        zeroLineColor: 'rgba(0,0,0,0)',
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        display: false,
                                        drawBorder: false,
                                        color: 'rgba(0,0,0,0.1)',
                                        zeroLineColor: 'rgba(0,0,0,0)',
                                    },
                                    ticks: {
                                        padding: 20,
                                        fontColor: "#9c9fa6",
                                        autoSkip: true,
                                    }
                                }]
                            }
                        }
                    });

                    document.getElementById('traffic-chart-legend').innerHTML = myChart.generateLegend();
                }
            });
        </script>
        <script>
            // Fonction pour afficher la popup d'image
            function showImagePopup(imageSrc, imageTitle) {
                const popup = document.getElementById('imagePopup');
                const popupImage = document.getElementById('popupImage');
                const popupTitle = document.getElementById('popupImageTitle');

                popupImage.src = imageSrc;
                popupTitle.textContent = imageTitle;
                popup.style.display = 'flex';

                // Empêcher le défilement de la page lorsque la popup est ouverte
                document.body.style.overflow = 'hidden';
            }

            // Fonction pour fermer la popup d'image
            function closeImagePopup() {
                const popup = document.getElementById('imagePopup');
                popup.style.display = 'none';

                // Rétablir le défilement de la page
                document.body.style.overflow = 'auto';
            }

            // Fermer la popup si on clique en dehors de l'image
            document.getElementById('imagePopup').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeImagePopup();
                }
            });

            // Fermer la popup avec la touche ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeImagePopup();
                }
            });

            // Script pour gérer les actions sur les équipements
            document.addEventListener('DOMContentLoaded', function() {
                // Gestion des clics sur les icônes d'action
                document.querySelectorAll('.edit-icon').forEach(icon => {
                    icon.addEventListener('click', function() {
                        // Logique pour modifier l'équipement
                        console.log('Modifier équipement:', this.closest('tr').querySelector('td')
                            .textContent.trim());
                    });
                });


                // Gestion de la recherche dans la navbar
                const searchInput = document.getElementById('navbar-search');
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });
            });
        </script>

        <!-- End custom js for this page-->
</body>

</html>
