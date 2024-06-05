<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>

  <?php 
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
  ?>


    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>
            TMB: <?php echo $userinfo['name']." ".$userinfo['surname'] ?>
            </title>
            <link rel="stylesheet" href="css/profile.css" />
            <script src="js/profile.js" defer="true"> </script>
    </head>
    
    <body>
        <div id="overlay" class="hidden"> </div>
        <header>
        <nav>
          <div id="titolo">
            TheMusicianBlog             
          </div>
          <div id="links">
            <a href="homepage.php">HOME</a>
            <a href="post.php">POST</a>
            <a href="preferiti.php">PREFERITI</a>
            
            <div id="separator"> </div>
            <a href="profile.php"> ACCOUNT </a>
            <a href="logout.php" class="button">LOGOUT</a>
          </div>
      <div id="menu">
            <div></div>
            <div></div>
            <div></div>
      </div>

        </nav>
        </header>
       

        <div id="dropdown-menu" class="hidden">
        <a href="index.php">HOME</a>
        <a href="post.php">POST</a>
        <a href="preferiti.php">PREFERITI</a>
        <a href="profile.php">ACCOUNT</a>
        <a href="logout.php">LOGOUT</a>
    </div>


        <article>
        <section class="infoaccount">
        <div class="infoaccount-container">   
        <em>Il mio account</em>     
        <p class="info-account"> Nome: <?php echo $userinfo['name']." "?> </p>
        <p class="info-account"> Cognome: <?php echo $userinfo['surname']." "?>  </p>
        <p class="info-account"> Email: <?php echo $userinfo['email']." "?>  </p>
        <p class="info-account"> Username: <?php echo $userinfo['username']." "?>  </p> 
        </div>
        </section>
        </article>

    <footer>
      <nav>
        <div class="footer-container">
          <div class="footer-col">
            <h1>TheMusicianBlog</h1>
          </div>
          <div class="footer-col">
            <strong>Web Programming 2023-2024</strong>
            <p>Creato da: Giuseppe Emanuele Di Franco 1000014430</p>
          </div>
        
        </div>
      </nav>
    </footer>
   </body>
   </html>