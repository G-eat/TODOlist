<?php
  include '../config/connect.php';

  $id = $_POST['id'];
  $checked = $_POST['checked'];


  $mysql = "UPDATE `list` SET `done`=? WHERE id = ?";
  $query = $pdo->prepare($mysql);
  $query->execute([$checked,$id]);
  
?>
