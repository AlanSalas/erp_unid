<?php
include("funciones/db.php");

isset($_GET['id']) ? $id_url = $_GET['id'] : $id_url = null ;


$empleados ="SELECT * FROM empleados_rh";

if($id_url){
$horarios ="SELECT h1.id, h1.name, h1.lastname, h2.positionName, 
h3.sundayFrom, h3.sundayTo, h3.sundaySecondTurnFrom, h3.sundaySecondTurnTo, h3.sundayThirdTurnFrom, h3.sundayThirdTurnTo,
h3.mondayFrom, h3.mondayTo, h3.mondaySecondTurnFrom, h3.mondaySecondTurnTo, h3.mondayThirdTurnFrom, h3.mondayThirdTurnTo,
h3.tuesdayFrom, h3.tuesdayTo, h3.tuesdaySecondTurnFrom, h3.tuesdaySecondTurnTo, h3.tuesdayThirdTurnFrom, h3.tuesdayThirdTurnTo,
h3.wednesdayFrom, h3.wednesdayTo, h3.wednesdaySecondTurnFrom, h3.wednesdaySecondTurnTo, h3.wednesdayThirdTurnFrom, h3.wednesdayThirdTurnTo,
h3.thursdayFrom, h3.thursdayTo, h3.thursdaySecondTurnFrom, h3.thursdaySecondTurnTo, h3.thursdayThirdTurnFrom, h3.thursdayThirdTurnTo,
h3.fridayFrom, h3.fridayTo, h3.fridaySecondTurnFrom, h3.fridaySecondTurnTo, h3.fridayThirdTurnFrom, h3.fridayThirdTurnTo,
h3.saturdayFrom, h3.saturdayTo, h3.saturdaySecondTurnFrom, h3.saturdaySecondTurnTo, h3.saturdayThirdTurnFrom, h3.saturdayThirdTurnTo
FROM empleados_rh h1 INNER JOIN puestos_empleados_rh h2 ON h1.position = h2.id INNER JOIN horarios_puestos_rh h3 ON h3.positionId = h2.id WHERE h1.id = '$id_url' ";
}
else{

$horarios ="SELECT h1.id, h1.name, h1.lastname, h2.positionName, 
h3.sundayFrom, h3.sundayTo, h3.sundaySecondTurnFrom, h3.sundaySecondTurnTo, h3.sundayThirdTurnFrom, h3.sundayThirdTurnTo,
h3.mondayFrom, h3.mondayTo, h3.mondaySecondTurnFrom, h3.mondaySecondTurnTo, h3.mondayThirdTurnFrom, h3.mondayThirdTurnTo,
h3.tuesdayFrom, h3.tuesdayTo, h3.tuesdaySecondTurnFrom, h3.tuesdaySecondTurnTo, h3.tuesdayThirdTurnFrom, h3.tuesdayThirdTurnTo,
h3.wednesdayFrom, h3.wednesdayTo, h3.wednesdaySecondTurnFrom, h3.wednesdaySecondTurnTo, h3.wednesdayThirdTurnFrom, h3.wednesdayThirdTurnTo,
h3.thursdayFrom, h3.thursdayTo, h3.thursdaySecondTurnFrom, h3.thursdaySecondTurnTo, h3.thursdayThirdTurnFrom, h3.thursdayThirdTurnTo,
h3.fridayFrom, h3.fridayTo, h3.fridaySecondTurnFrom, h3.fridaySecondTurnTo, h3.fridayThirdTurnFrom, h3.fridayThirdTurnTo,
h3.saturdayFrom, h3.saturdayTo, h3.saturdaySecondTurnFrom, h3.saturdaySecondTurnTo, h3.saturdayThirdTurnFrom, h3.saturdayThirdTurnTo
FROM empleados_rh h1 INNER JOIN puestos_empleados_rh h2 ON h1.position = h2.id INNER JOIN horarios_puestos_rh h3 ON h3.positionId = h2.id";

}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Horarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Tables are the backbone of almost all web applications.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
    <link rel="stylesheet" href="horario.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<script type="text/javascript">
    function confirmar() {
        var respuesta = confirm("Está seguro de eliminar este registro");

        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

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
                                <div>Horarios
                                    
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php $resultado = mysqli_query($conectar, $horarios);



                    while ($row = mysqli_fetch_assoc($resultado)) { ?>

                        <div class="container" >
                            <div class="col-lg-12">
                                <div class="main-card mb-5 card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="horario">

                                            
                                               
                                                <div class="contenedorH" id> 
                                                    <div class="contenedorI" i>
                                                    
                                                <h6>Usuario</h6>
                                                    <h4><?php echo utf8_encode($row["name"].' '.$row["lastname"]) ?></h4>
                                                    
                                                    
                                                    <h6>Puesto</h6>
                                                    <h4><?php echo utf8_encode($row["positionName"]); ?></h4>
                    </div>
                                                    <h3>Dias y Horas</h3>
                                                    <div>

                                                        
                                                    <h3>Domingo</h3>
                                                    <h5><?php echo $row["sundayFrom"].' ------ '.$row["sundayTo"]; ?></h5>
                                                    <h5><?php echo $row["sundaySecondTurnFrom"].' ------ '.$row["sundaySecondTurnTo"]; ?></h5>
                                                    <h5><?php echo $row["sundayThirdTurnFrom"].' ------ '.$row["sundayThirdTurnTo"]; ?></h5>                                                  
                                                    </div>

                                                    <div>
                                                    <h3>Lunes</h3>
                                                    <h5><?php echo $row["mondayFrom"].' ------ '.$row["mondayTo"]; ?></h5>
                                                    <h5><?php echo $row["mondaySecondTurnFrom"].' ------ '.$row["mondaySecondTurnTo"]; ?></h5>
                                                    <h5><?php echo $row["mondayThirdTurnFrom"].' ------ '.$row["mondayThirdTurnTo"]; ?></h5>                                                  
                                                    </div>

                                                    <div>
                                                    <h3>Martes</h3>
                                                    <h5><?php echo $row["tuesdayFrom"].' ------ '.$row["tuesdayTo"]; ?></h5>
                                                    <h5><?php echo $row["tuesdaySecondTurnFrom"].' ------ '.$row["tuesdaySecondTurnTo"]; ?></h5>
                                                    <h5><?php echo $row["tuesdayThirdTurnFrom"].' ------ '.$row["tuesdayThirdTurnTo"] ?></h5>                                                  
                                                    </div>

                                                    <div>
                                                    <h3>Miercoles</h3>
                                                    <h5><?php echo $row["wednesdayFrom"].' ------ '.$row["wednesdayTo"]; ?></h5>
                                                    <h5><?php echo $row["wednesdaySecondTurnFrom"].' ------ '.$row["wednesdaySecondTurnTo"]; ?></h5>
                                                    <h5><?php echo $row["wednesdayThirdTurnFrom"].' ------ '.$row["wednesdayThirdTurnTo"]; ?></h5>                                                  
                                                    </div>

                                                    <div>
                                                    <h3>Jueves</h3>
                                                    <h5><?php echo $row["thursdayFrom"].' ------ '.$row["thursdayTo"]; ?></h5>
                                                    <h5><?php echo $row["thursdaySecondTurnFrom"].' ------ '.$row["thursdaySecondTurnTo"]; ?></h5>
                                                    <h5><?php echo $row["thursdayThirdTurnFrom"].' ------ '.$row["thursdayThirdTurnTo"]; ?></h5>                                                  
                                                    </div>

                                                    <div>
                                                    <h3>Viernes</h3>
                                                    <h5><?php echo $row["fridayFrom"].' ------ '.$row["fridayTo"]; ?></h5>
                                                    <h5><?php echo $row["fridaySecondTurnFrom"].' ------ '.$row["fridaySecondTurnTo"]; ?></h5>
                                                    <h5><?php echo $row["fridayThirdTurnFrom"].' ------ '.$row["fridayThirdTurnTo"]; ?></h5>                                                  
                                                    </div>

                                                    <div>
                                                    <h3>Sabado</h3>
                                                    <h5><?php echo $row["saturdayFrom"].' ------ '.$row["saturdayTo"]; ?></h5>
                                                    <h5><?php echo $row["saturdaySecondTurnFrom"].' ------ '.$row["saturdaySecondTurnTo"]; ?></h5>
                                                    <h5><?php echo $row["saturdayThirdTurnFrom"].' ------ '.$row["saturdayThirdTurnTo"]; ?></h5>                                                  
                                                    </div>

                                                    
                                                    

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
    
    <script type="text/javascript" src="./assets/scripts/main.js">
    </script>
</body>

</html>
<script type="text/javascript">
	$(document).ready(function(){

		recargarLista();

		$('#usuario').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
    function recargarLista(){
       // $(document).ready(function(){
            //$("#usuario").on("change",function(){
                //var usuarioId ={
                    //"usuario" : $(this).val()
               // };
                $.ajax({
                    data: "usuarioid="+$('#usuario').val(),
                    url:'funciones/usuarioid.php'
                    type: 'POST'
                  
                    success: function(response){
                        console.log( response);
                    }
                });
            //});
        //});
    }
</script>

