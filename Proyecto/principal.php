<html>
    <head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Inter&amp;display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Solidarista</title>

    <style>
    body{
  background-color: #FFFFFF;
}

.color_nav{
    background-color: #AED0EF; 

}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #A085EF; 
    padding: 10px 20px;
}


.logo img {
    max-height: 80px; 
}


nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

nav ul li {
    margin-right: 20px; 
}

nav ul li:last-child {
    margin-right: 0; 
}

nav ul li a {
    text-decoration: none;
    color: #000; 
    font-weight: bold;
}


table {
    width: 70%;
    border-collapse: collapse;
    margin: 20px;
    background-color: #AED0EF;
}

th, td {
    border: 1px solid black;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #ECECEC;
}



@media screen and (max-width: 768px) {
    body{
        background-color: #FFFFFF;
      }
      
   
      header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          background-color: #AED0EF; 
          padding: 10px 20px;
      }
      
      .logo img {
          max-height: 40px; 
      }
      
     
      nav ul {
          list-style: none;
          display: flex;
          margin: 0;
          padding: 0;
      }
      
      nav ul li {
          margin-right: 15px; 
      }
      
      nav ul li:last-child {
          margin-right: 0; 
      }
      
      nav ul li a {
          text-decoration: none;
          color: #2A1427; 
          font-weight: bold;
      }
      
      
      
}

    </style>

</head>

<body>
    <form action="index.php" method="POST">
        <header>
            <div class="logo">
                <img src="imagen/logo.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="principal.php">Inicio</a></li>

  

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Empleado</a>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
                            <li><a class="dropdown-item" href="ausencias.php">Ausencias</a></li>
                            <li><a class="dropdown-item" href="documentos.php">Documentos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Nomina</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="planilla.php">Planilla</a></li>
                            <li><a class="dropdown-item" href="historialaumento.php">Historial Aumentos</a></li>
                            <li><a class="dropdown-item" href="horaextras.php">Horas extras</a></li>
                            <li><a class="dropdown-item" href="prestamos.php">Prestamos</a></li>
                            <li><a class="dropdown-item" href="polizacontable.php">Poliza contable</a></li>

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tienda Solidarista</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="comprasolidarista.php">Compra solidarista</a></li>
                            <li><a class="dropdown-item" href="comisiones.php">Comisiones ventas</a></li>
                            <li><a class="dropdown-item" href="bonificacion.php">Bonificacion produccion</a></li>
                        </ul>
                    </li>
     
                </ul>
            </nav>
            <button type="submit" name="cerrar_sesion" class="btn btn-outline-secondary" onclick="return confirm('¿Está seguro de que desea cerrar sesión?')">Cerrar sesión</button>
        </header>

        

    </form>

    


<div class="card-group">
  <div class="card">
    
    <div class="card-body">
      <h5 class="card-title">Proposito</h5>
      <p class="card-text">Desarrollar e implementar un software integral de gestión de nómina altamente eficiente y versátil para la empresa Solidarista, S.A., que automatice y simplifique el proceso de nómina, garantizando la precisión en los cálculos y promoviendo la transparencia en la administración de los recursos financieros y beneficios de los empleados.</p>
      
    </div>
  </div>
  <div class="card">
    <img src="imagen/imagen6.gif" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Mision</h5>
      <p class="card-text">Nuestra misión es proporcionar a T Consulting, S.A. un sistema de gestión de nómina de vanguardia que permita una administración eficiente de los recursos humanos y financieros. Nos comprometemos a desarrollar un software robusto y amigable que simplifique las tareas relacionadas con la nómina y promueva la toma de decisiones informadas, garantizando al mismo tiempo la seguridad y la confidencialidad de los datos.</p>
      <p class="card-text"><small class="text-body-secondary"></small></p>
    </div>
  </div>
  <div class="card">
    
    <div class="card-body">
      <h5 class="card-title">Vision</h5>
      <p class="card-text">Ser reconocidos como líderes en el desarrollo de soluciones de gestión de nómina. Nos esforzamos por innovar continuamente y ofrecer un sistema de nómina altamente personalizable que se adapte a las necesidades cambiantes de las empresas y empleados, contribuyendo al crecimiento y éxito sostenible de nuestros clientes.</p>
     
    </div>
  </div>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



</body>
</html>