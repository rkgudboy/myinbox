<?php
include ('config.php');
session_start();
if(count($_POST)>0) {
$result = mysqli_query($conn,"SELECT * FROM $db_table WHERE username='" . $_POST["username"] . "' and password = '". $_POST["password"]."'");
$resultset  = mysqli_fetch_assoc($result);
if(is_array($resultset)){$_SESSION["username"] = $resultset["username"];header("Location: mailbox.php");}
else { header("Location: index.php");}
}
?>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to your Inbox</title>
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
</head>
<body>
<div class="demo-blog mdl-layout mdl-js-layout has-drawer is-upgraded">
	<header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Inbox</span>
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
        </div>
      </header>
      <main class="mdl-layout__content">
<div align="center">
	<div class="demo-card-wide mdl-card mdl-shadow--2dp"><div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Login to get started..</h2></div>
  <div class="mdl-card__supporting-text">
    <form method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
	<div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type="text" name="username" size="40"><label class="mdl-textfield__label" for="sample1">Your Username...</label></div><br> 
	<div class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" type="password" name="password" size="40"><label class="mdl-textfield__label" for="sample1">Your Password...</label></div><br> 
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <input id="button" type="submit" name="submit" value="Log-In" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"><br>
	</form>
  </div>
</div></div>
	</main>
</div>
<script src="scripts/material.min.js"></script>
</body>
</html>