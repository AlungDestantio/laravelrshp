<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin | Klinik Hewan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Poppins', sans-serif;
    }
    .sidebar {
      min-height: 100vh;
      background: #1e3a8a;
      color: #fff;
    }
    .sidebar a {
      color: #cbd5e1;
      text-decoration: none;
      display: block;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 5px;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #2563eb;
      color: #fff;
    }
    .content {
      padding: 20px;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    .table th {
      background: #eff6ff;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <div class="sidebar p-3">
      <h4 class="fw-bold text-white mb-4"><i class="bi bi-hospital me-2"></i>Klinik Hewan</h4>
      <a href="{{ route('dashboard') }}" class="active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
      <a href="#"><i class="bi bi-paw me-2"></i>Jenis Hewan</a>
      <a href="#"><i class="bi bi-diagram-3 me-2"></i>Ras Hewan</a>
      <a href="#"><i class="bi bi-tags me-2"></i>Kategori</a>
      <a href="#"><i class="bi bi-file-earmark-medical me-2"></i>Kategori Klinis</a>
      <a href="#"><i class="bi bi-heart-pulse me-2"></i>Kode Tindakan Terapi</a>
      <a href="#"><i class="bi bi-house-heart me-2"></i>Pet</a>
      <a href="#"><i class="bi bi-person-badge me-2"></i>Role</a>
      <a href="#"><i class="bi bi-people me-2"></i>User</a>
      <hr>
      <a href="{{ route('logout') }}" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

    <div class="content flex-fill">
      @yield('content')
    </div>
  </div>
</body>
</html>
