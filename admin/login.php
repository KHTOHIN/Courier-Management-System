<?php include_once 'start.php';

// echo password_hash("admin", PASSWORD_DEFAULT);


// dump(getUserByEmail("biplob@gmail.com")["email"]);


$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    $v = new Valitron\Validator($_POST);

    $v->rule('required', ['password', 'email']);
    $v->rule('email', 'email');

    $email  = inputValid($_POST["email"]);
    $pass   = inputValid($_POST["password"]);

    if(!$v->validate()) {
        setSessionMessage("email", $email);
        $errors = $v->errors();
    } else{

        if(passCheck($email, $pass)){
            $_SESSION["id"] = getUserByEmail($email)["id"];
            $_SESSION["login"] = true;
            redirect("index.php");
        } else{
            setSessionMessage("credFaild", "Email or password wrong.");
            setSessionMessage("email", $email);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login admin panel</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="" method="post">
                    <?php 
                    if(isset($_SESSION["credFaild"])) {
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php getSessionMessage("credFaild"); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input class="form-control <?php if(isset($errors["email"])) echo "error_input"; ?>" name="email" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?php getSessionMessage("email"); ?>">
                        <?php if (isset($errors["email"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["email"]); ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control <?php if(isset($errors["password"])) echo "error_input"; ?>" name="password" id="password" type="password" placeholder="Password">
                        <?php if (isset($errors["password"])): ?>
                            <span class="help-block error_text"><?php echo current($errors["password"]); ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name="remember" type="checkbox"> Remember Password</label>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">

                    </form>
                </div>
                <div class="card-footer text-center">
                    <a class="d-block small mt-3" href="../index.php">Visit Main Site</a>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    </body>

    </html>
