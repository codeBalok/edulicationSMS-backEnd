<!DOCTYPE html>
<html lang="en" class="h-100">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="robots" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="W3Admin:Dashboard Bootstrap 5 Template">
        <meta property="og:title" content="W3Admin:Dashboard Bootstrap 5 Template">
        <meta property="og:description" content="W3Admin:Dashboard Bootstrap 5 Template">
        <meta property="og:image" content="https://w3admin.dexignzone.com/xhtml/social-image.png">
        <meta name="format-detection" content="telephone=no">

        <!-- PAGE TITLE HERE -->
        <title>W3Admin - Modern-Admin-Dashboard</title>

        <!-- FAVICONS ICON -->
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <!--<link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">-->
        <link href="{{ URL::asset('/admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet" />
        <!--<link href="./css/style.css" rel="stylesheet">-->
        <link href="{{ URL::asset('/admin/css/style.css') }}" rel="stylesheet" />
    </head>

    <body class="vh-100">
        <div class="authincation h-100">
            <div class="container-fluid h-100">
                <div class="row h-100">
                    <div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
                        <div class="login-form">
                            <div class="text-center">
                                <h3 class="title">Sign In</h3>
                                <p>Sign in to your account to start using W3Admin</p>
                            </div>
                
                            @if ($message = Session::get('success'))
                            <div class="alert alert-primary alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
                                </button>
                                <strong>Success!</strong> {{ $message }}
                            </div>
                            @endif

                            @if ($message = Session::get('failed'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
                                </button>
                                <strong>Error!</strong> {{ $message }}
                            </div>
                            @endif

                            <form  name="login_form"  method="POST" action="{{ route('login-post') }}" >
                                @csrf
                                <div class="mb-4">
                                    <label class="mb-1 text-dark">Email</label>
                                    <input type="email" class="form-control form-control" value="" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
                                </div>
                                <div class="mb-4 position-relative">
                                    <label class="mb-1 text-dark">Password</label>
                                    <input type="password" id="dz-password" class="form-control form-control" value="" name="password">
                                    <span class="show-pass eye">

                                        <i class="fa fa-eye-slash"></i>
                                        <i class="fa fa-eye"></i>

                                    </span>
                                </div>
                                <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                    <div class="mb-4">
                                        <div class="form-check custom-checkbox mb-3">
                                            <input type="checkbox" class="form-check-input" name="remember" value="1" id="customCheckBox1" >
                                            <label class="form-check-label mt-1" for="customCheckBox1">Remember my preference</label>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <a href="{{ route('forget.password.get')}}" class="btn-link text-primary">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-primary light btn-block">Sign In</button>
                                </div>
                                <h6 class="login-title"><span>Or continue with</span></h6>
                                <div class="mb-3">
                                    <ul class="d-flex align-self-center justify-content-center">
                                        <li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f btn-facebook"></a></li>
                                        <li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
                                        <li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
                                        <li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
                                    </ul>
                                </div>
                                <p class="text-center">Not registered?  
                                    <a class="btn-link text-primary" href="">Register</a>
                                </p>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="pages-left h-100">
                            <div class="login-content">
                                <a href="index.html"><img src="images/logo-full.png" class="mb-3" alt=""></a>

                                <p>Your true value is determined by how much more you give in value than you take in payment. ...</p>
                            </div>
                            <div class="login-media text-center">
                                <img src="images/login.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--**********************************
                Scripts
        ***********************************-->
        <!-- Required vendors -->
        <!--<script src="./vendor/global/global.min.js"></script>-->
        <script src="{{ asset('admin/vendor/global/global.min.js')}}"></script>
      <!--<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>-->
        <script src="{{ asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
      <!--<script src="js/deznav-init.js"></script>-->
        <script src="{{ asset('admin/js/deznav-init.js')}}"></script>
      <!--<script src="./js/custom.js"></script>-->
        <script src="{{ asset('admin/js/custom.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('customCheckBox1');

        const preference = getCookie('remember_preference');
        if (preference === 'true') {
            checkbox.checked = true;
            // Apply your preference here (e.g., dark mode, language settings)
            applyPreference();
        }
            
        // Save the preference when the checkbox is changed
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                setCookie('remember_preference', 'true', 365); // Save preference for 1 year 
                applyPreference();
            } else {
                setCookie('remember_preference', 'false', 365);
                // Remove or revert preference here
                removePreference();
            }
        });
    });

    function applyPreference() {
        // Your code to apply the preference
        console.log("Preference applied");
    }

    function removePreference() {
        // Your code to remove or revert the preference
        console.log("Preference removed");
    } 

    // Helper functions to set and get cookies
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    </script>
    </body>
</html>