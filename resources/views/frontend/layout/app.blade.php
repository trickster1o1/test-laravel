<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">

    <title>@yield('title')</title>
</head>

<body>
    <script src="https://kit.fontawesome.com/41101f0065.js" crossorigin="anonymous"></script>

    <nav id="w0" class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <div>
                <a class="navbar-brand" href="/">My Application</a>

                <a class="link-offset-2 link-underline link-underline-opacity-0 text-secondary" href="{{Route('user.logout')}}">Logout({{ session('user')['name'] }})
                    <i class="fa fa-envelope-square"></i></a>

            </div>
    </nav>

    @yield('cont')



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src='{{ asset('assets/js/jquery.js') }}'></script>

    @yield('script')

</body>

</html>
