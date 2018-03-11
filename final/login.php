<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is set direct to index
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['btn-login'])) {
    $email = $_POST['email'];
    $upass = $_POST['pass'];

    $password = hash('sha256', $upass); // password hashing using SHA256
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email= ?");
    $stmt->bind_param("s", $email);
    /* execute query */
    $stmt->execute();
    //get result
    $res = $stmt->get_result();
    $stmt->close();

    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    $count = $res->num_rows;
    if ($count == 1 && $row['password'] == $password) {
        $_SESSION['user'] = $row['id'];
        header("Location: index.php");
    } elseif ($count == 1) {
        $errMSG = "Bad password";
    } else $errMSG = "User not found";
}
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
    <link rel="stylesheet" href="style1.css">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="header-container">
    <div class="inner-header">
        <div class="logo-header"> <div class="logo"><a href="dom.html" style="text-decoration:none;">
 O<span class="blue">Sqool</span></a>
 </div>
        </div>
                
                <div class="ask-questions-container">
                    <a id="ask-anchor" ><input type="button" id="ask-questions" value="Ask Questions"></a>
                </div>
                
                <div class="search-container">
                    <a id="search-anchor"><input type="search" id="search-box" placeholder="Search for questions, people, and topics"></a>
                </div>
                <div class="nav-rightSide">
                <div class="tools-container">
                        
                        
                        <span id="tools-icon"><a id="tools-anchor"><input type="button" id="tools" value="   Use tools"></span></a>



                </div>     
                <div class="sign-up-container">
<!--                    <a id="sign-up-anchor"><input type="button" onclick="register.php" id="sign-up" value="Sign up"></a>-->
                     <a id="sign-up-anchor" href="register.php" type="button" class="btn btn-block btn-danger"
                       name="btn-login">Sign up</a>
                </div>         
                
            </div>
                
                
                    
            
        </div>

        
    </div>
</div>
<div class="container">


    <div id="login-form">
        <form method="post" autocomplete="off">

            <div class="col-md-12">

                <div class="form-group">
                    <h2 class="">Login:</h2>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <?php
                if (isset($errMSG)) {

                    ?>
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Password" required/>
                    </div>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="btn-login">Login</button>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <div class="form-group">
                    <a href="register.php" type="button" class="btn btn-block btn-danger"
                       name="btn-login">Register</a>
                </div>

            </div>

        </form>
    </div>

</div>
<footer>

<div class="footer">
<div class="logo-footer">
 O<span class="blue">Sqool
 </div>
 <div class="footer-content">
 <div class="footer-left">
 <ul class="info">
 <li>About Us</li>
 <li>Career</li>
 <li>Contact Us</li>
 <li>Help</li>
 
 </ul>
</div >
<div class="footer-right">
 <ol class="list">
   <li><a href="https://ssarks146084128.wordpress.com">Blog</li>
   <li><a href="https://www.facebook.com/Sydthekid8010">Facebook</li>
   <li><a href="https://twitter.com/ssark007">Twitter</li>
   <li><a href="https://www.linkedin.com/in/sudipta-sarkar-61692078/">Linkedin</li>
 </ol>
</div>
</div>
</div>
    </footer>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
