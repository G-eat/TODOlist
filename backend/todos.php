<?php
  include '../config/connect.php';

  $name = $_POST['name'];
  $description = $_POST['description'];
  $priority = $_POST['priority'];
  $date = $_POST['date'];

  $mysql = "INSERT INTO `list`(`name`, `descriptions`, `priority`, `deadline`) VALUES (?,?,?,?)";
  $query = $pdo->prepare($mysql);
  $query->execute([$name,$description,$priority,$date]);

  header('Location: ../client/index.php?msg=created');
?>
