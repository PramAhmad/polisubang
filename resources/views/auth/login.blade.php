<!DOCTYPE html>
<html lang="id">

    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="handheldfriendly" content="true" />
        <meta name="MobileOptimized" content="width" />
        <meta name="description" content="Login" />
        <meta name="author" content="Irfan" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" type="image/png" href="{{ asset('templates/mdrnz/images/logos/favicon.ico') }}" />
        
        <link  id="themeColors"  rel="stylesheet" href="{{ asset('templates/mdrnz/css/style.min.css') }}" />
        <style>
            .page-wrapper {
                background-size: cover;
                background-repeat: no-repeat;
                background-image: url('{{ asset('logo.png') }}');
            }
            .bg-overlay {
                position: absolute;
                height: 100%;
                width: 100%;
                right: 0;
                bottom: 0;
                left: 0;
                top: 0;
                opacity: .85;
            }
        </style>
    </head>

    <body>
        <div class="preloader">
            <img src="{{ asset('logo.png') }}" alt="loader" class="lds-ripple img-fluid" />
        </div>
        <div class="page-wrapper" id="main-wrapper" data-layout="horizontal" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            <div class="bg-overlay bg-light"></div>
            <div
                class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="row justify-content-center w-100">
                        <div class="col-md-8 col-lg-6 col-xxl-3">
                            <div class="card mb-0">
                                <div class="card-body">
                           

                                        <a href="{{ route('home') }}" class="text-nowrap  bg-dark p-1 rounded text-start d-block mb-5 w-100">
                                            <img src="{{ asset('logo.png') }}" width="400"  alt="" >
                                        </a>
                            
                                    
                                  
                                    <x-inputs.form action="{{ route('login') }}" method="POST">
                                        <div class="mb-3">
                                            <x-inputs.input type="email" name="email" id="email" label="Email" value="{{ old('email') }}" required/>
                                        </div>
                                        <div class="mb-4">
                                            <x-inputs.input type="password" name="password" id="password" label="Password" required/>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input primary" name="remember" type="checkbox" id="flexCheckChecked">
                                                <label class="form-check-label text-dark" for="flexCheckChecked">
                                                    Remember this Device
                                                </label>
                                            </div>
                                            <a class="text-primary fw-medium" href="{{route('register')}}">Tidak Punya Akun ?</a>
                                        </div>
                                        <button class="btn btn-primary w-100 py-8 mb-4 rounded-2 btn-login">Sign In</button>
                                    </x-inputs.form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Import Js Files -->
        <script src="{{ asset('templates/mdrnz/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/libs/simplebar/dist/simplebar.min.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!--  core files -->
        <script src="{{ asset('templates/mdrnz/js/app.min.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/js/app.init.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/js/custom.js') }}"></script>
        <script>
            $(function(){
                $('form').on('submit', function(){
                    const t = $(this)

                    t.find('.btn-login').prop('disabled', true).prepend('<div class="spinner-border spinner-border-sm" role="status"></div> ')
                })
            })
        </script>
    </body>
</html>