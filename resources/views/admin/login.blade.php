<!doctype html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<title>EalSuite</title>
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0" />
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

<section class="innerpages company-profile-main1 parallaxcont">
    <div class="container">
        <div class="row">
            <h3>Login</h3>
        </div>
        @if(session('msgSuccess'))
            <div class="alert alert-primary" role="alert">
                {{ session('msgSuccess') }}
            </div>
        @endif
        @if(session('msgError'))
            <div class="alert alert-danger" role="alert">
            {{ session('msgError') }}
            </div>
        @endif
        <form name="login" id="login" method="post" action="{{ route('admin_validate_login') }}" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Username (Registered Email)</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                @error('email')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
                @error('password')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
            </div>
            <button type="submit" class="button" name="submit" id="submit">SUBMIT</button>
        </form>
    </div>
</section>

</body>
</html>