<?php

require_once("../connectDB.php");

if (isset($_POST['isRegister'])) {

  $isRegister = $_POST['isRegister'];

  if ($isRegister == "true") {
    $username = $_POST['Username'];
    $email = $_POST['Email'];

  } else {
    $username = $_POST['UsernameOrEmail'];
  }

  $password = $_POST['Password'];
  $hashed_password = password_hash($password, PASSWORD_BCRYPT);


  //Check if Username is taken
  $sql = "SELECT * FROM Players WHERE Username=? OR Email=?"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bind_param("ss", $username, $username);
  $stmt->execute();
  $result = $stmt->get_result();  

  //If username is taken and user trying to register
  if ((mysqli_num_rows($result) !== 0) && ($isRegister == "true"))  { 
    exit("Username has already been taken");
  }

   //If username doesn't exist and user trying to login
   if ((mysqli_num_rows($result) == 0) && ($isRegister == "false")) { 
    exit("Username/Email doesn't exist!");
  } else if ($isRegister == "false"){
    //Check if Username is taken
    $sql = "SELECT * FROM Players WHERE (Username=? OR Email=?)"; 
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result(); 
    $hash = "";

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $hash = $row["Password"];
      }

      if (password_verify($password, $hash)) {
        session_start();
        $_SESSION['UsernameOrEmail'] = $username;
        echo ($_SESSION['UsernameOrEmail']);
        exit("FGot to home.php");
      }
      else {
        exit("invalid pasdword");
      }

    } else {
      echo "0 results";
    }

  }

  //Check if email is taken
  $sql = "SELECT * FROM Players WHERE Email=?"; 
  $stmt = $conn->prepare($sql); 
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();  

  if ((mysqli_num_rows($result) !== 0) && ($isRegister == "true")) { 
    exit("Email has already been taken");
  } 

  if ($isRegister == "true") {
    if (!($stmt = $conn->prepare("INSERT INTO Players(Username, Email, Password) VALUES (?, ?, ?)"))) {
      exit("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    if (!$stmt->bind_param("sss", $username, $email, $hashed_password)) {
        exit("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
    }
  
    if (!$stmt->execute()) {
        exit("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
  }

  exit($isRegister);
}
