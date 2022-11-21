<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md">
                <img src="{{ asset('img/login.png') }}" alt="e-kasir" class="img-fluid">
            </div>
            <div class="col-md">
                <div class="mb-3 mb-md-5">
                    <h1 class="text-primary">Login</h1>
                    <p class="text-secondary fst-italic">Selamat datang di aplikasi e-kasir</p>
                </div>
                <form>
                    @csrf
                    <div class="mb-2">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="mb-2">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="mb-4 form-check">
                        <label class="text-secondary" for="remember_me">Ingat saya?</label>
                        <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Log in</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        $('form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('login') }}",
                method: "POST",
                data: formData,
                success: function(res) {
                    console.log(res);
                    if (res.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login berhasil'
                        }).then(function() {
                            window.location.replace('{{ route('dashboard') }}');
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Akun invalid.',
                            text: 'Harap cek kembali username & password yang diinputkan!'
                        }).then(function() {
                            $('form')[0].reset();
                        })
                    }
                },
                error: function(err) {
                    $.each(err.responseJSON.errors, function(key, value) {
                        toastr.error(value);
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
</body>

</html>
