<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .auth-card {
            max-width: 550px;
            padding: 2.5rem;
            border-radius: 1rem;
        }
        .auth-card h3 {
            font-size: 1.8rem;
            font-weight: bold;
        }
        .auth-card p {
            font-size: 1.1rem;
        }
        .form-control {
            padding: 0.9rem;
            font-size: 1.1rem;
        }
        .btn {
            padding: 0.9rem;
            font-size: 1.1rem;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="card shadow-lg auth-card w-100">
        <h3 class="mb-3 text-center">Forgot Password</h3>
        <p class="text-muted text-center mb-4">Enter your email to receive a password reset link.</p>

        @if(session('status'))
            <div class="alert alert-success text-center">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email address</label>
                <input id="email" type="email" class="form-control" name="email" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
