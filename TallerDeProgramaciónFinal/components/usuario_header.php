<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<header class="header">   
   <section class="flex">
      <!-- <a href="inicio.php"><div class="logo"><img src="img/OldTecaher.png" alt="aa" ></div></a> -->
      <strong><a href="inicio.php" class="logo">ProfeRewiew</a></strong>
      <form action="buscar.php" method="POST" class="search-form">
         <input type="text" name="search_box" class="box" maxlength="100" placeholder="buscar profesores" required>
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <nav class="navbar">
         <a href="inicio.php"> <i class="fas fa-angle-right"></i> Inicio</a>
         <a href="posts.php"> <i class="fas fa-angle-right"></i> Profes</a>
         <a href="todas_categorias.php"> <i class="fas fa-angle-right"></i> Cursos</a>
         <a href="admins.php"> <i class="fas fa-angle-right"></i> Admins</a>
         <a href="inciciar.php"> <i class="fas fa-angle-right"></i> Iniciar Sesión</a>
         <a href="registrar.php"> <i class="fas fa-angle-right"></i> Registrarse</a>
      </nav>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <a href="actualizar.php" class="btn">actualizar perfil</a>
         <div class="flex-btn">
            <a href="inciciar.php" class="option-btn">login</a>
            <a href="registrar.php" class="option-btn">register</a>
         </div> 
         <a href="components/usuario_cerrar.php" onclick="return confirm('¿Quieres cerrar sesión de ProfeReview?');" class="delete-btn">cerrar sesión</a>
         <?php
            }else{
         ?>
            <p class="name">¡Primero Inicia Sesión!</p>
            <a href="inciciar.php" class="option-btn">Iniciar Sesión</a>
         <?php
            }
         ?>
      </div>

   </section>

</header>