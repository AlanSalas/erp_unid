<?php
require_once "../../config/config.php";
require_once ROOT_PATH . "/libs/database.php";
session_start();
error_reporting(0);
// $id_usr = $_SESSION["id"];
$id_empleado = $_SESSION["id_empleado"];
if (isset($id_empleado)) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Historial de Cursos</title>
    <link rel="stylesheet" href="styles.css" />
  </head>

  <body>
    <div class="container">
      <section class="banner-wrapper">
        <div class="banner">
          <div class="text">
            <?php
            $empleado = $db->get("empleados_rh", ["name", "lastname"], ["id" => $id_empleado]);
            $empleadoFullName = $empleado['name'] . ' ' . $empleado['lastname'];
            ?>
            <h2>Bienvenido <?php echo $empleadoFullName; ?> a Cursos Asignados</h2>
            <div class="sesenta">
              <p class="tets">
                <span>
                  Aqui podras ver todos tus cursos en los cuales estas registrado
                </span>
              </p>
            </div>
          </div>
        </div>
        <span class="equal">=</span>
        <!-- TODO:Cambiar al boton si quieres -->
      </section>

      <?php
      $consultaEmpleadoCursos = $db->query("SELECT cursos.nombre_curso AS curso, cursos.fecha_inicio AS inicio, cursos.fecha_final AS final, cursos.horario_curso AS horario, grupos_empleados.status_empleadoCurso AS statu, grupos.nombre_grupo AS grupo
        FROM cursos
        INNER JOIN
        grupos_empleados ON cursos.id_curso = grupos_empleados.id_curso
        INNER JOIN
        grupos ON grupos.id_grupo = grupos_empleados.id_grupo
        INNER JOIN
        cursos_empleados ON grupos_empleados.id_curso = cursos_empleados.id_curso AND grupos_empleados.id_grupo = cursos_empleados.id_grupo
        WHERE grupos_empleados.id_empleado = $id_empleado;
        ")->fetchAll();
      // var_dump($consultaEmpleadoCursos);
      if ($consultaEmpleadoCursos[0] == '') {
      ?>
        <section class="cursos">
          <h3 style="color: #274356; font-style: italic; font-weight: lighter;">Estas registrado en 0 cursos</h3>
        </section>
      <?php
      } else {
      ?>
        <section>
          <h2 class="titulo-section">Cursos Asignados</h2>
          <div class="cursos">
            <?php
            foreach ($consultaEmpleadoCursos as $consulta) {
            ?>

              <div class="boxContent">
                <div class="texto">
                  <h2 class="cursoo"><span class="tituloo"><?php echo ucfirst($consulta['curso']); ?> </span></h2>
                  <div class="blanco">
                    <p class="grupo"><?php echo strtoupper($consulta['grupo']); ?></p>
                    <h2>Horario:</h2>
                    <p><?php echo $consulta['horario']; ?></p>
                    <h2>Fecha Inicio:</h2>
                    <p><?php echo $consulta['inicio']; ?></p>
                    <h2>Fecha Fin:</h2>
                    <p><?php echo $consulta['final']; ?></p>
                  </div>
                  <div class="statuss">
                    <h4 class="status-t">Status</h4>
                    <?php if ($consulta['statu'] == 'Nuevo') {
                    ?>
                      <span class="nuevo">Nuevo</span>
                    <?php } elseif ($consulta['statu'] == 'En proceso') {
                    ?>
                      <span class="enproceso">En Proceso</span>
                    <?php } elseif ($consulta['statu'] == 'Pendiente') {
                    ?>
                      <span class="pendiente">Pendiente</span>
                    <?php } elseif ($consulta['statu'] == 'Terminado') {
                    ?>
                      <form action="certificado.php" method="POST">
                        <span class="terminado">Terminado</span>
                        <input type="submit" value="Diploma" class="btnDiploma" id="btnDiploma"></input>
                        <input type="hidden" name="empleado" value="<?php echo $empleadoFullName; ?>">
                        <input type="hidden" name="curso" value="<?php echo $consulta['curso']; ?>">
                        <input type="hidden" name="grupo" value="<?php echo $consulta['grupo']; ?>">
                      </form>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </section>
      <?php } ?>

      <footer class="footer">
        <div class="abajo">
          <hr style="border-color: rgba(255,255,255,.20); margin-bottom: 15px;">
          <small class="texto-footer">ERP UNID - Todos los derechos reservados 2020</small>
        </div>
      </footer>

    </div>
  </body>

  </html>
<?php

} else {
  header("Location:" . URL . "/erp_modulos/login/index.php");
}
?>