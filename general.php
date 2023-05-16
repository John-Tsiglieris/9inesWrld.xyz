<?php
  require 'config.php';
  require 'php\functions.php';
  require 'php\html.php';

  if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query(Database::$conn, "SELECT * FROM users WHERE ID = $id");
    $row = mysqli_fetch_assoc($result);
  }
  //this chunk of code is where I left off migrating the logins to popups
  if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query(Database::$conn, "SELECT * FROM users WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
      if($password == $row["password"]){
        $_SESSION["login"] = true;
        $_SESSION["id"] = $row["ID"];
        echo "id: " . $_SESSION["id"];
        print_r($_SESSION);
        header("Location: index.php");
        $GLOBALS['username'] = $username;
      }
      else{
        echo
    		"<script> alert('Wrong Password'); </script>";
      }
    }
    else {
      echo
    	"<script> alert('User not registered'); </script>";
    }
  }
  //this chunk of code is where I left off migrating the logins to popups ^^^

  if(!empty($_POST["title"])) {
    //print_r($_POST["input"]);
    $title = "'".$_POST["title"]."'";
    $content = "'".$_POST["message"]."'";
    if(!empty($_SESSION["id"])) {
      $id = $_SESSION["id"];
      $result = mysqli_query(Database::$conn, "SELECT * FROM users WHERE ID = $id");
      $row = mysqli_fetch_assoc($result);
      $id = "'".$row["username"]."'";
    } else {
      $id = 'anon';
      $id = "'".$id."'";               // I forgot why this is needed but it definitely is needed
    }
    $sql = "INSERT INTO threads (title, op, content, date) VALUES ($title, $id, $content, CURRENT_TIMESTAMP())";
    $result = mysqli_query(Database::$conn, $sql);
    if ($result) { // if thread successfully created, create comments chatlog
      //echo "Insertion successful";
     $result = mysqli_query(Database::$conn, "SELECT * FROM threads WHERE title = $title");
     $row = mysqli_fetch_assoc($result);
     //chatlog table name == ID of the corresponding thread
     $tableID = "`".$row["ID"]."`";

     $sql = "CREATE TABLE IF NOT EXISTS $tableID (
     ID int NOT NULL primary key AUTO_INCREMENT,
     username varchar(255) NOT NULL default '',
     text varchar(1500) NOT NULL default '',
     date varchar(21) NOT NULL default ''
     )";
     $result = mysqli_query(Database::$conn, $sql); // table created

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  }
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>General</title>
  <meta name="Homepage" content="Homepage">
  <link rel="stylesheet" href="styles.css">
  <script src="js/scripts.js"></script>
</head>




<body id="background" style="background: #333333 url('images/thing.png');">

  <!Heading>
  <?php
  if(!empty($_SESSION["id"])){
    createHeadingUser($GLOBALS['username']);
  } else {
    createHeadingAnon();
  }
  ?>
  <!links>
  <div class="links">
    <section class="links">
      <h3>Links</h3>
      <a href="blogs/1.html"> First blog </a>
      <a href="blogs/2.html"> Second blog </a>
    </section>
  </div>
  <?php
  userprofilePopupContainer();
  threadPopupContainer();
  registerPopupContainer();
  loginPopupContainer();
  ?>

	<script>
		window.onscroll = function() {stick()};

		var header = document.getElementById("myHeader");
		var sticky = header.offsetTop;

		function stick() {
			if (window.pageYOffset > sticky) {
				header.classList.add("sticky");
			} else {
				header.classList.remove("sticky");
			}
		}
	</script>



    <!header>
    <header>
      <h1 style="background-color:DodgerBlue;"><strong><font color="red">General Discussion</font></strong></h1>
      <div class="threadcontainer" id="threadcontainer">
        <?php displayThreads();?>
      </div>
    </header>



    <!Redundtant?>
    <style>
        div {
            height: 10px;
            text-align: center;
        }
    </style>

    <div>
        <button type="button" onclick="changeBackgroundDefault();">Default</button>
        <button type="button" onclick="changeBackgroundDark();">Dark</button>
        <button type="button" onclick="changeBackgroundWhite();">Light</button>
        <button type="button" onclick="changeBackgroundPepe();">Pepe</button>
    </div>
</body>
</html>
