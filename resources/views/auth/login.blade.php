<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login & Signup Form | Tanmis IT</title>
    <link rel="stylesheet" href="{{asset('frontend/css/login.css')}}">
</head>
<body>
    <section class="main">
        <div class="form_wrapper">
            <input type="radio" class="radio" name="radio" id="login" checked />
            <input type="radio" class="radio" name="radio" id="signup" />
            <div class="tile">
                <h3 class="login">Login Form</h3>
                <h3 class="signup">Signup Form</h3>
            </div>

            <label class="tab login_tab" for="login">
                Login
            </label>

            <label class="tab signup_tab" for="signup">
                Signup
            </label>
            <span class="shape"></span>
            <div class="form_wrap">
                <div class="form_fild login_form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input_group">
                            <input type="email" name="email" class="input @error('email') is-invalid @enderror" placeholder="Email Address" />
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="input_group">
                            <input type="password" name="password" class="input @error('password') is-invalid @enderror" placeholder="Password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <a href="{{ route('password.request') }}" class="forgot">Forgot password?</a>

                        <input type="submit" class="btn" value="Login" />

                        <div class="not_mem">
                            <label  for="signup">Not a member? <span> Signup now</span></label>
                        </div>
                    </form>
                </div>

                <div class="form_fild signup_form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input_group">
                            <input type="email" name="email" class="input" placeholder="Email Address" />
                        </div>
                        <div class="input_group">
                            <input type="password" name="password" class="input" placeholder="Password" />
                        </div>

                        <div class="input_group">
                            <input type="password" name="password_confirmation" class="input" placeholder="Confirm Password" />
                        </div>

                        <input type="submit" class="btn" value="Signup" />
                    </form>
                </div>
            </div>

        </div>
    </section>
</body>
</html>