<?php
session_start();
include ('config.php');
$result = mysqli_query($conn,"SELECT * FROM $db_table WHERE username = '". $_SESSION["username"]."'");
$row  = mysqli_fetch_assoc($result);
if($_SESSION["username"]) {
//inbox starts
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to your Inbox - <?php echo $_SESSION["username"]; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
    <script>
    function open_mail(str)  
{  
document.getElementById(str).className = "mdl-button mdl-js-button";
var message_id = document.getElementById(str).value;  
var xhr;  
 if (window.XMLHttpRequest) { // Mozilla, Safari, ...  
    xhr = new XMLHttpRequest();  
} else if (window.ActiveXObject) { // IE 8 and older  
    xhr = new ActiveXObject("Microsoft.XMLHTTP");  
}  
var data = "message_id=" + str;  
     xhr.open("POST", "mailviewer.php", true);   
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
     xhr.send(data);  
     xhr.onreadystatechange = display_data;  
    function display_data() {  
     if (xhr.readyState == 4) {  
      if (xhr.status == 200) {  
       //alert(xhr.responseText);        
      document.getElementById("messagebody").innerHTML = xhr.responseText;  
      } else {  
        alert('There was a problem with the request.');  
      }  
     } ;
    }
}</script>
</script>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Mailbox - Home</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <a href="logout.php"><li class="mdl-menu__item">Logout</li></a>
          </ul>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="images/user.jpg" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span><?php echo $_SESSION["username"]; ?></span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <li class="mdl-menu__item"><i class="material-icons">add</i>Login with another ...</li>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i>Trash</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">report</i>Spam</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Forums</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i>Updates</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_offer</i>Promos</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Purchases</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Social</a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
   <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
    <?php
    $sql="SELECT `subject`, `from`, `message_id`, `seen` FROM `". $_SESSION["username"]."`";
    if ($results = mysqli_query($conn, $sql)) {
    foreach ($results as $result) {
      if($result['seen'])echo "<input type='button' class='mdl-button mdl-js-button' onclick="."open_mail('".$result['message_id']."')"." id='".$result['message_id']."' value='".$result['subject']."'>";
      else echo "<input type='button' class='mdl-button mdl-js-button  mdl-button--primary' onclick="."open_mail('".$result['message_id']."')"." id='".$result['message_id']."' value='".$result['subject']."'>";
      echo "<span class='mdl-tooltip' id='".$result['message_id']."'>".$result['from']."</span>";
      
    }
    mysqli_free_result($results);}
    ?>
    </nav>
  </div>
  <main class="mdl-layout__content">
          <div class="mdl-card mdl-shadow--4dp mdl-cell mdl-cell--9-col" id='messagebody'>
            <div class='mdl-card__media meta mdl-color-text--grey-50'><h4>Welcome to your Inbox <?php echo $_SESSION["username"]; ?></h4></div>
            <div class='mdl-color-text--grey-700 mdl-card__supporting-text'>Please click on a message to get started.</div>
          </div>
  </main>
</div>
      </main>
      </div>
      <a href="http://rohitkashyap.in" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">Contact Developer</a>
    <script src="scripts/material.min.js"></script>
  </body>
</html>



<?php
//inbox ends
}
else {header("Location: index.php");} 
?>