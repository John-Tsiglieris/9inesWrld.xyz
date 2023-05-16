<?php
  require 'config.php';
  require 'php\functions.php';
  require 'php\html.php';

  if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query(Database::$conn, "SELECT * FROM users WHERE ID = $id");            // ==== seems like redundant code, might want to include this block in config instead ====
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
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Homepage</title>
  <meta name="Homepage" content="Homepage">
  <link rel="stylesheet" href="styles.css">
  <script src="js/scripts.js"></script>
</head>




<body id="background" style="background: #333333 url('images/thing.png');">
  <!Heading>
  <?php
  if(!empty($_SESSION["id"])){
    createHeadingUser($row["username"]);
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



    <!main header>
    <header>
      <h1 style="background-color:DodgerBlue;"><strong><font color="red">9inesWrld <?php echo date("Y-m-d h:i:sa"); ?></font></strong></h1>

      <style>
          em {
              color: mediumvioletred;
              font-style: italic
          }
      </style>
      <section class="floatleft">
        <div>
          <h3>Second blog is out!</h3>
        </div>
        <div class="left">
          <p>Click <a href="blogs/2.html">here</a> to read about the latest development news!</p>
        </div>
      </section>
      <div>
        <a href="general.php">
          <img src="images/General.png" />
          <p>General Discussion</p>
        </a>
        <button id="popup-button" onclick="postThreadPopup()">Post thread</button>
      </div>
      <?php
      userprofilePopupContainer();
      threadPopupContainer();
      registerPopupContainer();
      loginPopupContainer();
      ?>
    </header>


    <div>
        <button type="button" onclick="changeBackgroundDefault();">Default</button>
        <button type="button" onclick="changeBackgroundDark();">Dark</button>
        <button type="button" onclick="changeBackgroundWhite();">Light</button>
        <button type="button" onclick="changeBackgroundPepe();">Pepe</button>
    </div>
</body>
</html>
