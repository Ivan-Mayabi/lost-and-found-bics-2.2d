<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found - Share Your Moments</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <!-- Load Bootstrap 5 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* Custom colors to mimic Instagram aesthetics */
        :root {
            --insta-blue: #0095f6;
            --insta-border: #dbdbdb;
            --insta-bg: black;
        }

        body {
            background-color: var(--insta-bg);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            overflow:hidden;
        }

        /* Custom styles for the mock phone display */
        .mock-phone {
            width: 100%;
            max-width: 380px;
            height: 100%;
            max-height: 580px;
            background-color: white;
            border: 2px solid #262626;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            margin-right: -40px; /* Slight overlap effect */
        }

        /* Styling for the screen inside the mock phone */
        .mock-screen {
            background: url('https://placehold.co/400x600/b8b8b8/000?text=App+Preview') center center/cover no-repeat;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 0 0 5px rgba(0,0,0,0.5);
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Logo styling for that distinct, handwriting look */
        .insta-logo {
            font-family: 'Billabong', cursive; /* Use a placeholder or simple serif for lack of font import */
            font-size: 3rem;
            color: white;
            margin-bottom: 1rem;
            line-height: 1;
        }

        .btn-insta-blue {
            background-color: var(--insta-blue);
            border-color: var(--insta-blue);
            color: white;
            font-weight: 600;
        }

        .btn-insta-blue:hover {
            background-color: #007bb6;
            border-color: #007bb6;
            color: white;
        }

        .card-insta {
            border: 1px solid var(--insta-border);
            background-color:black;
        }

        .form-control-sm-insta {
            height: 38px;
            padding: 8px 10px;
            font-size: 0.8rem;
            background-color: var(--insta-bg);
            border: 1px solid var(--insta-border);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 p-4">
    <img src="{{ asset('items.jpg')}}" class="position-relative z-1">

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <!-- Main Container -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1 my-5 position-absolute z-2">
        <div class="row w-100 justify-content-center align-items-center g-4">

            <!-- Left Side: App Showcase (Hidden on Mobile, centered on md and up) -->
            <div class="col-md-6 d-none d-md-flex justify-content-end">
                        <img src="{{ asset('favicon.png') }}" class="w-50 bg-black rounded-5">
            </div>
            
            <!-- Right Side: Auth/Action Area -->
            <div class="col-md-6 col-lg-4 d-flex mt-5 flex-column align-items-center">

                <!-- Card 1: Sign Up Form -->
                <div class="card card-insta bg-black mb-3 mt-5 p-4 pt-5 pb-5 w-100 text-center text-white rounded-5" style="max-width: 350px;">
                    
                    <!-- Logo/Branding -->
                    <h1 class="insta-logo">Lost and Found</h1>
                    <p class="text-white mb-4 fs-6 fw-light">Showing you where your items are</p>
                    
                    <div class="d-flex align-items-center my-3">
                        <hr class="flex-grow-1 border-top border-secondary-subtle">
                        <span class="px-3 text-white text-uppercase fw-semibold" style="font-size: 0.75rem;">Log In</span>
                        <hr class="flex-grow-1 border-top border-secondary-subtle">
                    </div>

                    <!-- Input Fields (Placeholder) -->
                    <form action="{{ route('authenticate')}}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="email" name="email" placeholder="Email" class="form-control form-control-sm-insta" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" class="form-control form-control-sm-insta" required>
                        </div>

                        <button type="submit" class="btn btn-insta-blue w-100 mt-2 opacity-50 fw-semibold">
                            Log In
                        </button>
                    </form>

                    <p class="text-white mt-3 px-3" style="font-size: 0.65rem;">
                        By Logging in, you agree to our Terms, Privacy Policy and Cookies Policy.
                    </p>
                </div>

                <!-- Card 2: Login Link -->
                <div class="card card-insta bg-black p-3 w-100 text-center mb-3" style="max-width: 350px;">
                    <p class="text-white mb-0 fs-6">
                        Don't Have an account? 
                        <a href="#" class="text-decoration-none" style="color: var(--insta-blue); font-weight: 600;">Sign Up</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>