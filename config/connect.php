<?php

  $user = 'root';
  $pass = '';
  $db_name = 'todo';

  try {
      $pdo = new PDO('mysql:host=localhost;dbname='.$db_name, $user, $pass);
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }
?>
