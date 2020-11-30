extends(layouts.app)
@section('content')

<!-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	 <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>Sign Up Page</title>
</head>
<body> -->
    <div class="container my-container-signUp">
        <div class="heading">
        <h1>Sign Up</h1>	
        </div>

        <div class="container row">
            <form class="col-5 my-form-signUp">
                <div class="form-group inputWithIcon-signUp">
                    
                    <input type="text" class="form-control box" placeholder="Username or email" id="username-email" autocomplete="off">
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
                
                <a href="./Profile.html">
                    <button type="button" class="btn btn-primary button-custom-signUp">Sign In</button>
                </a>
                <hr>
                <div class="row">
                    <p class="col">Already have an account?</p>
                    <p class="col-6"><a href="#">Sign In</a></p>
                </div>
            </form>
            <div class="col-5">
                <img src="./images/4.jpg" alt="img" class="image">
            </div>
        </div>
    </div>
<!-- </body>
</html> -->
@endsection