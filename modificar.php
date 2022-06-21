<?php
// 1) Conexion
// a) realizar la conexion con la bbdd
// b) seleccionar la base de datos a usar
$conexion=mysqli_connect("127.0.0.1","root","");
 mysqli_select_db($conexion,"tienda");
// 2) Almacenamos los datos del envío GET
// a) generar variables para el id a utilizar
$id = $_GET['id'];
// 3) Preparar la SQL
// => Selecciona todos los campos de la tabla alumno donde el campo id  sea igual a $id
// a) generar la consulta a realizar
$consulta = "SELECT * FROM ropa WHERE id=$id";
// 4) Ejecutar la orden y almacenamos en una variable el resultado
// a) ejecutar la consulta
$repuesta=mysqli_query ($conexion, $consulta);
// 5) Transformamos el registro obtenido a un array
$datos=mysqli_fetch_array($repuesta);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="estilo2.css">
        <title>Proyecto Final Backend</title>
    </head>
    <body>
      <header>

        <?php
        // 6) asignamos a diferentes variables los respectivos valores del array $datos.
        $tipo_prenda=$datos["tipo_de_prenda"];
        $marca=$datos["marca"];
        $talle=$datos["talle"];
        $precio=$datos["precio"];
        $link=$datos["link_pago"];
        $imagen=$datos['imagen'];?>
        <h1>Invictus Sport</h1>
        <br>
        <h4>¡ATENCIÓN! Ingrese todos los datos de la prenda que desea modificar y la imagen</h4>
        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Tipo de prenda</label>
            <input type="text" name="tipo_de_prenda" placeholder="Tipo de Prenda" value="<?php echo "$tipo_prenda"; ?>" required>
            <br><br>
            <label>Marca</label>
            <input type="text" name="marca" placeholder="Marca" value="<?php echo "$marca"; ?>" required>
            <br><br>
            <label>Talle</label>
            <input type="text" name="talle" placeholder="Talle" value="<?php echo "$talle"; ?>" required>
            <br><br>
            <label>Precio</label>
            <input type="text" name="precio" placeholder="Precio" value="<?php echo "$precio"; ?>" required>
            <br><br>
            <label>Link de pago</label>
            <input type="text" name="link_pago" placeholder="Link" value="<?php echo "$link"; ?>" required>
            <br><br>
            <label>Imagen</label>
            <input type="file" name="imagen" placeholder="imagen" required>
            <br><br>
            <input type="submit" name="guardar_cambios" value="Guardar Cambios">
            <br><br>
            <button type="submit" class= "btn btn-dark" name="Cancelar" formaction="tabla.php">Cancelar</button>
        </form>
        <?php
        // Si en la variable constante $_POST existe un indice llamado 'guardar_cambios' ocurre el bloque de instrucciones.
        if(array_key_exists('guardar_cambios',$_POST)){
            // 2') Almacenamos los datos actualizados del envío POST
            // a) generar variables para cada dato a almacenar en la bbdd
            // Si se desea almacenar una imagen en la base de datos usar lo siguiente:
            // addslashes(file_get_contents($_FILES['ID NOMBRE DE LA IMAGEN EN EL FORMULARIO']['tmp_name']))
            $tipo_prenda=$_POST['tipo_de_prenda'];
            $marca=$_POST['marca'];
            $talle=$_POST['talle'];
            $precio=$_POST['precio'];
            $link=$_POST['link_pago'];
            $imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
            // 3') Preparar la orden SQL
            // "UPDATE tabla SET campo1='valor1', campo2='valor2', campo3='valor3', campo3='valor3', campo3='valor3' WHERE campo_clave=valor_clave"
            // a) generar la consulta a realizar
             $consulta = "UPDATE ropa SET tipo_de_prenda='$tipo_prenda', marca='$marca', talle='$talle', precio='$precio', link_pago='$link', imagen='$imagen' WHERE id=$id";
            // 4') Ejecutar la orden y actualizamos los datos
            // a) ejecutar la consulta
            mysqli_query($conexion,$consulta);
            // a) rederigir a index
            header('location: tabla.php');
          } ?>
        </header>

    </body>
</html>
