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
   <title>category</title>

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/estilos.css">
   

</head>
<body style="position: relative; min-height: 100vh">
   

<?php include 'components/usuario_header.php'; ?>





<section class="categories">

   <h1 class="heading">Materias</h1>

   <div class="box-container">
      <div class="box"><span>01</span><a href="categoria.php?category=Matemática">Matemática</a></div>
      <div class="box"><span>02</span><a href="categoria.php?category=Estadística">Estadística</a></div>
      <div class="box"><span>03</span><a href="categoria.php?category=Cálculo Aplicado a La Físicas">Cálculo Aplicado a La Física</a></div>
      <div class="box"><span>04</span><a href="categoria.php?category=Introducción a La Vida Universitaría">Introducción a La Vida Universitaría</a></div>
      <div class="box"><span>05</span><a href="categoria.php?category=Taller De Programación Web">Taller De Programación Web</a></div>
      <div class="box"><span>06</span><a href="categoria.php?category=Base De Datos">Base De Datos</a></div>
      <div class="box"><span>07</span><a href="categoria.php?category=Procesos Para Igeniería">Procesos Para Igeniería</a></div>
      <div class="box"><span>08</span><a href="categoria.php?category=Teoría General De Sistemas">Teoría General De Sistemas</a></div>
      <div class="box"><span>09</span><a href="categoria.php?category=Sistemas Operativos">Sistemas Operativos</a></div>
      <div class="box"><span>10</span><a href="categoria.php?category=Arquitectura De Computadoras">Arquitectura De Computadoras</a></div>
      <div class="box"><span>11</span><a href="categoria.php?category=Algoritmos y Estructuras De Datos">Algoritmos y Estructuras De Datos</a></div>
      <div class="box"><span>12</span><a href="categoria.php?category=Redes y Comunicación De Datos">Redes y Comunicación De Datos</a></div>
      <div class="box"><span>13</span><a href="categoria.php?category=Ética Profesional">Ética Profesional</a></div>
      <div class="box"><span>14</span><a href="categoria.php?category=Gestion De Proyectos">Gestion De Proyectos</a></div>
      <div class="box"><span>15</span><a href="categoria.php?category=Dibujo Para Ingeniería">Dibujo Para Ingeniería</a></div>
      <div class="box"><span>16</span><a href="categoria.php?category=Herramientas Informáticas Para La Toma De Decisiones">Herramientas Informáticas Para La Toma De Decisiones</a></div>
      <div class="box"><span>17</span><a href="categoria.php?category=Principios De Algoritmos">Principios De Algoritmos</a></div>
      <div class="box"><span>18</span><a href="categoria.php?category=Ingles">Ingles</a></div>
      <div class="box"><span>19</span><a href="categoria.php?category=Química">Química</a></div>
      <div class="box"><span>20</span><a href="categoria.php?category=Individuo y Medio Ambiente">Individuo y Medio Ambiente</a></div>
      <div class="box"><span>21</span><a href="categoria.php?category=Programación Orientada a Objetos">Programación Orientada a Objetos</a></div>
   </div>

</section>










<?php include 'components/footer.php'; ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>