<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/404.png" />
    <title>Snoopy's Message Board</title>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-green.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

    <style>
        .w3-myfont {
            font-family: "Comic Sans MS", cursive, sans-serif;
        }
        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Comic Sans MS", cursive, sans-serif}
        .w3-sidenav a,.w3-sidenav h4 {font-weight:bold}

        .hint{
            color:red;
        }
    </style>
</head>
<body>
<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-collapse  w3-animate-lef w3-pale-green" style="z-index:800;width:300px;"
     id="mySidenav"><br>
    <div class="w3-container">
        <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-theme" title="close
        menu">
            <i class="fa fa-remove"></i>
        </a>
        <img src="images/404.png" class="w3-round" width="45%" />
        <br><br>
        <h4 class="w3-padding-0"><b><?= $user->name ?></b></h4>
        <p class="w3-text-grey">Template by W3.CSS</p>
    </div>
    <a href="/" class="w3-padding w3-text-teal"><i class="fa fa-home w3-xlarge"></i> 留言板</a>
    @if($login)
    <a href=" belong" class=" w3-text-teal w3-padding w3-hover-theme"><i class="fa fa-book w3-xlarge"></i> 我的留言</a>
    <a href="logout" class=" w3-text-teal w3-padding w3-hover-theme"><i class="fa fa-sign-out  w3-xlarge"></i>登出</a>
    @else
    <a href="register" class=" w3-text-teal w3-padding w3-hover-theme"><i class="fa fa-user-plus w3-xlarge"></i> 註冊</a>
    <a href="login" class=" w3-text-teal w3-padding w3-hover-theme"><i class="fa fa-sign-in  w3-xlarge"></i>登入</a>
    @endif
</nav>

<!-- Overlay effect when opening sidenav on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity w3-hover-theme" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

    <!-- Header -->
    <header class="w3-container w3-theme w3-padding-32 w3-top" style="z-index:600;">
        <a href="#"><img src="images/404.png" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity" width="65px"></a>

        <span class="w3-opennav w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
        <h1><b>Message Board with Laravel</b></h1>
    </header>

    <header class="w3-container w3-theme w3-padding-32" style="z-index:600;">
        <span class="w3-opennav w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
        <h1><b>Message Board with Laravel</b></h1>
    </header>



    <div class="w3-container w3-padding">
        <h1>TITLE</h1>
        <hr>
        <!-- Content -->
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-padding-4 w3-theme" >
        <div class="w3-row-padding">
            <h3>FOOTER</h3>
            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
        </div>
    </footer>

    <!-- End page content -->
</div>

<script>
    // Script to open and close sidenav
    function w3_open() {
        document.getElementById("mySidenav").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidenav").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }
</script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>