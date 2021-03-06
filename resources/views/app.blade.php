<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <meta property="og:url" content="https://cs-143-pos.herokuapp.com"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="@yield("seo-title", "CS 143 Project: Point Of Sale")"/>
    <meta property="og:description" content="This our project for CS 143 - Web Programming"/>
    <meta property="og:image" content="http://cs-143-pos.herokuapp.com/media/icon-144x144.png"/>




    <title>@yield("title", "POS")</title>

    <livewire:styles/>

    @include("templates.styles")
    @yield("styles")
</head>
<body>

<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <div class="logo">
            <a href="https://www.creative-tim.com" class="simple-text logo-mini">
                <!-- <div class="logo-image-small">
                  <img src="./assets/img/logo-small.png">
                </div> -->
                <!-- <p>CT</p> -->
            </a>
            <a href="https://www.creative-tim.com" class="simple-text logo-normal">
                CS 143 POS
                <!-- <div class="logo-image-big">
                  <img src="../assets/img/logo-big.png">
                </div> -->
            </a>
        </div>
        <div class="sidebar-wrapper">
            @include("templates.menu")
        </div>
    </div>
    <div class="main-panel" style="height: 100vh;">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="javascript:;">@yield("page-title")</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
{{--                    <form>--}}
{{--                        <div class="input-group no-border">--}}
{{--                            <input type="text" value="" class="form-control" placeholder="Search...">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <div class="input-group-text">--}}
{{--                                    <i class="nc-icon nc-zoom-split"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                    <ul class="navbar-nav">
                        <li class="nav-item btn-rotate dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="nc-icon nc-bell-55"></i>
                                {{ auth()->user()->full_name }}
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route("account") }}">Account</a>
                                <a class="dropdown-item" href="{{ route("logout") }}">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    @yield("page-content")
                </div>
            </div>
        </div>
{{--        <footer class="footer" style="position: absolute; bottom: 0; width: -webkit-fill-available;">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="row">--}}
{{--                    <div class="credits ml-auto">--}}
{{--                      <span class="copyright">--}}
{{--                        © 2020, made with <i class="fa fa-heart heart"></i> by Creative Tim--}}
{{--                      </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </footer>--}}
    </div>
</div>


<livewire:scripts/>

@include("templates.scripts")
@yield("scripts")
@stack("stackedScripts")
@stack("livewire-scripts")

</body>
</html>
