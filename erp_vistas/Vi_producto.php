<?php
include("funciones/db.php");

$productos = "SELECT p1.id_prod, p1.nombre_prod, p1.precio_prod, p1.des_prod, p1.fech_prod, p3.telefono, p2.nombre, p3.nombre_pro, p1.img_prod, p1.img_prod_2, p1.img_prod_3
FROM productos p1 INNER JOIN categoria p2 on p1.id_cat_prod = p2.id_cat_provedor INNER JOIN provedor p3 ON p1.id_provedor = p3.id_provedor";
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Catalogo de Productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Tables are the backbone of almost all web applications.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
    <link rel="stylesheet" href="producto.css">
</head>
<body>
    
        <div class="app-main">
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                                    </i>
                                </div>
                                <div>Galeria Productos
                                    <div class="page-title-subheading">Productos
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php $resultado = mysqli_query($conectar, $productos);



                    while ($row = mysqli_fetch_assoc($resultado)) { ?>
                        <div class="container">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="galleria">
                                                <div class="mini">
                                                    <div>
                                                        <?php echo "<img class='img_mini' src='" . $row['img_prod_2'] . "'>"; ?>
                                                    </div>
                                                    <div>
                                                        <?php echo "<img class='img_mini' src='" . $row['img_prod_3'] . "'>"; ?>
                                                    </div>
                                                </div>
                                                <div>
                                                    <?php echo "<img class='img_principal' src='" . $row['img_prod'] . "'>"; ?>
                                                </div>
                                                <div class="descripcion">

                                                    <h1>$<?php echo $row["precio_prod"] ?>MX</h1>
                                                    <h3><?php echo $row["nombre_prod"] ?></h3>
                                                    <h6>Descripción:</h6>
                                                    <p><?php echo $row["des_prod"] ?></p>
                                                    <h6>Proveedor:</h6>
                                                    <p><?php echo $row["nombre_pro"] ?></p>
                                                    <h6>Telefono del Proveedor:</h6>
                                                    <p><?php echo $row["telefono"] ?></p>
                                                    <h6>Categoria:</h6>
                                                    <p><?php echo $row["nombre"] ?></p>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php }
                    mysqli_free_result($resultado); ?>

                </div>
            </div>
        </div>
    
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>

</html>