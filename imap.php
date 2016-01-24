<?php
include('config.php');
session_start();
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$hostname = "SERVER ADDRESS HERE";
$username = "USERNAME HERE";
$password = "PASSWORD HERE";
$inbox = imap_open($hostname,$username,$password);
$emails = imap_search($inbox,'ALL');
foreach($emails as $e){
$overviews = imap_fetch_overview($inbox,$e);
echo "message overview";
foreach($overviews as $overview) {
echo $overview->from,PHP_EOL;
echo "<br>";
echo $overview->subject,PHP_EOL;
echo "<br>";
echo $overview->to,PHP_EOL;
echo "<br>";
echo $overview->date,PHP_EOL;
echo "<br>";
echo $overview->message_id,PHP_EOL;
echo "<br>";
echo $overview->size,PHP_EOL;
echo "<br>";
echo $overview->uid,PHP_EOL;
echo "<br>";
echo $overview->msgno,PHP_EOL;
echo "<br>";
echo $overview->recent,PHP_EOL;
echo "<br>";
echo $overview->flagged,PHP_EOL;
echo "<br>";
echo $overview->answered,PHP_EOL;
echo "<br>";
echo $overview->deleted,PHP_EOL;
echo "<br>";
echo $overview->seen,PHP_EOL;
echo "<br>";
echo $overview->draft,PHP_EOL;
echo "<br>";
echo $overview->udate,PHP_EOL;
echo "<br>";
$message = imap_body($inbox,$e);
echo $message, PHP_EOL;
echo "<br>";
$result = "INSERT INTO `rkgudboy`(`subject`, `from`, `to`, `date`, `message_id`, `size`, `uid`, `msgno`, `recent`, `flagged`, `answered`, `deleted`, `seen`, `draft`, `udate`, `message`) VALUES ($overview->subject,$overview->from,$overview->to,$overview->date,$overview->message_id,$overview->size,$overview->uid,$overview->msgno,$overview->recent,$overview->flagged,$overview->answered,$overview->deleted,$overview->seen,$overview->draft,$overview->udate,$message)";
//echo $result, PHP_EOL;
//if (mysqli_query($conn, $result)) {echo "New record created successfully";} 
//else {echo "Error: " ;}
}
}
imap_close($inbox);
?>