<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMAGANG | {{ $title }}</title>
    <link rel="icon" href="{{ asset('img/logo_prov3.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-image: url("{{ asset('img/bg-home3.jpg') }}");
            /* background-image: url("{{ asset('img/img.jpg') }}"); */
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    @yield('container')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            // Toggle type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the icon
            this.classList.toggle('bi-eye-fill');
            this.classList.toggle('bi-eye-slash-fill');
        });
    </script>

    @stack('scripts')
</body>

</html>
