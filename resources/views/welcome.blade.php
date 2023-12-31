<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/main.css') }}">
</head>

<body>
    <div class="main-cont custom-bg" style="background-image: url('{{ asset('assets/image/wood.jpg') }}')">
        {{-- <div class="mobile-cont custom-bg" style="background-image: url('{{ asset('assets/image/pixel.png') }}')"> --}}
        <div class="mobile-display">
            <div class="display-glass container pt-2">
                <div class="form-cont container">
                    <h4>Login</h4>

                    {{-- <div class="overall-box">
                            <span>Personal Name</span>
                            <div class="input-cont">
                                <div class="input-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" class="tx-field">
                                </div>
                                <div class="input-group">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" id="mname"  class="tx-field">
                                </div>
                                <div class="input-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" class="required lname tx-field">
                                </div>
                            </div>

                        </div> --}}
                    <form action="{{ Route('user.login') }}" method="POST">

                        <div class="overall-box">
                            @method('POST')
                            @csrf
                            {{-- <span>Personal Name</span> --}}
                            <div class="input-cont" style="padding-top: 1em">
                                <div class="input-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="required tx-field">
                                </div>
                                <div class="input-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="required tx-field">
                                </div>
                                @if (session('error'))
                                    <small>Invalid Credantials!</small>
                                @endif
                                <small></small>
                                {{-- <div class="input-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" class="required lname tx-field">
                                </div> --}}
                            </div>

                        </div>
                        <button class="login-btn">Login</button>

                    </form>

                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
