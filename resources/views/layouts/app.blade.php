<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ToDo App</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #8b5cf6;
      --secondary-color: #7c3aed;
      --accent-color: #f59e0b;
      --light-color: #f8fafc;
      --dark-color: #0f172a;
      --success-color: #10b981;
      --warning-color: #f59e0b;
      --danger-color: #ef4444;
      --card-bg: #1e293b;
      --card-border: #334155;
      --card-shadow: 0 10px 20px rgba(0,0,0,0.3);
      --hover-shadow: 0 15px 30px rgba(0,0,0,0.4);
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      min-height: 100vh;
      color: #e2e8f0;
    }
    
    .navbar {
      background: rgba(15, 23, 42, 0.95) !important;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      padding: 1rem 0;
      border-bottom: 1px solid var(--card-border);
    }
    
    .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--primary-color) !important;
      display: flex;
      align-items: center;
    }
    
    .navbar-brand i {
      margin-right: 8px;
    }
    
    .nav-link {
      font-weight: 500;
      color: #cbd5e1 !important;
      transition: all 0.3s ease;
      position: relative;
      padding: 0.5rem 1rem !important;
      border-radius: 8px;
      margin: 0 5px;
    }
    
    .nav-link:hover {
      color: var(--primary-color) !important;
      background-color: rgba(139, 92, 246, 0.1);
    }
    
    .nav-link.active {
      color: var(--primary-color) !important;
      background-color: rgba(139, 92, 246, 0.1);
    }
    
    .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 15%;
      width: 70%;
      height: 3px;
      background-color: var(--primary-color);
      border-radius: 3px;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      font-weight: 500;
      padding: 0.5rem 1.5rem;
      border-radius: 8px;
      transition: all 0.3s ease;
      color: white;
    }
    
    .btn-primary:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
      color: white;
    }
    
    .container {
      max-width: 1200px;
    }
    
    .card {
      border: 1px solid var(--card-border);
      border-radius: 16px;
      box-shadow: var(--card-shadow);
      transition: all 0.3s ease;
      overflow: hidden;
      margin-bottom: 1.5rem;
      background-color: var(--card-bg);
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: var(--hover-shadow);
    }
    
    .card-header {
      background-color: var(--card-bg);
      border-bottom: 1px solid var(--card-border);
      padding: 1.25rem 1.5rem;
      font-weight: 600;
      color: #e2e8f0;
    }
    
    .card-body {
      padding: 1.5rem;
      color: #cbd5e1;
    }
    
    .alert {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      font-weight: 500;
    }
    
    .alert-success {
      background-color: rgba(16, 185, 129, 0.15);
      color: #a7f3d0;
      border-left: 4px solid var(--success-color);
    }
    
    .done {
      text-decoration: line-through;
      opacity: 0.6;
      background-color: rgba(16, 185, 129, 0.1);
      border-radius: 8px;
      padding: 0.5rem;
    }
    
    .todo-item {
      display: flex;
      align-items: center;
      padding: 1rem;
      border-radius: 12px;
      margin-bottom: 0.75rem;
      background-color: var(--card-bg);
      border: 1px solid var(--card-border);
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    
    .todo-item:hover {
      transform: translateX(5px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      border-color: var(--primary-color);
    }
    
    .todo-item.done {
      background-color: rgba(16, 185, 129, 0.05);
    }
    
    .todo-actions {
      display: flex;
      gap: 0.5rem;
      margin-left: auto;
    }
    
    .btn-action {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }
    
    .btn-complete {
      background-color: rgba(16, 185, 129, 0.1);
      color: var(--success-color);
      border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .btn-complete:hover {
      background-color: var(--success-color);
      color: white;
    }
    
    .btn-edit {
      background-color: rgba(245, 158, 11, 0.1);
      color: var(--warning-color);
      border: 1px solid rgba(245, 158, 11, 0.3);
    }
    
    .btn-edit:hover {
      background-color: var(--warning-color);
      color: white;
    }
    
    .btn-delete {
      background-color: rgba(239, 68, 68, 0.1);
      color: var(--danger-color);
      border: 1px solid rgba(239, 68, 68, 0.3);
    }
    
    .btn-delete:hover {
      background-color: var(--danger-color);
      color: white;
    }
    
    .badge {
      font-weight: 500;
      padding: 0.4rem 0.75rem;
      border-radius: 20px;
    }
    
    .badge-primary {
      background-color: var(--primary-color);
    }
    
    .badge-secondary {
      background-color: #475569;
    }
    
    .badge-success {
      background-color: var(--success-color);
    }
    
    .badge-warning {
      background-color: var(--warning-color);
      color: #1e293b;
    }
    
    .badge-danger {
      background-color: var(--danger-color);
    }
    
    .stats-card {
      text-align: center;
      padding: 1.5rem;
    }
    
    .stats-number {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 0.5rem;
    }
    
    .stats-label {
      font-size: 0.9rem;
      color: #94a3b8;
      font-weight: 500;
    }
    
    .footer {
      margin-top: 3rem;
      padding: 2rem 0;
      text-align: center;
      color: #94a3b8;
      font-size: 0.9rem;
      border-top: 1px solid var(--card-border);
    }
    
    /* Animation for new items */
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .animate-slide-in {
      animation: slideIn 0.5s ease forwards;
    }
    
    /* Form Elements */
    .form-control, .form-select {
      background-color: var(--card-bg);
      border: 1px solid var(--card-border);
      color: #e2e8f0;
    }
    
    .form-control:focus, .form-select:focus {
      background-color: var(--card-bg);
      border-color: var(--primary-color);
      color: #e2e8f0;
      box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.25);
    }
    
    .form-label {
      color: #e2e8f0;
    }
    
    /* PERBAIKAN NAVBAR DENGAN DROPDOWN */
    .nav-item .btn-logout {
      background: none;
      border: none;
      color: #cbd5e1;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      transition: all 0.3s ease;
      cursor: pointer;
      display: flex;
      align-items: center;
      text-decoration: none;
      margin: 0 5px;
    }
    
    .nav-item .btn-logout:hover {
      color: var(--danger-color);
      background-color: rgba(239, 68, 68, 0.1);
    }
    
    .navbar-nav .nav-item {
      display: flex;
      align-items: center;
    }
    
    .dropdown-menu {
      background-color: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      padding: 0.5rem;
    }
    
    .dropdown-item {
      color: #cbd5e1;
      border-radius: 8px;
      padding: 0.5rem 1rem;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
    }
    
    .dropdown-item:hover {
      background-color: rgba(139, 92, 246, 0.1);
      color: var(--primary-color);
    }
    
    .dropdown-item i {
      margin-right: 8px;
      width: 20px;
      text-align: center;
    }
    
    .dropdown-toggle::after {
      margin-left: 5px;
    }
    
    .user-dropdown .dropdown-toggle {
      display: flex;
      align-items: center;
      color: #cbd5e1;
      text-decoration: none;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    
    .user-dropdown .dropdown-toggle:hover {
      color: var(--primary-color);
      background-color: rgba(139, 92, 246, 0.1);
    }
    
    .user-dropdown .dropdown-toggle i {
      margin-right: 8px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .navbar-nav {
        margin-top: 1rem;
      }
      
      .nav-link {
        margin: 0.25rem 0;
      }
      
      .todo-item {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .todo-actions {
        margin-left: 0;
        margin-top: 1rem;
        width: 100%;
        justify-content: flex-end;
      }
      
      .dropdown-menu {
        border: none;
        box-shadow: none;
        background-color: transparent;
        padding-left: 1rem;
      }
    }
  </style>
</head>

<body class="bg-dark">
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('todo.index') }}">
        <i class="fas fa-tasks"></i> My To-Do
      </a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          @auth
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('todo.index') ? 'active' : '' }}" 
                href="{{ route('todo.index') }}">
                <i class="fas fa-home me-1"></i> Home
              </a>
            </li>
            
            <!-- Dropdown Menu untuk Jadwal -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-calendar-alt me-1"></i> Jadwal
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item {{ request()->routeIs('todo.create') ? 'active' : '' }}" 
                    href="{{ route('todo.create') }}">
                    <i class="fas fa-plus-circle"></i> Tambah Jadwal
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ request()->routeIs('todo.daily') ? 'active' : '' }}" 
                    href="{{ route('todo.daily') }}">
                    <i class="fas fa-calendar-day"></i> Daily
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ request()->routeIs('todo.weekly') ? 'active' : '' }}" 
                    href="{{ route('todo.weekly') }}">
                    <i class="fas fa-calendar-week"></i> Weekly
                  </a>
                </li>
              </ul>
            </li>
            
            <!-- Dropdown Menu untuk User -->
            <li class="nav-item dropdown user-dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item {{ request()->routeIs('profile.show') ? 'active' : '' }}"
                    href="{{ route('profile.show') }}">
                    <i class="fas fa-user-circle"></i> Profil Saya
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <button type="button" class="dropdown-item text-danger"
                      onclick="if(confirm('Apakah kamu yakin ingin logout?')) document.getElementById('logout-form').submit();">
                      <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                  </form>
                </li>
              </ul>
            </li>

          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt me-1"></i> Login
              </a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="{{ route('register') }}">
                <i class="fas fa-user-plus me-1"></i> Daftar
              </a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    @if(session('success'))
      <div class="alert alert-success animate__animated animate__fadeInDown mb-4">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </div>

  <footer class="footer">
    <div class="container">
      <p>&copy; {{ date('Y') }} Instagram Suparya_Ya</p>
    </div>
  </footer>

  <!-- Bootstrap JS + Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Add animation to new todo items
    document.addEventListener('DOMContentLoaded', function() {
      const todoItems = document.querySelectorAll('.todo-item');
      todoItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
        item.classList.add('animate-slide-in');
      });
      
      // Add confirmation for delete actions
      document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
          if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
            e.preventDefault();
          }
        });
      });
    });
  </script>
</body>
</html>