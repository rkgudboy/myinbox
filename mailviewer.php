<?php
session_start();
include ('config.php');
$db_table=$_SESSION["username"];
$message_id = $_POST['message_id'];  
$result = mysqli_query($conn,"SELECT * FROM $db_table WHERE message_id= $message_id");
if($row  = mysqli_fetch_assoc($result)){
echo "<div class='mdl-card__media meta mdl-color-text--grey-50'><h4>".$row['subject']."</h4></div>";
echo "<div class='mdl-color-text--grey-700 mdl-card__supporting-text'><h5>From: ".$row['from']."</h5></div>";
echo "<div class='mdl-color-text--grey-700 mdl-card__supporting-text'>".$row['message']."</div>";
$result = mysqli_query($conn,"UPDATE $db_table SET seen=1 WHERE message_id= $message_id");
}
 ?>