<?php use Carbon\Carbon; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restaurant Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        body {
            font-family: Arial, sans-serif;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        
      /* تخصيص مظهر شريط التنقل */
      .navbar-custom {
          background-color: #343a40;
      }
      .navbar-custom .navbar-brand,
      .navbar-custom .nav-link {
          color: #ffffff;
      }
      .navbar-custom .nav-link:hover {
          color: #d4d4d4;
      }
  </style>
</head>
<body>
  @include('admin.nav_admin')

    <div class="main-content">
        <h1>Welcome to the Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Daily Orders</h5>
                        <p class="card-text">{{\App\Models\order::whereDate('created_at', Carbon::today())->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Revenue</h5>
                        <p class="card-text">{{\App\Models\prodect::sum('price') }} $</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Customers</h5>
                        <p class="card-text">{{\App\Models\customer::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Pending Orders</h5>
                        <p class="card-text">{{\App\Models\order::where('status', 'يتم مراجعة الطلب')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-12 col-lg-12 col-xl-7">
                <div class="card mb-3">
                    <div class="card-header bg-transparent">
                        <h4 class="card-title mb-0">نسبة الاوردرات</h4>
                    </div>
                    <div style="max-width: 400px; margin: auto;">
                        {{ $chartjs1->render() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-5">
                <div class="card mb-3">
                    <div class="card-header bg-transparent">
                        <label class="main-content-label">الاوردرات</label>
                    </div>
                    <div style="max-width: 900px; margin: auto;">
                        {{ $chartjs2->render() }}
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
