<?php
//Richieste appartenenti alla pagina post
require_once 'auth.php';
if (!$userid = checkAuth()) exit;

header('Content-Type: application/json');

if(isset($_GET['richiesta'])){
    
     $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $richiesta=mysqli_real_escape_string($conn,$_GET['richiesta']);

    if($richiesta=="add_argoment"){

        if(isset($_POST['titolo']) && isset($_POST['contenuto']) && isset($_POST['id_user']) && isset($_POST['data_pubblicazione'])){

            $titolo=mysqli_real_escape_string($conn,$_POST['titolo']);
            $contenuto=mysqli_real_escape_string($conn,$_POST['contenuto']);
            $ID_User=mysqli_real_escape_string($conn,$_POST['id_user']);
            $orario=mysqli_real_escape_string($conn,$_POST['data_pubblicazione']);
        
            $quary="INSERT INTO Argomenti (Titolo,Contenuto,ID_User,Data_Pubblicazione) VALUES(\"$titolo\",\"$contenuto\",\"$ID_User\",\"$orario\")";
        
            $res=mysqli_query($conn,$quary);
            if(!$res){
                $messaggio=array(array("MSG" => "0", "Messaggio" => "Errore Argomento"));
                echo json_encode($messaggio);
                mysqli_close($conn);
                exit;
            }else{
                $messaggio=array(array("MSG" => "1", "Messaggio" => "OK"));
                echo json_encode($messaggio);
                mysqli_close($conn);
                exit;
            }
        
        }


        }elseif($richiesta=="add_like"){

        if(isset($_POST['username']) && isset($_POST['ID_arg'])){

            $username=mysqli_real_escape_string($conn,$_POST['username']);
            $id_arg=mysqli_real_escape_string($conn,$_POST['ID_arg']);
            $quary="INSERT INTO likes (ID_argomento,ID_user) VALUES(\"$id_arg\",\"$username\")";
           
            $res=mysqli_query($conn,$quary);
            if(!$res){
                $messaggio=array(array("MSG" => "0", "Messaggio" => "Errore Like"));
                echo json_encode($messaggio);
                mysqli_close($conn);
                exit;
            }
            $quary1="SELECT ID_like, ID_argomento from likes WHERE ID_argomento='".$id_arg."' AND ID_User='".$username."'";
            $res1=mysqli_query($conn,$quary1);
            $row=mysqli_fetch_assoc($res1);
            echo json_encode($row);
            mysqli_close($conn);
        }

    
    }elseif($richiesta=="get_argoment"){

        if(isset($_POST['id_arg'])){
            $id_arg=mysqli_real_escape_string($conn,$_POST['id_arg']);
            $quary="SELECT * FROM argomenti WHERE ID_arg='".$id_arg."'";
            $res=mysqli_query($conn,$quary);
            $argomento=mysqli_fetch_assoc($res);
            mysqli_free_result($res);
            mysqli_close($conn);
        
            echo json_encode($argomento);
        }
        
    }elseif($richiesta=="get_argoments"){

        $argomenti=array();
        $quary="SELECT * FROM argomenti order by Data_Pubblicazione DESC";
        $res=mysqli_query($conn,$quary);

        while($row=mysqli_fetch_assoc($res)){
            $argomenti[]=$row;
        }

        mysqli_free_result($res);
        mysqli_close($conn);

        echo json_encode($argomenti);

    }elseif($richiesta=="get_likes"){

        $like=array();
        $quary="SELECT * FROM likes";
        $res=mysqli_query($conn,$quary);
    
        while($row=mysqli_fetch_assoc($res)){
            $like[]=$row;
        }
    
        mysqli_free_result($res);
        mysqli_close($conn);
    
        echo json_encode($like);
    
    }elseif($richiesta=="remove_like"){

        if(isset($_POST['id_like'])){

            $id_like=mysqli_real_escape_string($conn,$_POST['id_like']);
            $quary="DELETE FROM likes WHERE (ID_Like = '".$id_like."')";
            $res=mysqli_query($conn,$quary);
            if($res){
                $messaggio=array(array("MSG" => "0", "Messaggio" => "OK"));
                echo json_encode($messaggio);
            }else{
                $errore=array(array("MSG" => "1", "Messaggio" => "Errore!"));
                echo json_encode($errore);
            }
            mysqli_close($conn);
        }
        
    }elseif($richiesta=="num_like"){

        if(isset($_POST['id_arg'])){

            $id_argomento=mysqli_real_escape_string($conn,$_POST['id_arg']);
            $quary= "SELECT count(*) as numLike, ID_argomento from likes where ID_argomento ='".$id_argomento."'";
            $res=mysqli_query($conn,$quary);
            $row=mysqli_fetch_assoc($res);
            mysqli_free_result($res);
            mysqli_close($conn);
            echo json_encode($row);
            
        }
            
    }

}

?>