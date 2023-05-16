<?php
  require 'config.php';
  require 'php\functions.php';
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Chatlog</title>
  <meta name="Homepage" content="Homepage">
  <link rel="stylesheet" href="styles.css?v=1.0">
</head>

<body id="background">
  <style>
      header {
          width: 1500px;
          height: 10px;
      }
  </style>
  <p>Back to homepage: <a href="./index.php">Click here</a></p>

	<form action ="./chatlog.php" method="post">
		<input name ="input" type="text" required placeholder="Input Text Here">
    <input type="submit" value="Submit">
  </form>

	<?php
    displayChatlog("textinputs1");
    insertToChatlog("textinputs1");
    ?>

</body>
</html>
