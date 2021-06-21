<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>

    <meta name="description" content="{{ config('app.name') }}">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.name') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ mix('/css/oneui.css') }}">
    <!-- END Stylesheets -->
</head>

<body>
    <!-- Page Container -->
    <div id="page-container">

        <!-- Main Container -->
        <main id="main-container">

            <!-- Page Content -->
            <div class="hero-static">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6">
                            <!-- Sign Up Block -->
                            <div class="block block-rounded block-themed mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">Create Account</h3>
                                    <div class="block-options">
                                        <a class="btn-block-option font-size-sm" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#one-signup-terms">View Terms</a>
                                        <a class="btn-block-option" href="/login" data-toggle="tooltip"
                                            data-placement="left" title="Sign In">
                                            <i class="fa fa-sign-in-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="p-sm-3 px-lg-4 py-lg-5">
                                        <h1 class="h2 mb-1">{{ config('app.name') }}</h1>
                                        <p class="text-muted">
                                            Please fill the following details to create a new merchant account.
                                        </p>
                                        <form class="js-validation-signup" action="{{ route('register') }}"
                                            method="POST">
                                            @csrf

                                            <div class="py-3">
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-control form-control-lg form-control-alt @error('name') is-invalid @enderror"
                                                        id="name" name="name" placeholder="Name" required
                                                        autocomplete="name" autofocus>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="form-control form-control-lg form-control-alt @error('phone') is-invalid @enderror"
                                                        id="phone" name="phone" placeholder="Phone" required
                                                        autocomplete="phone" autofocus>
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="email"
                                                        class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror"
                                                        id="email" name="email" placeholder="Email"
                                                        value="{{ old('email') }}" required autocomplete="email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="address" id="address" rows="3"
                                                        class="form-control form-control-lg form-control-alt @error('address') is-invalid @enderror"
                                                        placeholder="Address" required>{{ old('address') }}</textarea>
                                                    @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-alt @error('password') is-invalid @enderror"
                                                        id="password" name="password" placeholder="Password" required
                                                        autocomplete="new-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-alt"
                                                        id="password-confirm" name="password_confirmation"
                                                        placeholder="Confirm Password" required
                                                        autocomplete="new-password">
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="signup-terms" name="signup-terms" required>
                                                        <label class="custom-control-label font-w400"
                                                            for="signup-terms">I agree to
                                                            Terms &amp; Conditions</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-xl-5">
                                                    <button type="submit" class="btn btn-block btn-alt-success">
                                                        <i class="fa fa-fw fa-plus mr-1"></i> Sign Up
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END Sign Up Form -->
                                    </div>
                                </div>
                            </div>
                            <!-- END Sign Up Block -->
                        </div>
                    </div>
                    <div class="content content-full font-size-sm text-muted text-center">
                        <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
                    </div>

                    <!-- Terms Modal -->
                    <div class="modal fade" id="one-signup-terms" tabindex="-1" role="dialog"
                        aria-labelledby="one-signup-terms" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
                            <div class="modal-content">
                                <div class="block block-rounded block-themed block-transparent mb-0">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">Terms &amp; Conditions</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <p>Terms and condition is updating. Please Wait!</p>
                                    </div>
                                    <div class="block-content block-content-full text-right border-top">
                                        <button type="button" class="btn btn-alt-primary mr-1"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">I
                                            Agree</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Terms Modal -->
                </div>
                <!-- END Page Content -->
        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <script src="{{ mix('js/oneui.app.js') }}"></script>
</body>

</html>