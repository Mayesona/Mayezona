<?php   

    // Incluir config file
    require_once "admin/config.php";

?>

<!-- Abrimos la función HTML -->
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
    <link rel="stylesheet" href="css/Estilo1.css">
    <link rel="stylesheet" href="css/Estilo2.css">
    <link rel="stylesheet" href="css/whatsapp.css">

    <script lang="javascript">
        function loadAdmin() {
            window.location.assign("admin/index.php");
        }
    </script>


</head>

<body>
    <!-- Usamos esta función para declarar y mostrar el botón de WhatsApp-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=+542346456914&text=Bienvenido%20a%20Mayezona,%20consulta%20cualquier%20promo%20o%20duda!" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
   </a>

    <header class="header">
        
        <div class="container">
            
            <div class="row">
                
                <div class="four columns">
                    <!-- Titulo de la página con logo y un h1-->
                    <h1><img src="img/logo.png" alt="" onclick="loadAdmin()">Mayezona</h1>
                
                </div>
            </div>
        </div>
    
    </header>
    <!-- Iniciamos un h2 para el subtitulo y 3 h4 para la descripcion y style para modificar las mismas -->
                
    <div class="hero">
        <div class="container"> 
            <div class="row">  
                <div class="six columns">
                    <div class="contenido-hero">
                        <h2>Especialistas en hamburguesas</h2><br><br><br><br><br><br>
                        <h4 style="font-family: garamond; src: url('garamond-italic.ttf'); font-style: italic; font-size: x-large; color: blanchedalmond;">No te vas a arrepentir</h4>
                        <h4 style="font-family: garamond; src: url('garamond-italic.ttf'); font-style: italic; font-size: x-large; color: blanchedalmond;">Tenemos la más amplia variedad de hamburguesas</h4>
                        <h4 style="font-family: garamond; src: url('garamond-italic.ttf'); font-style: italic; font-size: x-large; color: blanchedalmond;">Pedi la que más te guste via online o llamanos, despachamos rápido</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="barra">

        <div class="container">
            
            <div class="row">

                <!-- Usamos nuevamente b para los datos del restaurante, acompañado del style para editar el color
                llamando también a los iconos -->
                <div class="four columns icono icono1">
                    <b style="color: white;">Teléfono:<br>
                   2346456914</b>
                </div>
            
                <div class="four columns icono icono2">
                    <b style="color: white;">Ubicación: <br> 
                        Hipólito Irigoyen-Plaza Principal</b>
                </div>
                <div class="four columns icono icono3">
                    <b style="color: white;">Chivilcoy<br>
                    Buenos Aires</b>
                
                </div>
            </div>
        </div>
    </div>



    <div class="lista-platillos" class="container">
        <!-- Usamos h1 para el Menú -->
        <h1 class="encabezado">Menú</h1>


        <?php

            $countregistros = 0;
            $sql="select * from productos where pro_activa = 1";
            $resultado=mysqli_query($link,$sql);
            
            while($result=mysqli_fetch_array($resultado))

            {
        ?>
            <?php 
                if ($countregistros == 0) 
                {   echo "<div class='row'>"; 
                                    }
                else
                {   
                    if ($countregistros==3) {$countregistros =0;}
                }
                $countregistros++;    
                    
                
                ?>
            
                <div class="four columns">
                    <div class="card">
                        <!-- Llamamos a traves de la variable IMG a las imagenes para las hamburguesas -->
                        <img src="img/<?php echo $result['pro_imagen'] ?>" class="imagen-platillo u-full-width">
                        <div class="info-card">
                            <!-- h4 para los nombres de las hamburgesas -->
                            <h4><?php echo $result['pro_codigo'] ?></h4>
                            <!-- Y la función p(parrafo) con un span dentro del mismo para las especificaciones de las hamburguesas -->
                            <p><?php echo $result['pro_descripcion'] ?><span class="u-pull-right">$<?php echo $result['pro_precio'] ?> </span></p>
                        
                        </div>
                    </div>
                </div>
                
           
        <?php
            if ($countregistros == 3) {  echo "</div>"; 
            $countregistros=0;} 
            }
        ?>

      
        
    </div>
    


    
</body>
</html>