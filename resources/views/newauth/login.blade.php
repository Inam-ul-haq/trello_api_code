extends('layouts.app')
@section(content)
<!-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>Sign In Page</title>
</head>
<body> -->
    <div class="container my-container-login">
            <h1 class="heading-signIn">Sign In</h1>

            <div class="container row">
            <form class="col-5 my-form-login">
                <div class="form-group inputWithIcon">
                    
                    <input type="text" class="form-control box" placeholder="Username or email" id="username-email" autocomplete="off">
                    <i class="fa fa-envelope fa-fw" aria-hidden="true"></i>
                </div>

                <div class="form-group inputWithLockIcon">
                    
                    <input type="password" class="form-control box" placeholder="Password" id="username-email" autocomplete="off">
                    <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                </div>

                <div class="form-group form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" /> Keep me signed in
                    </label>
                </div>

                <br>
                <a href="./Profile.html">
                    <button type="button" class="btn btn-primary button-custom">Sign In</button>
                </a>
                <hr>
                <div class="text-center">
                    <p class="text-custom-login"><a href="#">Create an account</a></p>
                </div>
            </form>
            <div class="col-5">
                <img src="./images/3.jpg" alt="img" class="image">
            </div>
        </div>
        </div>
    </div>
<!-- </body>
</html> -->
endsection