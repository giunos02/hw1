<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $userid = mysqli_real_escape_string($conn, $userid);
    
    $next = isset($_GET['from']) ? 'AND songs.id < '.mysqli_real_escape_string($conn, $_GET['from']).' ' : '';

    $query = "SELECT id, user_id, song_id, content from songs where user_id = $userid ORDER BY id DESC LIMIT 10";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $songArray = array();
    while($entry = mysqli_fetch_assoc($res)) {
        $songArray[] = array('userid' => $entry['user_id'],
                            'songid' => $entry['song_id'], 'content' => json_decode($entry['content']));
    }
    echo json_encode($songArray);
    
    exit;


?>