<?php
  require_once('\wamp64\www\config.php');

  if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query(Database::$conn, "SELECT * FROM users WHERE ID = $id");
    $row = mysqli_fetch_assoc($result);
  }

  //queries database, $postVar & $sqlCommand must be enclosed in quotes PRIOR to calling
  function query($postVar, $sqlCommand, ) {
    if(!empty($_POST[$postVar])) {
      $sql = $sqlCommand;
      $result = mysqli_query(Database::$conn, $sql);
      if ($result) {
        //echo "Insertion successful";
      } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else { // $_POST is empty
      //Do nothing
    }
  }

  //creates heading for unlogged users
  function createHeadingAnon() {
    echo '<div class="heading" id="myHeader">';
    echo '<button class="loginButton" id="loginButton" onclick="loginPopup()">Login</button>';
    echo '<button class="registerButton" id="registerButton" onclick="registerPopup()">Register</button>';
    echo '<p>Welcome, Anon</p>';
    echo '<p>Back to homepage: <a href="../index.php">Click here</a></p>';
    echo '';
    echo '<p class="link"><a href="./chatlog.php">View Chatlog</a></p>';
    echo '</div>';
  }


  //creates heading for logged users
  function createHeadingUser($username) {
      $thisusername = $username;
      echo '<div class="heading" id="myHeader">';
      echo '';
      echo '';
      echo '<p>Welcome, <a href="#" id="popup-link" onclick="userProfilePopup()">' . $thisusername . '</a></p>';
      echo '<p>Back to homepage: <a href="../index.php">Click here</a></p>';
      echo '<p><a href="logout.php">Logout</a></p>';
      echo '<p class="link"><a href="./chatlog.php">View Chatlog</a></p>';
      echo '</div>';
  }

  function displayChatlog($tablename) {
    ob_start();
    $sql = "SELECT * FROM $tablename";
    $result = mysqli_query(Database::$conn, $sql); // First parameter is just return of "mysqli_connect()" function
    echo "<br>";
    echo "<table border='3'>";
    while ($row = mysqli_fetch_assoc($result)) { // Important line !!! Check summary get row on array ..
      echo "<tr>";
      foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
        echo "<td>" . $value . "</td>"; // I just did not use "htmlspecialchars()" function.
      }
      echo "</tr>";
    }
    echo "</table>";
  }

  function insertToChatlog($tablename) {
    // INSERT INTO DATABASE
    if(!empty($_POST["input"])) {
      print_r($_POST["input"]);
      $text = $_POST["input"];
      $text1 = "'".$text."'";
      if(!empty($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $result = mysqli_query(Database::$conn, "SELECT * FROM users WHERE ID = $id");
        $row = mysqli_fetch_assoc($result);
        $id = "'".$row["username"]."'";
      } else {
        $id = 'anon';
        $id = "'".$id."'";
      }
      $sql = "INSERT INTO $tablename (username, text, date) VALUES ($id, $text1, CURRENT_TIMESTAMP())";
      $result = mysqli_query(Database::$conn, $sql);
      if ($result) {
        //echo "Insertion successful";
        //$_POST = array();
        header('Location: chatlog.php');
        ob_end_flush();
      } else { // $result is undefined/botched query
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
      //mysqli_close($conn);                                  //==== unsure when to close this... ====
      // clear array after posting to avoid delayed input
      $_POST = array();
  }

  // just used to test if calls work
  function debugTextInput() {
    echo "Test";
  }

  function displayThreads() {
    $sql = "SELECT * FROM threads";
    $result = mysqli_query(Database::$conn, $sql); // First parameter is just return of "mysqli_connect()" function
    while ($row = mysqli_fetch_assoc($result)) { // Check summary get row on array ..
      $id = $row["ID"];
      echo '<a href="#" class="thread-link" data-title="'.$row["title"].'" data-op="'.$row["op"].'" onclick="loadThread('.$id.')">'.$row["title"]." ".$row["op"].'</a>';
      echo '<br><br>';
    }
  }

  function displayThreadContents($id) {
    $sql = "SELECT * FROM threads where ID = $id";
    $result = mysqli_query(Database::$conn, $sql); // First parameter is just return of "mysqli_connect()" function
    while ($row = mysqli_fetch_assoc($result)) { // Check summary get row on array ..
      foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
        echo $value." "; // I just did not use "htmlspecialchars()" function.
      }
    }
    echo '<form action ="./chatlog.php" method="post">';
    echo '<input name ="input" type="text" required placeholder="Input Text Here">';
    echo '<input type="submit" value="Submit">';
    echo '</form>';
  }

  if (isset($_GET['function']) && $_GET['function'] == 'displayThreadContents') {
      $id = $_GET['id'];
      // call the displayThreadContents function passing the $id variable
      displayThreadContents($id);
      //displayChatlog($id);
  }
