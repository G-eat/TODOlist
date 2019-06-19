<?php
 include_once('../config/connect.php');

  $id = $_POST['id'];
  $mysql = "SELECT * FROM list WHERE id = ?";
  $queries = $pdo->prepare($mysql);
  $queries->execute([$id]);

  $data = $queries->fetch();
  echo json_encode($data);

 ?>
