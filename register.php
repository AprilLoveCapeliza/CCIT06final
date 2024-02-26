<?php
if(isset($_SESSION['logged_in'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</head>
<body class="img js-fullheight" style="background-image: url(bg.jpg);">
<div class="container-fluid">
        <!-- navbar start -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary ">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php 
                                if(isset($_SESSION['logged_in'])){ ?>
                                    <a href="process.php?logout" class="nav-link">Logout</a>
                                <?php }else{ ?>
                                    <a href="login.php" class="nav-link">Login</a>
                                <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
<div class="row justify-content-center">
    <div class="col-md-4 mt-4">
        <?php
        if (isset($_GET['msg'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $_GET['msg'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form action="process.php" method="post" class="border p-3 m-3">
            <div class="mb-3">
                <label for="">Firstname</label>
                <input type="text" name="fname" id="" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Lastname</label>
                <input type="text" name="lname" id="" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" id="" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" name="pass1" id="" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Confirm-Password</label>
                <input type="password" name="pass2" id="" class="form-control">
            </div>
            <div class="mb-3">
                <button class="btn btn-warning" name="registerUser">Register</button>
            </div>
        </form>
    </div>
</div>
</body>

</html>