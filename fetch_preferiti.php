<?php
require_once 'auth.php';
if (!$userid = checkAuth()) exit;

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

if (isset($_GET['search'])) {
    $username = mysqli_real_escape_string($conn, $_GET['search']);
    
    $query = "SELECT u.id, s.content 
              FROM users u
              JOIN songs s ON u.id = s.user_id 
              WHERE u.username = '$username'";
    
    $res = mysqli_query($conn, $query);

    $songs = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $songs[] = json_decode($row['content'], true);
    }

    echo json_encode($songs);
    exit;
}
?>
