<?php
  include '../config/connect.php';

  $positions = $_POST['positions'];
  $num = 1;

  foreach ($positions as $position) {
    $mysql = "UPDATE `list` SET `position`=? WHERE id = ?";
    $query = $pdo->prepare($mysql);
    $query->execute([$num,$position]);
    $num ++;
  }


  header('Location: ../client/index.php');
?>
