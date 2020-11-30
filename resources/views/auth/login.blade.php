@extends('layouts.app')

@section('content')

 <div class="container mt-5 pt-5">
      <h1 class="font-weight-normal mb-5">Sign In</h1>

   <div class="container row">
    <!-- <form class="col-5 my-form-login"> -->
         <form  class="col-lg-5 my-form-login" method="POST" action="{{ route('login') }}">
          @csrf
            <div class="form-group inputWithIcon">
                <input type="email" id="username-email"  name="email" value="{{ old('email') }}"  class="form-control box" placeholder="Email address" required autofocus>
                     @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                <i class="fa fa-envelope fa-fw" aria-hidden="true"></i>
            </div>
            <div class="form-group inputWithLockIcon">
                   <input type="password" id="inputPassword"   name="password" required autocomplete="current-password" class="form-control box" placeholder="Password" required>
                     @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                     @enderror
                <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
            </div>
         <div class="form-group form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" /> Keep me signed in
                </label>
            </div>
            <br>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
            <hr>
            <div class="text-center">
                @if (Route::has('register'))        
                    <a class="float-left ml-4" href="{{ route('register') }}">Create an account</a>
                @endif
            </div>
        </form>
            <div class="col-5">
                    <img src="{{ asset('image/3.jpg')}}" alt="img" class="image">
            </div>
    </div>
</div>



    <!-- asdfa -->
<!--  <div>
        <div class="container">
            <div class="row">
              <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                  <div class="card-body">
                    <h5 class="card-title text-center font-weight-bold">SIGN IN TO YOUR ACCOUNT</h5>
                    <form  method="POST" action="{{ route('login') }}">
                        @csrf
                      <div >
                        <label for="inputEmail">Email address</label>
                        <input type="email" id="inputEmail"  name="email" value="{{ old('email') }}"  class="form-control text-secondary" placeholder="Email address" required autofocus>
                         @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                          @enderror
                             @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        
                      </div>
        
                      <div>
                          <label for="inputPassword"  class="mt-1">Password</label>
                        <input type="password" id="inputPassword"   name="password" required autocomplete="current-password" class="form-control text-secondary" placeholder="Password" required>
                      
                      </div>
        
                      <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label text-secondary mt-1" for="customCheck1">Keep me signed in</label>
                        <label class="text-secondary pl-5 mt-1">Forgot your password?</label>
                      </div>
                      <button class="btn btn-lg btn-primary btn-block text-uppercase" type="button">Sign in</button>
                      <label class="text-secondary ml-5 pl-4 pt-4">Don't have an account?&nbsp;
          
                        @if (Route::has('register'))
                                
                                    <a class="signup" href="{{ route('register') }}">{{ __('Register') }}</a>
                               
                            @endif
                    </label>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
