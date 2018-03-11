<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
// select logged in users detail
$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

?>
<!DOCTYPE html> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hello,<?php echo $userRow['email']; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
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

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span
                            class="glyphicon glyphicon-user"></span>&nbsp;Logged
                        in: <?php echo $userRow['email']; ?>
                        &nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>




<div class="container">
    <!-- Jumbotron-->
    <div class="jumbotron">
        <h1>Hello, <?php echo $userRow['username']; ?></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at auctor est, in convallis eros. Nulla
            facilisi. Donec ipsum nulla, hendrerit nec mauris vitae, lobortis egestas tortor. </p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>Example body text</h2>
            <p>Nullam quis risus eget <a href="#">urna mollis ornare</a> vel eu leo. Cum sociis natoque penatibus et
                magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
            <p>
                <small>This line of text is meant to be treated as fine print.</small>
            </p>
            <p>The following snippet of text is <strong>rendered as bold text</strong>.</p>
            <p>The following snippet of text is <em>rendered as italicized text</em>.</p>
            <p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>

        </div>


    </div>
</div>
<div class="footer" style="background-color:black">
<div class="logo-footer">
 O<span class="blue">Sqool</span>
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
<div class="footer-right" >
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
