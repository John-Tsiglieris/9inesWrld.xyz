<?php
require_once('\wamp64\www\config.php');

function userprofilePopupContainer() {
  if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query(Database::$conn, "SELECT * FROM users WHERE ID = $id");
    $row = mysqli_fetch_assoc($result);
  }
  echo'<div class="popup" id="userprofile-popup-container">';
    echo'<div class="popup" id="userprofile-popup-content">';
      echo'<h2>Your account</h2>';
      echo'<p>Welcome, '.(isset($row["username"]) ? $row["username"] : "Anon").'</p>';
      echo'<input name ="input" type="text" placeholder="Update your status…">';
      echo'<input type="submit" value="Submit">';
      echo'<button id="userprofile-close-button">Close</button>';
    echo'</div>';
  echo'</div>';
}

function threadPopupContainer() {
  echo'<div class="popup" id="thread-popup-container">';
    echo'<div class="popup" id="thread-popup-content">';
      echo'<h2>Post a thread</h2>';
        echo'<form action ="general.php" method="post">';
          echo'<input name ="title" type="text" placeholder="Thread Title">';
          echo'<textarea id="message" name="message" rows="4" cols="50" placeholder="Text..."></textarea>';
          echo'<input type="submit" value="Submit">';
        echo'</form>';
      echo'<button id="thread-close-button">Close</button>';
    echo'</div>';
  echo'</div>';
}

function registerPopupContainer() {
  echo'<div class="popup" id="register-popup-container">';
    echo'<div class="popup" id="register-popup-content">';
      echo'<h2>Register</h2>';
      echo'<form class="" action="" method="post" autocomplete="off">';
        echo'<label for="username">Username: </label>';
        echo'<input type="text" name="username" id = "username" required value=""><br>';
        echo'<label for="password">Password: </label>';
        echo'<input type="password" name="password" id = "password" required value=""><br>';
        echo'<label for="confirmpassword">Confirm Password : </label>';
        echo'<input type="password" name="confirmpassword" id = "confirmpassword" required value=""> <br>';
        echo'<button type="submit" name="submit">Register</button>';
      echo'</form>';
      echo'<br>';
      echo'<button id="register-close-button">Close</button>';
    echo'</div>';
  echo'</div>';
}

function loginPopupContainer() {
  echo'<div class="popup" id="login-popup-container">';
    echo'<div class="popup" id="login-popup-content">';
      echo'<h2>Login</h2>';
      echo'<form class="" action="#" method="post" autocomplete="off">';
        echo'<label for="username">Username: </label>';
        echo'<input type="text" name="username" id = "username" required value=""><br>';
        echo'<label for="password">Password: </label>';
        echo'<input type="password" name="password" id = "password" required value=""><br>';
        echo'<button type="submit" name="submit">Login</button>';
      echo'</form>';
      echo'<br>';
      echo'<button id="login-close-button">Close</button>';
      echo'</div>';
  echo'</div>';
}
