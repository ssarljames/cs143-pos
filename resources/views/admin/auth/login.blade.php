<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | CS143 POS</title>


    @include("templates.styles")

    <style>
        .input-group-text {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        body {
            font-family: "Courier New";
        }

        #login {
            min-height: 100vh;
            box-shadow: 3px 0 28px hsl(0deg 0% 46% / 50%);
        }

        @media only screen and (min-width: 767px) {
            #login {
                width: 350px !important;
            }
        }

    </style>


</head>
<body>
<form action="{{ route("authenticate") }}" method="POST">
    @csrf
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="h-100 d-flex align-items-center flex-column"  id="login">
                    <div class="my-auto w-md-100 px-0 px-md-3" style="width: 300px">

                        <div>
                            <h1 class="text-center mb-5">CS 143 POS</h1>
                            <div class="inner-addon right-addon mb-2 w-100">
                                <i class="fa fa-user text-danger"></i>
                                <input type="text" value="{{ old("username") }}" name="username" autocomplete="off" placeholder="Username"
                                       class="form-control border"/>
                            </div>

                            <div class="inner-addon right-addon w-100">
                                <i class="fa fa-lock text-danger"></i>
                                <input type="password" name="password" placeholder="Password"
                                       class="form-control border"/>
                            </div>

                            <button class="btn btn-danger w-100">
                                Login
                            </button>
                        </div>


                        @if(session("error"))
                            <p class="text-danger mt-3">
                                <strong>Oops!</strong> Username or password is incorrect
                            </p>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

</body>
</html>
