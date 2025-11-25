<!DOCTYPE html>
<html>
<head>
    <title>Login - My To-Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e2e8f0;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        
        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--card-border);
            padding: 2rem 2rem 1rem;
            text-align: center;
        }
        
        .card-body {
            padding: 1.5rem 2rem 2rem;
            color: #cbd5e1;
        }
        
        .logo {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .title {
            color: #e2e8f0;
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .subtitle {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 0;
        }
        
        .form-label {
            color: #e2e8f0;
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .form-control {
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--card-border);
            color: #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background-color: rgba(15, 23, 42, 0.7);
            border-color: var(--primary-color);
            color: #e2e8f0;
            box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.25);
        }
        
        .form-control::placeholder {
            color: #64748b;
        }
        
        .input-group {
            margin-bottom: 1.5rem;
        }
        
        .input-group-text {
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--card-border);
            border-right: none;
            color: #64748b;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 500;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: white;
            font-size: 0.95rem;
            margin-top: 0.5rem;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
            color: white;
        }
        
        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            font-weight: 500;
            margin-bottom: 1.5rem;
            padding: 1rem 1.25rem;
        }
        
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border-left: 4px solid var(--danger-color);
        }
        
        .divider {
            border-color: var(--card-border);
            opacity: 0.5;
            margin: 1.5rem 0;
        }
        
        .register-link {
            text-align: center;
            color: #94a3b8;
            font-size: 0.9rem;
            margin-top: 1.5rem;
        }
        
        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .register-link a:hover {
            color: var(--secondary-color);
        }
        
        .form-footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--card-border);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card animate__animated animate__fadeInUp">
            <div class="card-header">
                <div class="logo">
                    <i class="fas fa-tasks"></i>
                </div>
                <h3 class="title">Welcome Back</h3>
                <p class="subtitle">Sign in to your account</p>
            </div>
            
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Login gagal!</strong> Periksa email dan password Anda.
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control" required placeholder="Enter your password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-sign-in-alt me-2"></i> Sign In
                    </button>
                </form>

                <div class="register-link">
                    Don't have an account? 
                    <a href="{{ route('register') }}">Create account here</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</body>
</html>