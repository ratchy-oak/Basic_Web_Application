<?php
$mysqli = new mysqli('localhost', 'root', '', 'webapp');

if ($mysqli === false) {
    echo ("ERROR: Could not conect. " . $mysqli->connect_error);
}

session_start();
?>