<?php 
    require_once 'auth.php';
    if(!isset($_SESSION["_agora_user_id"])){
      $login=false;
    }else{
      $login=true;
    }
    ?>

<html>

<head>
    <title>TMB: Post</title>
    <link rel="stylesheet" href="css/post.css">
    <script src="js/post.js" defer="true"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>
<header>
        <nav>
          <div id="titolo">
            TheMusicianBlog             
          </div>
          <div id="links">
            <a href="homepage.php">HOME</a>
            <a >POST</a>
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
        </div>
        </nav>
        <a class = "sottotitolo"> In questa sezione puoi creare dei piccoli contenuti recensivi sulla musica che ascolti.</a>
        </header>

        <div id="dropdown-menu" class="hidden">
        <a href="index.php">HOME</a>
        <a href="post.php">POST</a>
        <a href="preferiti.php">PREFERITI</a>
        <a href="profile.php">ACCOUNT</a>
        <a href="logout.php">LOGOUT</a>
    </div>
    
  <div class="ParentContainer">
    <?php
      if($login==true){
        echo "<div class='CreaArgomento'>";
        echo  "<h1>Crea un nuovo post</h1>";
        echo "<div class='TitleContainer'>";
        echo  "<h6>Inserisci un titolo</h6>";
        echo  "<input type='text' class='textboxTitle' placeholder='Scrivi il titolo...'/>";
        echo  "</div>";
        echo  "<div class='ArgomentContainer'>";
        echo  "<h6>Inserisci il contenuto del post</h6>";
        echo  "<textarea  class='textboxArgoment' placeholder='Scrivi qui...'></textarea>";
        echo  "</div>";
        echo  "<div class='CreaArgomentoBtnContainer'>";
        echo  "<div class='InviaArgomento'>Invia</div>";
        echo  "</div>";
        echo  "</div>";
      }
    ?>
    
  </div>

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
