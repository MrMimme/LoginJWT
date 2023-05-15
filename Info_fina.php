<?php

	session_start(); //Iniciar la sesion 

	//Limpiar el buffer de redireccionamiento
	ob_start();

	//Incluir el archivo para validar y recuperar datos del tokem
	include_once 'validar_token.php';

	//Llamar la funcion validar el token, si la funcion retorna FALSE significa que el token es
	//invalido y accede al IF
	if(!validartoken()){

		//Crear un mensaje de error y atribuir para variable global
		$_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necesita realizar un login para acceder a la pagina</p>";

		//Redirecciona el usuario para el archivo index.php
		header("Location: index.php");

		//Pausar el procesamiento de la pagina 
		exit(); 
	}


	echo "<font color='white'>Bienvenido " . recuperacionNomeToken() . ". <br></font>";
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/Styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script></script>
    <script>src="js/functions.js"</script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-qRkZ0y1sdo/VrXlTv5J0tN5eCO/1Eao/V/5qkj6rJ6gh9/M5vLcRJ3bdvLQcI23iUvj7hL4V6JsdvV7W+c55JQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-t42oDrKONJHtddnbgOs4UUI8x/mQ4aCUfeoBIBzxKElVi0qmx0i1WPhBcp4tU8HfC4I+fzuuWE5fH+pi0UUrPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Referencia al archivo JavaScript de Bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-N1V4aEwOJxkRnlvDv9A6HivuF1txd5mUhHAA4ojz79I5Oh+dpvC7JrtbNVrZdYiZ58p41dKxlLxEFO3KTwX+sg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
			
          <a class="navbar-brand" href="#">Banco Industrial</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Busquedas</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Cuentas
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Cuenta de Ahorro</a></li>
                  <li><a class="dropdown-item" href="#">Creditos activos</a></li>
				  <li><a class="dropdown-item" href="logout.php">Cerrar Sesion</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
 
			<input id="condi" value="CreaProd" readonly hidden>
			<div class="card crdbody">
					<div class="card-header">
							<h4>Detalle de Transacion</h4></div>
							<div class="card-body">
							<!-- FORMULARIO DE PRUEBAS   --->
							<div class="row crdbody">
									<div class=" col-md-3"><div class="input-group">
											<span class="input-group-text fw-bold">Agencia</span>
											<select id="CODAgencia" class="form-select">
												<option>Coban</option>
												<option>Carcha</option>
												<option>chamelco</option>
												<option selected>------</option>
											</select>
											</div>
									</div>
	
									<div class="form-group col-sm-3"><div class="input-group">
											<span class="input-group-text">Cod.Usuario</span>
													<input type="text" class="form-control" id="codcre" value="" required>
											</div>
									</div>
	
									<div class="form-group col-sm-4"><div class="input-group">
											<span class="input-group-text">Usuario</span>
											<input type="text" class="form-control" id="prod" value="" required>
											</div>
									</div>
	
									<div class="form-group col-sm-2"><div class="input-group">
											<span class="input-group-text">moneda</span>
											<select id="Mon" class="form-select">
													<option>GTQ</option>
													<option>USD</option>
													<option>EUR</option>
													<option selected>------</option>
											</select>
									</div>
									</div>
	
											</div> <!-- ROW FIN -->
	
											<div class="row crdbody">
	
													<div class="form-group col-md-4">
															<div class="input-group">
																	<span class="input-group-text">Des. Producto</span>
																	<input type="text" class="form-control" id="desc" value="" required>
															</div>
													</div>
	
													<div class="form-group col-sm-3">
															<div class="input-group">
																	<span class="input-group-text">interes</span>
																	<input type="text" class="form-control" id="inte" value="" required>
															</div>
													</div>
	
	
													<div class="form-group col-sm-3">
															<div class="input-group">
																	<span class="input-group-text">Direccion</span>
																	<input type="text" class="form-control" id="direc" value="" required>
															</div>
													</div>
											</div> <!-- ROW FIN -->
	
							</div><!-- ROW FIN  -->
					</div>

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Historial de transaciones recientes
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
							<table class="table table-dark table-hover">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">CTip.Trans</th>
											<th scope="col">Monto Trans</th>
											<th scope="col">Fecha Trans</th>
											<th scope="col">Cnumig Trans</th>
											<th scope="col">CTip moneda</th>
											<th scope="col">Opciones</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row">1</th>
											<td>Pago Luz</td>
											<td>500.00</td>
											<td>20-04-2023</td>
											<td>00-111-090</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
										<tr>
										<th scope="row">2</th>
											<td>Pago agua</td>
											<td>300.00</td>
											<td>19-04-2023</td>
											<td>00-102-90</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
										<tr>
										<th scope="row">2</th>
											<td>Retiro</td>
											<td>200.00</td>
											<td>18-04-2023</td>
											<td>00-1121-092</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
										<tr>
										<th scope="row">3</th>
											<td>Pago Luz</td>
											<td>500.00</td>
											<td>20-04-2023</td>
											<td>00-111-090</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
										<tr>
										<th scope="row">4</th>
											<td>Pago Luz</td>
											<td>500.00</td>
											<td>20-04-2023</td>
											<td>00-111-090</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
										<tr>
										<th scope="row">5</th>
											<td>Pago Luz</td>
											<td>500.00</td>
											<td>20-04-2023</td>
											<td>00-111-090</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
										<tr>
										<th scope="row">6</th>
											<td>Pago Colegiatura</td>
											<td>150.00</td>
											<td>01-04-2023</td>
											<td>00-1-090</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
										<tr>
										<th scope="row">7</th>
											<td>Pago Credito</td>
											<td>1204.00</td>
											<td>30-03-2023</td>
											<td>00-111-78</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
										<tr>
										<th scope="row">8</th>
											<td>Pago de inetres</td>
											<td>390.00</td>
											<td>30-03-2023</td>
											<td>00-111-090</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
										<tr>
										<th scope="row">9</th>
											<td>Pago Luz</td>
											<td>500.00</td>
											<td>30-03-2023</td>
											<td>00-111-090</td>
											<td>GTM.</td>
											<th><button type="button" class="btn btn-success"><i class="fa-regular fa-eye"></i></button></th>
										</tr>
									</tbody>
								</table>
            </div>
          </div>
        </div>

</body>
</html>