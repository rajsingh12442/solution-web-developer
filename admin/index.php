<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Admin Login</title>
</head>
<?php

include("config.php");
if (isset($_REQUEST['sign-up'])) {
    if (($_REQUEST['name'] == "") || ($_REQUEST['email'] == "") || ($_REQUEST['psw'] == "") || ($_REQUEST['con_psw'] == "")) {
        $regmsg = '<div class="alert alert-warning mt-2" role="alert"> All Fields are Required </div>';
    } else {
        $sql = "SELECT email FROM admin_login WHERE email='" . $_REQUEST['email'] . "' ";
        $result = $db->query($sql);
        if ($result->num_rows == 1) {
            $regmsg = '<div class="alert alert-warning mt-2" role="alert"> Email ID Already Registed</div>';
        } else {
            $Name = $_REQUEST['name'];
            $Email = $_REQUEST['email'];
            $Password = md5($_REQUEST['psw']);
            $cPassword = md5($_REQUEST['con_psw']);
            $sql = "INSERT INTO admin_login(name, email, pass, con_pass) VALUES('$Name','$Email','$Password','$cPassword')";
            if ($db->query($sql) == TRUE) {
                $regmsg = '<div class="alert alert-success mt-2" role="alert"> Account Succesfully Created </div>';
            } else {
                $regmsg = '<div class="alert alert-danger mt-2" role="alert">Unable to Create Account </div>';
            }
        }
    }
}
// Define variables and initialize with empty values
$username = $password = $id = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    if (isset($_POST['login'])) {
        // Check if username is empty
        if (empty(trim($_POST["email"]))) {
            $username_err = "Please enter username.";
        } else {
            $username = trim($_POST["email"]);
        }
        if (empty(trim($_POST["psw"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = md5($_POST["psw"]);
        }
        $sql = "SELECT id,name,email,pass FROM admin_login WHERE email = '" . $username . "' and pass = '" . $password . "' limit 1";
        $result = mysqli_query($db, $sql) or die("Query Failed.");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["name"] = $username;
                $_SESSION["id"] = $id;
                header("location: dashboard.php");
            }
        } else {
            $login_err = "Invalid username or password.";
        }
    }
}
?>

<body>

    <div class="container px-4 py-5 mx-auto">
        <div class="card card0">
            <div class="d-flex flex-lg-row flex-column-reverse">
                <div class="card card1">
                    <?php
                    if (!empty($login_err)) {
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }
                    ?>
                    <form method="post" action="" name="signin-form">
                        <div class="row justify-content-center my-auto">
                            <div class="col-md-8 col-10 my-5">
                                <h3 class="mb-5 text-center heading">Login</h3>
                                <h6 class="msg-info">Please login to your account</h6>
                                <div class="form-group"> <label class="form-control-label text-muted">Username</label> <input type="text" id="email" name="email" placeholder=" email id" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"> <span class="invalid-feedback"><?php echo $username_err; ?></span></div>
                                <div class="form-group"> <label class="form-control-label text-muted">Password</label> <input type="password" id="psw" name="psw" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"><span class="invalid-feedback"><?php echo $password_err; ?></span></div>
                                <div class="row justify-content-center my-3 px-3"> <button class="btn-block btn-color" name="login" value="login">Login to SSMotoGen</button> </div>
                                <div class="row justify-content-center my-2"> <a href="#"><small class="text-muted">Forgot Password?</small></a> </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card card2">
                    <?php
                    if (!empty($regmsg)) {
                        echo $regmsg;
                    }
                    ?>
                    <div class="my-auto mx-md-5 px-md-5 right">
                        <form method="post" action="" name="signup-form">
                            <div class="row justify-content-center my-auto">
                                <div class="col-md-8 col-10 my-5">
                                    <h3 class="mb-5 text-center heading">Sign Up</h3>
                                    <h6 class="msg-info">Registration</h6>
                                    <div class="form-group"> <label class="form-control-label text-muted">Name</label> <input type="text" id="name" name="name" placeholder=" name" class="form-control"> </span></div>

                                    <div class="form-group"> <label class="form-control-label text-muted">Email</label> <input type="text" id="email" name="email" placeholder=" email id" class="form-control"> </span></div>
                                    <div class="form-group"> <label class="form-control-label text-muted">Password</label> <input type="password" id="psw" name="psw" placeholder="Password" class="form-control"><span class="invalid-feedback"></span></div>
                                    <div class="form-group"> <label class="form-control-label text-muted">Confirm Password</label> <input type="password" id="con_psw" name="con_psw" placeholder="confirm Password" class="form-control"><span class="invalid-feedback"></span></div>
                                    <div class="row justify-content-center my-3 px-3"> <button class="btn-block btn-color" name="sign-up" value="sign-up">Sign Up </button> </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>