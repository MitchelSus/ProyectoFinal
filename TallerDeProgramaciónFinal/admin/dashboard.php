<?php

include '../components/conectar.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_iniciar.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panel De Control</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/estilo_admin.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">Panel De Control</h1>

   <div class="box-container">

   <div class="box">
      <h3>¡Bienvenido!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="actualizar_perfil.php" class="btn">Actualizar Perfil</a>
   </div>

   <div class="box">
      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
         $select_posts->execute([$admin_id]);
         $numbers_of_posts = $select_posts->rowCount();
      ?>
      <h3><?= $numbers_of_posts; ?></h3>
      <p>Profes Agregados</p>
      <a href="agregar_profe.php" class="btn">Agregar Profe</a>
   </div>

   <div class="box">
      <?php
         $select_active_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
         $select_active_posts->execute([$admin_id, 'active']);
         $numbers_of_active_posts = $select_active_posts->rowCount();
      ?>
      <h3><?= $numbers_of_active_posts; ?></h3>
      <p>Profes Activos</p>
      <a href="ver_posts.php" class="btn">Ver Profes</a>
   </div>

   <div class="box">
      <?php
         $select_deactive_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
         $select_deactive_posts->execute([$admin_id, 'deactive']);
         $numbers_of_deactive_posts = $select_deactive_posts->rowCount();
      ?>
      <h3><?= $numbers_of_deactive_posts; ?></h3>
      <p>Profes Ocultos</p>
      <a href="ver_posts.php" class="btn">Ver Profes</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p>Cuentas De Estudiantes</p>
      <a href="cuentas_usuarios.php" class="btn">Ver Estudiantes</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>Cuentas De Admins</p>
      <a href="cuentas_admin.php" class="btn">Ver Admins</a>
   </div>
   
   <div class="box">
      <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id = ?");
         $select_comments->execute([$admin_id]);
         $select_comments->execute();
         $numbers_of_comments = $select_comments->rowCount();
      ?>
      <h3><?= $numbers_of_comments; ?></h3>
      <p>Comentarios Agregados</p>
      <a href="comentarios.php" class="btn">Ver Comentarios</a>
   </div>

   <div class="box">
      <?php
         $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE admin_id = ?");
         $select_likes->execute([$admin_id]);
         $select_likes->execute();
         $numbers_of_likes = $select_likes->rowCount();
      ?>
      <h3><?= $numbers_of_likes; ?></h3>
      <p>Likes Totales</p>
      <a href="ver_posts.php" class="btn">Ver Profes</a>
   </div>

   </div>

</section>

<!-- admin dashboard section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>