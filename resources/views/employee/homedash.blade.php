<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Toolzy | Tableau de bord Employé</title>
    <!-- base:css -->
    <link rel="stylesheet" href="/vendors1/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/vendors1/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css1/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images1/favicon.png" />
    <style>
      :root {
        --primary: #2563eb;
        --secondary: #1e40af;
        --accent: #f59e0b;
        --dark: #1e293b;
      }
      .navbar-brand .logo-text {
        font-weight: 700;
        color: var(--dark);
        font-size: 1.5rem;
      }
      .btn-primary {
        background: var(--primary);
        border: none;
      }
      .btn-primary:hover {
        background: var(--secondary);
      }
      .btn-accent {
        background: var(--accent);
        color: white;
      }
      .badge-success {
        background-color: #10b981;
      }
      .badge-warning {
        background-color: #f59e0b;
      }
      .badge-info {
        background-color: #3b82f6;
      }
      .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      }
      .top-navbar {
        background: white !important;
      }
      .bottom-navbar {
        background: white !important;
      }
      .nav-link.active {
        color: var(--primary) !important;
        font-weight: 600;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_horizontal-navbar.html -->
       @include("employee.partials.navbar")
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
            @yield('content')
      
      </div>
       <!-- partial:partials/_footer.html -->
        @include("employee.partials.footer")
    <!-- partial -->
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    @yield('scripts')
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
    <!-- End custom js for this page-->
  </body>
</html>