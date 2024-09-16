<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Bootstrap 5 Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/form.css')}}"> <!-- Your existing CSS link -->
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-light">
            <div class="sidebar-header d-flex justify-content-between align-items-center p-3">
                <h4 class="mb-0">Sidebar</h4>
                <button class="btn btn-light d-lg-none" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
            </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action text-light">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
                <!-- Other menu items -->
            </div>
        </nav>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <header class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary d-lg-none" id="sidebarToggleMobile">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <h1 class="ms-3">Dashboard</h1>
                </div>
            </header>
            <div class="container-fluid p-4">
                <h2>Analytics</h2>
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
            const sidebar = document.getElementById('sidebar');
            const pageContentWrapper = document.getElementById('page-content-wrapper');

            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                pageContentWrapper.classList.toggle('sidebar-open');
            });

            sidebarToggleMobile.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                pageContentWrapper.classList.toggle('sidebar-open');
            });

            // Line Chart
            const ctx = document.getElementById('lineChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'User Visits',
                        data: [12, 19, 3, 5, 2, 3, 7],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
