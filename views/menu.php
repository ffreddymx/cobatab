<?php 
session_start();

?>
<div class='dashboard'>
    <div class="dashboard-nav">
        <header><a href="#!" class="menu-toggle">
          <i class="fas fa-bars"></i></a><a href="#" class="brand-logo">
            <i> <img src="../statics/logo.jpg" width="60px">  </i> <span>COBATAB</span></a></header>

        <nav class="dashboard-nav-list"><a href="inicio.php" class="dashboard-nav-item"><i class="fas fa-home"></i>
            Inicio </a>

            <?php if($_SESSION['nivel'] == 1 ){ ?>
            <a href="usuario.php" class="dashboard-nav-item "><i class="fas fa-user"></i> Usuarios </a>
            <a href="alumnos.php" class="dashboard-nav-item "><i class="fas fa-tachometer-alt"></i> Alumnos </a>
            <a href="profesor.php" class="dashboard-nav-item"><i class="fas fa-file-upload"></i> Profesores </a>
            <?php } ?>

            <?php if($_SESSION['nivel'] == 1 or  $_SESSION['nivel'] == 2){ ?>
            <div class='dashboard-nav-dropdown'><a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i
                    class="fas fa-photo-video"></i> Grupos </a>
                    <div class='dashboard-nav-dropdown-menu'>
                    <a href="grupos.php?turno=Matutino"class="dashboard-nav-dropdown-item">Matutino</a>
                    <a href="grupos.php?turno=Vespertino"class="dashboard-nav-dropdown-item">Vespertino</a>
                    </div>
            </div>
            <?php } ?>


            <div class='dashboard-nav-dropdown'><a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i
                    class="fas fa-users"></i> Calificaciones </a>
                    <div class='dashboard-nav-dropdown-menu'>

                    <?php if($_SESSION['nivel'] == 1 or  $_SESSION['nivel'] == 2){ ?>
                    <a href="nota.php"class="dashboard-nav-dropdown-item">Asignar Calificaciones</a>
                    <?php } ?>

                    <a href="alumnosaprobados.php"class="dashboard-nav-dropdown-item">Aprobado</a>
                    <a href="alumnosirregulares.php"class="dashboard-nav-dropdown-item">Irregular</a>
                    </div>
            </div>

            <?php if($_SESSION['nivel'] == 1 ){ ?>
            <a href="administrador.php" class="dashboard-nav-item"><i class="fas fa-cogs"></i> Administrador </a>
            <?php } ?>

            <a href="horarios.php" class="dashboard-nav-item"><i class="fas fa-user"></i> Horarios </a>
          <div class="nav-item-divider"></div>
          <a
                    href="salir.php" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Salir </a>
        </nav>
    </div>






