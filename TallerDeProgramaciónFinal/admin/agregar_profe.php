<?php

include '../components/conectar.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_iniciar.php');
}

if(isset($_POST['publish'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $status = 'active';
   
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
   $select_image->execute([$image, $admin_id]);

   if(isset($image)){
      if($select_image->rowCount() > 0 AND $image != ''){
         $message[] = '¡imagen con nombre repetido!';
      }elseif($image_size > 2000000){
         $message[] = '¡el tamaño de la imagen es muy pesado!';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   }else{
      $image = '';
   }

   if($select_image->rowCount() > 0 AND $image != ''){
      $message[] = '¡por favor renombra tu imagen!';
   }else{
      $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
      $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
      $message[] = '¡profe publicado!';
   }
   
}

if(isset($_POST['draft'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $status = 'deactive';
   
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
   $select_image->execute([$image, $admin_id]); 

   if(isset($image)){
      if($select_image->rowCount() > 0 AND $image != ''){
         $message[] = '¡imagen con nombre repetido!';
      }elseif($image_size > 2000000){
         $message[] = '¡el tamaño de la imagen es muy pesado!';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   }else{
      $image = '';
   }

   if($select_image->rowCount() > 0 AND $image != ''){
      $message[] = '¡por favor renombra tu imagen!';
   }else{
      $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
      $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
      $message[] = '¡borrador guardado!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>posts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/estilo_admin.css">

</head>
<body>


<?php include '../components/admin_header.php' ?>

<section class="post-editor">

   <h1 class="heading">agregar nuevo profe</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
      <p>nombre del profe <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="agrega nombre del profe" class="box">
      <p>descripción del profe <span>*</span></p>
      <textarea name="content" class="box" required maxlength="10000" placeholder="escribe una breve descripción..." cols="30" rows="10"></textarea>
      <p>curso del profe <span>*</span></p>
      <select name="category" class="box" required>
         <option value="Matemática">Matemática</option>
         <option value="Estadística">Estadística</option>
         <option value="Cálculo Aplicado a La Física">Cálculo Aplicado a La Física</option>
         <option value="Introducción a La Vida Universitaría">Introducción a La Vida Universitaría</option>
         <option value="Taller De Programación Web">Taller De Programación Web</option>
         <option value="Base De Datos">Base De Datos</option>
         <option value="Procesos Para Igeniería">Procesos Para Igeniería</option>
         <option value="Teoría General De Sistemas">Teoría General De Sistemas</option>
         <option value="Sistemas Operativos">Sistemas Operativos</option>
         <option value="Arquitectura De Computadoras">Arquitectura De Computadoras</option>
         <option value="Algoritmos y Estructuras De Datos">Algoritmos y Estructuras De Datos</option>
         <option value="Redes y Comunicación De Datos">Redes y Comunicación De Datos</option>
         <option value="Ética Profesional">Ética Profesional</option>
         <option value="Gestion De Proyectos">Gestion De Proyectos</option>
         <option value="Dibujo Para Ingeniería">Dibujo Para Ingeniería</option>
         <option value="Herramientas Informáticas Para La Toma De Decisiones">Herramientas Informáticas Para La Toma De Decisiones</option>
         <option value="Principios De Algoritmos">Principios De Algoritmos</option>
         <option value="Ingles">Ingles</option>
         <option value="Química">Química</option>
         <option value="Individuo y Medio Ambiente">Individuo y Medio Ambiente</option>
         <option value="Programación Orientada a Objetos">Programación Orientada a Objetos</option>
      </select>
      <p>imagen del profe</p>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="publicar profe" name="publish" class="btn">
         <input type="submit" value="guardar en borrador" name="draft" class="option-btn">
      </div>
   </form>

</section>







<script src="../js/admin_script.js"></script>

</body>
</html>