<?php

include 'components/conectar.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Página De Inicio</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/estilos.css">
</head>
<body style="position: relative; min-height: 100vh"> 
   
<?php include 'components/usuario_header.php'; ?>

<section class="home-grid">

   <div class="box-container">

      <div class="box">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
               $count_user_comments->execute([$user_id]);
               $total_user_comments = $count_user_comments->rowCount();
               $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
               $count_user_likes->execute([$user_id]);
               $total_user_likes = $count_user_likes->rowCount();
         ?>
         <p> bienvenido <span><?= $fetch_profile['name']; ?></span></p>
         <p>comentarios: <span><?= $total_user_comments; ?></span></p>
         <p>likes: <span><?= $total_user_likes; ?></span></p>
         <a href="actualizar.php" class="btn">actualizar perfil</a>
         <div class="flex-btn">
            <a href="usuario_likes.php" class="option-btn">likes</a>
            <a href="usuario_comentarios.php" class="option-btn">comentarios</a>
         </div>
         <?php
            }else{
         ?>
            <p class="name">¡Inicia Sesión O Registrate!</p>
            <div class="flex-btn">
               <a href="inciciar.php" class="option-btn">Iniciar</a>
               <a href="registrar.php" class="option-btn">Registrarse</a>
            </div> 
         <?php
          }
         ?>
      </div>

      <div class="box">
         <p>Cursos</p>
         <div class="flex-box">
            <a href="categoria.php?category=nature" class="links">Matemática</a>
            <a href="categoria.php?category=business" class="links">Ingles</a>
            <a href="categoria.php?category=education" class="links">Estadística</a>
            <a href="categoria.php?category=news" class="links">Química</a>
            <a href="categoria.php?category=gaming" class="links">Bases De Datos</a>
            <a href="categoria.php?category=sports" class="links">Ética Profesional</a>
            <a href="todas_categorias.php" class="btn">ver a todos los profes</a>
         </div>
      </div>

      <div class="box">
         <p>ADMINISTRADORES</p>
         <div class="flex-box">
         <?php
            $select_authors = $conn->prepare("SELECT DISTINCT name FROM `admin` LIMIT 10");
            $select_authors->execute();
            if($select_authors->rowCount() > 0){
               while($fetch_authors = $select_authors->fetch(PDO::FETCH_ASSOC)){ 
         ?>
            <a href="admin_posts.php?author=<?= $fetch_authors['name']; ?>" class="links"><?= $fetch_authors['name']; ?></a>
            <?php
            }
         }else{
            echo '<p class="empty">todavia no se agregarón profes</p>';
         }
         ?>  
         <a href="admins.php" class="btn">ver todos los admins</a>
         </div>
      </div>

   </div>

</section>

<section class="posts-container">

   <h1 class="heading">PROFESORES</h1>

   <div class="box-container">

      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ? LIMIT 6 ");
         $select_posts->execute(['active']);
         if($select_posts->rowCount() > 0){
            while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
               
               $post_id = $fetch_posts['id'];

               $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
               $count_post_comments->execute([$post_id]);
               $total_post_comments = $count_post_comments->rowCount(); 

               $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
               $count_post_likes->execute([$post_id]);
               $total_post_likes = $count_post_likes->rowCount();

               $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
               $confirm_likes->execute([$user_id, $post_id]);
      ?>
      <form class="box" method="post">
         <input type="hidden" name="post_id" value="<?= $post_id; ?>">
         <input type="hidden" name="admin_id" value="<?= $fetch_posts['admin_id']; ?>">
         <div class="post-admin">
            <i class="fas fa-user"></i>
            <div>
               <a href="admin_posts.php?author=<?= $fetch_posts['name']; ?>"><?= $fetch_posts['name']; ?></a>
               <div><?= $fetch_posts['date']; ?></div>
            </div>
         </div>
         
         <?php
            if($fetch_posts['image'] != ''){  
         ?>
         <img src="uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image" alt="">
         <?php
         }
         ?>
         <div class="post-title"><?= $fetch_posts['title']; ?></div>
         <div class="post-content content-150"><?= $fetch_posts['content']; ?></div>
         <a href="ver_post.php?post_id=<?= $post_id; ?>" class="inline-btn">¡saber más!</a>
         <a href="categoria.php?category=<?= $fetch_posts['category']; ?>" class="post-cat"> <i class="fas fa-tag"></i> <span><?= $fetch_posts['category']; ?></span></a>
         <div class="icons">
            <a href="ver_post.php?post_id=<?= $post_id; ?>"><i class="fas fa-comment"></i><span>(<?= $total_post_comments; ?>)</span></a>
            <button type="submit" name="like_post"><i class="fas fa-heart" style="<?php if($confirm_likes->rowCount() > 0){ echo 'color:var(--red);'; } ?>  "></i><span>(<?= $total_post_likes; ?>)</span></button>
         </div>
      
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">prof no agregado</p>';
      }
      ?>
   </div>

   <div class="more-btn" style="text-align: center; margin-top:1rem;">
      <a href="posts.php" class="inline-btn">¡VER TODOS LOS PROFESORES!</a>
   </div>

</section>



















<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>