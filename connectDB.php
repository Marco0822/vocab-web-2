<?php

$conn = new mysqli("localhost", "root", "", "vocabapp"); //Connect to DB
  if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }

?>