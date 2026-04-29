<!DOCTYPE html>
<html>
<head>
    <title>FactoryFlow Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-lg">
                <div class="card-body">

                    <h2 class="text-center mb-4">FactoryFlow Login</h2>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="/login">
                        @csrf

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <button class="btn btn-primary w-100">Login</button>
                    </form>

                    <div class="mt-3 text-center">
                        Username: <b>admin</b><br>
                        Password: <b>1234</b>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>