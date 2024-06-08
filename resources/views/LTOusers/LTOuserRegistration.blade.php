<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register LTO User</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Register LTO User</h2>
    <form method="POST" action="{{ route('ltouser.register') }}">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @csrf
        <input type="text" name="name" placeholder="Name" required class="form-control mb-2">
        <input type="email" name="email" placeholder="Email" required class="form-control mb-2">
        <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
        <input type="text" name="phone" placeholder="Phone" required class="form-control mb-2">
        <select name="role" class="form-control mb-3">
            <option value="Adminstative">Adminstative</option>
            <option value="Director">Director</option>
            <option value="Manager">Manager</option>
        </select>
        <select name="gender" class="form-control mb-3">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
