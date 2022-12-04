<?php

include '../components/conectar.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_iniciar.php');
}

if(isset($_POST['delete_comment'])){

   $comment_id = $_POST['comment_id'];
   $comment_id = filter_var($comment_id, FILTER_SANITIZE_STRING);
   $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
   $delete_comment->execute([$comment_id]);
   $message[] = '¡comentario borrado!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cuentas de estudiantes</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/estilo_admin.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="comments">

   <h1 class="heading">comentarios</h1>
   
   <p class="comment-title">comentarios a profes</p>
   <div class="box-container">
   <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id = ?");
         $select_comments->execute([$admin_id]);
         if($select_comments->rowCount() > 0){
            while($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)){
      ?>
      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
         $select_posts->execute([$fetch_comments['post_id']]);
         while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="post-title"> profe: <span><?= $fetch_posts['title']; ?></span> <a href="leer_post.php?post_id=<?= $fetch_posts['id']; ?>" >ver profe</a></div>
      <?php
         }
      ?>
   <div class="box">
      <div class="user">
         <i class="fas fa-user"></i>
         <div class="user-info">
            <span><?= $fetch_comments['user_name']; ?></span>
            <div><?= $fetch_comments['date']; ?></div>
         </div>
      </div>
      <div class="text"><?= $fetch_comments['comment']; ?></div>
      <form action="" method="POST">
         <input type="hidden" name="comment_id" value="<?= $fetch_comments['id']; ?>">
         <button type="submit" class="inline-delete-btn" name="delete_comment" onclick="return confirm('¿Quieres borrar este comentario?');">borrar comentario</button>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">¡no hay comentarios!</p>';
      }
   ?>
   </div>

</section>


















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>