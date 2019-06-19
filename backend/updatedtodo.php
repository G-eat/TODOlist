<?php
  include '../config/connect.php';

  $name = $_POST['name'];
  $description = $_POST['description'];
  $priority = $_POST['priority'];
  $date = $_POST['date'];
  $id = $_POST['id'];


  $mysql = "UPDATE `list` SET `name`=?,`descriptions`=?,`priority`=?,`deadline`=? WHERE id = ?";
  $query = $pdo->prepare($mysql);
  $query->execute([$name,$description,$priority,$date,$id]);

  header('Location: ../client/index.php?msg=updated');
?>
