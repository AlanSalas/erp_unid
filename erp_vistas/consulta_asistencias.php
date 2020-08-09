<?php
require "../config/config.php";
require_once ROOT_PATH . "/libs/database.php";
$filter = false;
if($_GET){
    $filter = true;
}
$fecha_actual = date('Y-m-d');
$query;
$tipo;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container pt-5">
        <?php
        if($filter){
            $query = $_GET['query'];
            $tipo = $_GET['tipo'];
        } else {
            $query = $fecha_actual;
            $tipo = "entrada";
        }
        ?>
        <div class="row mb-2">
            <div class="col-4">
                <h3>
                    <?php
                    echo date('l', strtotime($query))." ".$query;
                    ?>
                </h3>
            </div>
            <div class="col-8 ml-auto text-right">
                <form>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-4 ml-auto">
                                <input class="form-control" type="date" value="<?=$query;?>" id="filtro-fecha" max="<?=date("Y-m-d");?>">
                            </div>
                            <div class="col-2 text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="entrada" <?php if($tipo == "entrada"){ ?> checked <?php } ?>>
                                    <label class="form-check-label">Entrada</label>
                                </div>
                            </div>
                            <div class="col-2 text-left">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="salida" <?php if($tipo == "salida"){ ?> checked <?php } ?>>
                                    <label class="form-check-label">Salida</label>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                            <button class="d-block btn btn-info w-100" type="button" id="filtro">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Depto</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Código</th>
                    <th scope="col">Hora de <?=$tipo?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // echo $query;
                $lista_hoy = $db->select('asistencia(a)', [
                    "[>]empleados_rh(e)" => ["a.empleado_id" => "id"],
                    "[>]departamentos_rh(d)" => ["a.departamento_id" => "id"]
                ], [
                    "e.name",
                    "e.lastname",
                    "e.mothersLastname",
                    "d.name(depto)",
                    "a.codigo_persona",
                    "a.fecha_hora",
                    "a.departamento_id(important)"
                ], [
                    "a.fecha" => $query,
                    "a.tipo" => $tipo
                ]);
                foreach($lista_hoy as $h){
                ?>
                    <tr>
                        <td><?php echo $h["depto"];?></td>
                        <td><?php echo $h["name"]." ".$h["lastname"]." ".$h["mothersLastname"];?></td>
                        <td><?php echo $h["codigo_persona"];?></td>
                        <?php
                        $dia_actual_consulta = $db->get('horarios_puestos_rh(h)', [
                            "[>]puestos_empleados_rh(p)" => ["h.positionId" => "id"]
                        ], [
                                strtolower(date('l', strtotime($query)))."From"
                        ], [
                            "p.positionDepartment" => $h["important"]
                        ]);
                        // echo date("Y-m-d");
                        // print_r($dia_actual_consulta);
                        if($h["fecha_hora"] <= $query." ".$dia_actual_consulta[strtolower(date('l', strtotime($query)))."From"] && $tipo == "entrada"){
                            ?>
                            <td class="text-success"><?php $hora = explode(" ", $h["fecha_hora"]); echo $hora[1]; ?></td>
                            <?php
                        } else if($h["fecha_hora"] > $query." ".$dia_actual_consulta[strtolower(date('l', strtotime($query)))."From"] && $tipo == "entrada") {
                            ?>
                            <td class="text-warning"><?php $hora = explode(" ", $h["fecha_hora"]); echo $hora[1]; ?></td>
                            <?php
                        } else {
                            ?>
                            <td><?php $hora = explode(" ", $h["fecha_hora"]); echo $hora[1]; ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
    $('#filtro').click(function(){
        let tipo = $('input[name=tipo]:checked').val();
        location.href = "./consulta_asistencias.php?query=" + $('#filtro-fecha').val() + "&tipo=" + tipo;
    });
</script>
</body>
</html>