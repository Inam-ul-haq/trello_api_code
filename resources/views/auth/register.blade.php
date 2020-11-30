@extends('layouts.app')

@section('content')

<div class="container my-container-signUp">
   <h1 class="font-weight-normal mb-5">Sign Up</h1> 

    <div class="container row">

          <form class="col-lg-5" method="POST" action="{{ route('register') }}">
           @csrf
         
              <div class="form-group inputWithIcon-signUp"> 
               <input type="name" id="inputEmail" class="form-control box" 
                  name="name" value="{{ old('name') }}" 
                  placeholder="Enter your Name" required autofocus>
                   @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              <i class="fa fa-envelope fa-fw" id="username-box" aria-hidden="true"></i>
          </div>

          <div class="form-group inputWithIcon-signUp"> 
               <input type="email" id="inputEmail" class="form-control box" 
                  name="email" value="{{ old('email') }}" 
                  placeholder="Enter your Email" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              <i class="fa fa-envelope fa-fw" id="username-box" aria-hidden="true"></i>
          </div>
          <div class="form-group inputWithLockIcon-signUp">   
             <!--  <input type="password" class="form-control box" placeholder="Password" id="username-email" autocomplete="off"> -->
                <input type="password" id="inputPassword" name="password" class="form-control box" placeholder="Enter your Password" required>
                   @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
              <i class="fa fa-lock fa-lg fa-fw" id="pass-box" aria-hidden="true"></i>
          </div>
          <div class="form-group inputWithLockIcon-signUp">
              
          <!--     <input type="password" class="form-control box" placeholder="Confirm Password" id="username-email" autocomplete="off"> -->
               <input type="name" id="recinputPassword" class="form-control box"  name="password_confirmation" placeholder="Enter your UserName" required>
                <i class="fa fa-lock fa-lg fa-fw" id="pass-box" aria-hidden="true"></i>
          </div>
          <button type="submit" class="btn btn-primary btn-lg btn-block">Sign Up</button>
          <hr>
          <div class="row">
               <p class="col">Already have an account?</p>
              <p class="col-6"><a href="{{ route('login') }}">Sign In</a></p>
          </div>
      </form>
      <div class="col-5">
          <img src="{{asset('image/4.jpg')}}" alt="img" class="image">
      </div>
    </div>
</div>


<!-- <div class="container my-container-signUp">
        <h1 class="font-weight-normal mb-5">Sign Up</h1>  

        <div class="container row">
            <form class="col-lg-5">
                <div class="form-group inputWithIcon-signUp">
                    
                    <input type="text" class="form-control box" placeholder=" Email" id="username-email" autocomplete="off">
                    <i class="fa fa-envelope fa-fw" id="username-box" aria-hidden="true"></i>
                </div>

                <div class="form-group inputWithLockIcon-signUp">
                    
                    <input type="password" class="form-control box" placeholder="Password" id="username-email" autocomplete="off">
                    <i class="fa fa-lock fa-lg fa-fw" id="pass-box" aria-hidden="true"></i>
                </div>

                <div class="form-group inputWithLockIcon-signUp">
                    
                    <input type="password" class="form-control box" placeholder="Confirm Password" id="username-email" autocomplete="off">
                    <i class="fa fa-lock fa-lg fa-fw" id="pass-box" aria-hidden="true"></i>
                </div>
                
                
                    <button type="button" class="btn btn-primary btn-lg btn-block">Sign In</button>
            
                <hr>
                <div class="row">
                    <p class="col">Already have an account?</p>
                    <p class="col-6"><a href="#">Sign In</a></p>
                </div>
            </form>
            <div class="col-5">
                <img src="./images/4.jpg" alt="img" class="image pl-5 ml-5">
            </div>
        </div>
    </div>
 -->
 <!-- <div>
        <div class="container">
            <div class="row">
              <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                  <div class="card-body">
                    <h5 class="card-title text-center font-weight-bold">SIGN UP TO YOUR ACCOUNT</h5>
                    <form  method="POST" action="{{ route('register') }}">
                         @csrf
                     <div>
                         <label for="reinputPassword">Name</label>
                        <input type="name" id="reinputPassword" class="form-control text-secondary" name="name" value="{{ old('name') }}" placeholder="Enter your UserName" required>
                         @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                       
                      </div>
                      <div>
                         <label for="inputEmail" class="mt-1">Email</label>
                        <input type="email" id="inputEmail" class="form-control text-secondary" 
                        name="email" value="{{ old('email') }}" 
                        placeholder="Enter your Email" required autofocus>
                          @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                          @enderror
                       
                      </div>
                      <div>
                         <label for="inputPassword"  class="mt-1">Password</label>
                        <input type="password" id="inputPassword" name="password" class="form-control text-secondary" placeholder="Enter your Password" required>
                         @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                       
                      </div>
                      <div>
                         <label for="recinputPassword"  class="mt-1">ConfirmPassword</label>
                        <input type="name" id="recinputPassword" class="form-control text-secondary"  name="password_confirmation" placeholder="Enter your UserName" required>     
                      </div>
                      <button class="btn btn-lg btn-primary btn-block text-uppercase mt-2" type="button">Register</button>
                      <label class="text-secondary ml-5 pl-4 pt-4"> Have an account?&nbsp;
                
                            <a class="signup" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </label>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
 -->
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
