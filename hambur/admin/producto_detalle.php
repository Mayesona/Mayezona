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

        $IdProducto = $_REQUEST["IDPRODUCTO"];
        if ($_REQUEST["IDPRODUCTO"] != "0")
        {

            $sql="select * from productos where pro_id=". $_REQUEST["IDPRODUCTO"];
            $resultado=mysqli_query($link,$sql);
            while($result=mysqli_fetch_array($resultado))
            {
                $pronombre = $result['pro_codigo'];
                $prodescripcion = $result['pro_descripcion'];
                $proprecio= $result['pro_precio'];
                $proimagen = $result['pro_imagen'];
                $proactiva = $result['pro_activa'];

            }

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

    <script lang="javascript" type="text/javascript">
        function actualizar()
        {
          //document.getElementsByName("img").src="../img/" + document.getElementsByName("txtimagen").file ; 
        }
    </script>

</head>
<style>
    .header{
        background-color: #17181b;
    }
    h2{
color:white;      
font-size: 6.0rem;
    }  
        
    
    body{
                background-color: #1d2124;
                

            }
    div{
        text-align:center;
        font-size: 3.0rem;
    }
    div.card{
        background-color:  #17181b;
        

    }
    .btn.btn-success{
        font-size: 2.0rem;
    }
    .btn.btn-secondary{
        font-size: 2.0rem;
    }
    .form-control{
        font-size: 1.6rem;
        padding: 1px 5px;
        
    }
    * {
	    padding: 0;
	    margin: 0;
	    font-family: century gothic;
	    text-align: center;
        }
   
    </style>
<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="four columns">
                    <!-- Titulo de la página con logo y un h1-->
                    <h1><img src="../img/logo.png" alt="">Mayezona - Productos  </h1>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
            <div class="row">
                <h2>Edición de producto</h2>
            </div>
    </div>

    <?php   
     if ($_REQUEST["IDPRODUCTO"] != "0")
     {

    ?>


    <form action="productos.php" method="POST">
        <div class="two columns">
            <div class="col-8">
                <div class="card">
                    <!-- Llamamos a traves de la variable IMG a las imagenes para las hamburguesas -->
                    <img name="img" id="img" src="../img/<?php echo $proimagen; ?>" width="400">
                    <div class="info-card">
                         <div class="form-group">
                            <label>Imagen</label>
                            <input type="hidden" name="htxtimagen" value="<?php echo $proimagen; ?>">
                            <input type="file" id="txtimagen" name="txtimagen" class="form-control" file="<?php echo $proimagen; ?>"> <p><?php echo $proimagen; ?>"</p>
                        </div>


                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="txtNombre" class="form-control"value="<?php echo $pronombre; ?>">
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text" name="txtDescripcion" class="form-control" value="<?php echo $prodescripcion; ?>">
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="text" name="txtprecio" class="form-control" value="<?php echo $proprecio; ?>"> 
                        </div>
                        <div class="form-group">
                            <label>Activo</label>
                            <input type="checkbox" id="chkestado" name="chkestado" <?php if ($proactiva== '1' ) {echo 'checked';} ?>>
                        </div>
                       

 
                           


                     
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="IDPRODUCTO" value="<?php echo $IdProducto; ?>">
                    <button class="btn btn-success" type="submit" value="1">Guardar</button>
                    <button class="btn btn-secondary" type="cancel" value="0">Volver</button>
                </div>
            </div>
            
        </div>
    </form>

    <?php
    }
    else
    {    
        ?>
    <form action="productos.php" method="POST">
        <div class="two columns">
            <div class="col-8">
                <div class="card">
                    <!-- Llamamos a traves de la variable IMG a las imagenes para las hamburguesas -->
                    <!--
                    <img src="../img/icono1.png" width="400">
                    -->
                    <div class="info-card">
                         <div class="form-group">
                            <label>Imagen</label>
                            <input type="hidden" name="htxtimagen" value="">
                            <input type="file" name="txtimagen" class="form-control" onchange="actualizar()"> 
                        </div>


                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="txtNombre" class="form-control"value="">
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text" name="txtDescripcion" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="text" name="txtprecio" class="form-control" value=""> 
                        </div>
                       
                        <div class="form-group">
                            <label>Activo</label>
                            <input type="checkbox" id="chkestado" name="chkestado">
                        </div>
                       
                     
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="IDPRODUCTO" value="<?php echo $IdProducto; ?>">
                    <button class="btn btn-success" type="submit" value="1">Guardar</button>
                    <button class="btn btn-secondary" type="cancel" value="0">Volver</button>
                </div>
            </div>
            
        </div>
    </form>

    <?php
    }
      
        ?>

</body>
</html>
