<?php
ob_start();
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: index.php");
}
include_once 'dbconnect.php';

if (isset($_POST['signup'])) {

    $uname = trim($_POST['uname']); // get posted data and remove whitespace
    $email = trim($_POST['email']);
    $upass = trim($_POST['pass']);

    // hash password with SHA256;
    $password = hash('sha256', $upass);

    // check email exist or not
    $stmt = $conn->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $count = $result->num_rows;

    if ($count == 0) { // if email is not found add user


        $stmts = $conn->prepare("INSERT INTO users(username,email,password) VALUES(?, ?, ?)");
        $stmts->bind_param("sss", $uname, $email, $password);
        $res = $stmts->execute();//get result
        $stmts->close();

        $user_id = mysqli_insert_id($conn);
        if ($user_id > 0) {
            $_SESSION['user'] = $user_id; // set session and redirect to index page
            if (isset($_SESSION['user'])) {
                print_r($_SESSION);
                header("Location: index.php");
                exit;
            }

        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again";
        }

    } else {
        $errTyp = "warning";
        $errMSG = "Email is already used";
    }

}
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registration</title>
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
                     <a id="sign-up-anchor" href="login.php" type="button" class="btn btn-block btn-danger"
                       name="btn-login">Log in</a>
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
                    <h2 class="">Register for our Website</h2>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <?php
                if (isset($errMSG)) {

                    ?>
                    <div class="form-group">
                        <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="uname" class="form-control" placeholder="Enter Username" required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Enter Password"
                               required/>
                    </div>
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" id="TOS" value="This"><a href="#">I agree with
                            terms of service</a></label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn    btn-block btn-primary" name="signup" id="reg">Register</button>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <div class="form-group">
                    <a href="login.php" type="button" class="btn btn-block btn-success" name="btn-login">Login</a>
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
<script type="text/javascript" src="assets/js/tos.js"></script>

</body>
</html>
