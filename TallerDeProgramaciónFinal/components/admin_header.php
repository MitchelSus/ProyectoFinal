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

   <a href="dashboard.php" class="logo">Panel <span>Administrador</span></a>

   <div class="profile">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="actualizar_perfil.php" class="btn">Actualizar Perfil</a>
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i> <span>Inicio</span></a>
      <a href="agregar_profe.php"><i class="fas fa-pen"></i> <span>Agregar Profe</span></a>
      <a href="ver_posts.php"><i class="fas fa-eye"></i> <span>Ver Profes</span></a>
      <a href="cuentas_admin.php"><i class="fas fa-user"></i> <span>Cuentas</span></a>
      <a href="../components/admin_cerrar.php" style="color:var(--red);" onclick="return confirm('¿Quieres cerrar sesión de ProfeReview?');"><i class="fas fa-right-from-bracket"></i><span>Cerrar Sesión</span></a>
   </nav>

   <div class="flex-btn">
      <a href="admin_iniciar.php" class="option-btn">Iniciar</a>
      <a href="registrar_admin.php" class="option-btn">Registrarse</a>
   </div>

</header>

<div id="menu-btn" class="fas fa-bars"></div>