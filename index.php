<?php 
include("conexion.php");


$sql_leer = 'SELECT * FROM `usuarios` ORDER BY `edad`  DESC';
$gsent = $pdo->prepare($sql_leer);
$gsent ->execute();
$resultado = $gsent->fetchall();



if ($_POST){
	$nombre = $_POST['nombre'];
	$edad = $_POST['edad'];
  $cedula = $_POST['cedula'];

	$sql_agregar = 'INSERT INTO usuarios (nombre,edad,cedula) VALUES (?,?,?)';
	$sentencia_agregar = $pdo->prepare($sql_agregar);
	$sentencia_agregar->execute(array($nombre,$edad,$cedula));

	header('location:index.php');
}
if ($_GET) {
	$id = $_GET['id'];
	$sql_unico = 'SELECT * FROM `usuarios` WHERE id=?';
    $gsent_unico = $pdo->prepare($sql_unico);
    $gsent_unico ->execute(array($id));
    $resultado_unico = $gsent_unico->fetch();

    
}

    
?>

<!doctype html>
<html lang="es">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/all.css" integrity="sha512-ajhUYg8JAATDFejqbeN7KbF2zyPbbqz04dgOLyGcYEk/MJD3V+HJhJLKvJ2VVlqrr4PwHeGTTWxbI+8teA7snw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles.css">
     <title>Test</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="#">Test</a>
    
   <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">usuarios <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mascotasIndex.php">mascotas</a>
      </li>
  </div>
</nav>    
  
  <div class="container mt-5">
    <div class="row">

      <div class="col-md-6">
        <h2>Lista de Usuario</h2>

      <?php foreach($resultado as $dato): ?>

        <div 
          class="alert alert-info text-uppercase" 
          role="alert" >
          <?php echo $dato['nombre'] ?>
          -
          <?php echo $dato['cedula'] ?>
          -
          <?php echo $dato['edad'] ?>
          -
          <?php if ($dato['cedula']%2==0) {
            echo "cédula es par";
          }else{
            echo "cédula es impar";
          } ?>


          <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="float-right ml-3">
          <i class="far fa-trash-alt" style="color:red"></i>
          </a>
        </div>

      <?php endforeach ?>

      </div>

      <div class="col-md-6">
        <?php if(!$_GET):?>
        <h2>Agregar Usuario</h2>
        <form method="POST">
          <label for="nombre">nombre:</label>
          <input placeholder="nombre" id="nombre" type="text" class="form-control mt-3"
          name="nombre" required>
          <label for="cedula">cédula:</label>
          <input placeholder="cédula"type="text" class="form-control mt-3"
          name="cedula" required>
          <label for="edad">edad:</label>
          <input placeholder="edad"type="number" class="form-control mt-3"
          name="edad" required>

          <button type="submit" class="btn btn-primary mt-3">registrar</button>

          </form>

          <?php endif ?>


      </div>

    </div>

  </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>