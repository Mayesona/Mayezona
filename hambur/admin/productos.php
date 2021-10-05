<?php   


    // verificar si el usuario esta logeado
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        exit;
    }
 


    // Incluir config file
    require_once "config.php";

    // Recuperar SUBMIT y validar
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $pro_imagen = $_REQUEST["txtimagen"];
        $pro_himagen = $_REQUEST["htxtimagen"];
        $pro_codigo = $_REQUEST["txtNombre"];
        $pro_descripcon = $_REQUEST["txtDescripcion"];
        $pro_precio = $_REQUEST["txtprecio"];
        
        //validacion de usuario
        if (isset($_REQUEST["chkestado"]) == true)
        {
            $pro_estado = $_REQUEST["chkestado"]; 
        } else
        {
            $pro_estado = false;
        }
        
        if ($_REQUEST["IDPRODUCTO"] == "0")
        {

            $sql="insert into  productos (pro_codigo, pro_descripcion,pro_imagen,pro_precio, pro_activa) values ('". $pro_codigo."','". $pro_descripcon. "','" . $pro_imagen. "','" . $pro_precio ."','" . $pro_estado . "')" ;
            $resultado=mysqli_query($link,$sql);
        }
        if ($_REQUEST["IDPRODUCTO"] != "0")
        {

            if ($pro_imagen == null)
            {   $pro_imagen = $pro_himagen;}
//guarda imagen por defecto si no se ingresa
            $sql="update productos set pro_codigo='". $pro_codigo ."', pro_descripcion='". $pro_descripcon . "', pro_imagen='". $pro_imagen ."', pro_precio='". $pro_precio ."', pro_activa='". $pro_estado ."'  where pro_id=". $_REQUEST["IDPRODUCTO"];
            $resultado=mysqli_query($link,$sql);
        }
        

    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Etiqueta -->
    <meta name="description" content="Aquí en Mayezona - Chivilcoy experimentarás una deliciosa cocina Burger.
    ¡Pruebe nuestros deliciosos platillos, cuidadosamente preparados con ingredientes frescos! 
    En Mayezona, nuestra receta para el éxito es simple: Calidad y sabor hace que los clientes cada vez regresen.">
    <meta charset="UTF-8">
    <!-- Nombre que aparecera en la ventana de la página-->
    <title>Mayezona</title>
    <!-- Usamos la función link para vincular a los .css para tener la edición visual -->
    <link rel="stylesheet" href="../css/Estilo1.css">
    <link rel="stylesheet" href="../css/Estilo2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <header class="header">
    <style>
            body{
                background-color: #17181b;
                

            }
 
           
         div.card{
            background-color: #1d2124;
            width:800px;
            text-align:center;
            margin-left: auto;
             margin-right:auto;
             
         }
         h2{
             color:white;
             font-size: 5.0rem;
             
         }
         .two.columns{
           text-align:center;
           
           
         }
         .btn.btn-primary{
             font-size: 2.0rem;

         }
        .btn.btn-secondary{
            font-size: 1.6rem;
            
         }
         form{
            text-align:center;
        
         }
         h4{
            font-size: 3.0rem;
         }
         

            </style>
        <div class="container">
            <div class="row">
                <div class="four columns">
                    <!-- Titulo de la página con logo y un h1-->
                    <h1><img src="../img/logo.png" alt="">Mayezona - Administración</h1>
                </div>
                

                <form action="salir.php" method="POST">
                <div class="form-group">
                    <button class="btn btn-secondary" type="submit" value="CERRAR">Cerrar</button>
                </div>
                </form>




            </div>
        </div>
    </header>
    <div class="container">
            <div class="row">
                <h2>Listado de productos</h2>
            </div>
          
    </div>
  
    <div class="container">
        <form action="producto_detalle.php" method="POST">
                <div class="form-group">
                    <input type="hidden" name="IDPRODUCTO" value="0">
                    <button class="btn btn-secondary" type="submit" value="AGREGAR">Agregar nuevo producto</button>
                </div>
                </form>
        </div>
            
        <?php
//busqueda de productos 
            $sql="select * from productos";
            $resultado=mysqli_query($link,$sql);

            while($result=mysqli_fetch_array($resultado))

            {
        ?>
              <form action="producto_detalle.php" method="POST">
      
                <div class="two columns">
                    <div class="col-8">
                        <div class="card">
                            <!-- Llamamos a traves de la variable IMG a las imagenes para las hamburguesas -->
                            <img src="../img/<?php echo $result['pro_imagen'] ?>" width="400">
                            <div class="info-card">
                                <!-- h4 para los nombres de las hamburgesas -->
                                <h4><?php echo $result['pro_codigo'] ?></h4>
                                <!-- Y la función p(parrafo) con un span dentro del mismo para las especificaciones de las hamburguesas -->
                                <p><?php echo $result['pro_descripcion'] ?><span class="u-pull-right">$<?php echo $result['pro_precio'] ?> </span></p>
                            </div>
                            <div>
                                <p> <input type="checkbox"  id="chkestado" name="chkestado"  <?php if ($result['pro_activa']=='1') {echo 'checked';} ?>  disabled  >  </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="IDPRODUCTO" value="<?php echo $result['pro_id'] ?>">
                            <button class="btn btn-primary" type="submit" value="EDIT">Editar</button>
                        </div>
                    </div>
                </div>
            
    </form>

        <?php
            }
        ?>



</body>
</html>