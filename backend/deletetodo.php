<?php
  include '../config/connect.php';

  $id = $_POST['id'];
  // echo $id;

  $mysql = "DELETE FROM `list` WHERE id =?";
  $query = $pdo->prepare($mysql);
  $query->execute([$id]);

  header('Location: ../client/index.php?msg=deleted');
?>
