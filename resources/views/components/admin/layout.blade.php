<!doctype html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<title>EalSuite</title>
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0" />
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}"></script>
</head>

<body>
            
    <x-admin.header />

    {{ $slot }}

    <x-admin.footer />

</body>
</html>