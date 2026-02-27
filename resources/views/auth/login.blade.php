<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | AssetPulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
<div class="container mt-5"><div class="row justify-content-center"><div class="col-md-4">
<div class="card shadow-sm"><div class="card-body">
<h4 class="mb-3">Sign In</h4>
<form method="POST" action="{{ route('login.store') }}">@csrf
<div class="mb-2"><label>Email</label><input name="email" class="form-control" required></div>
<div class="mb-3"><label>Password</label><input name="password" type="password" class="form-control" required></div>
<button class="btn btn-primary w-100">Login</button>
</form></div></div></div></div></div>
</body>
</html>
