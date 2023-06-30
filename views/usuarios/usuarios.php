
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>ADMINISTRACION</title>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <link rel="stylesheet" href="../../css/main.css" />
  </head>
  <body>
    <!-- SideBar -->
    <section class="full-box cover dashboard-sideBar">
      <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
      <div class="full-box dashboard-sideBar-ct">
        <!--SideBar Title -->
        <div
          class="full-box text-uppercase text-center text-titles dashboard-sideBar-title"
        >
          LA JUNGLA S.A. <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
        </div>
        <!-- SideBar User info -->
        
        <div class="full-box dashboard-sideBar-UserInfo">
          <figure class="full-box">
            <img src="" alt="UserIcon" />
            <figcaption class="text-center text-titles">Usuario</figcaption>
          </figure>
          
          <ul class="full-box list-unstyled text-center">
            <li>
              <a href="#!">
                <i class="zmdi zmdi-settings"></i>
              </a>
            </li>
            <li>
              <a href="#!" class="btn-exit-system">
                <i class="zmdi zmdi-power"></i>
              </a>
            </li>
          </ul>
        </div>

        <!-- SideBar Menu -->
        <ul class="list-unstyled full-box dashboard-sideBar-Menu">
          <li>
            <a href="../../home.html">
              <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Inicio
            </a>
          </li>
          <li>
            <a href="#!" class="btn-sideBar-SubMenu">
              <i class="zmdi zmdi-case zmdi-hc-fw"></i> RESERVACIONES
              <i class="zmdi zmdi-caret-down pull-right"></i>
            </a>
            <ul class="list-unstyled full-box">
              <li>
                <a href="period.html"
                  ><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Reservaciones</a
                >
              </li>
              <li>
                <a href="subject.html"
                  ><i class="zmdi zmdi-book zmdi-hc-fw"></i> Subject</a
                >
              </li>
              <li>
                <a href="section.html"
                  ><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i>
                  Section</a
                >
              </li>
              <li>
                <a href="salon.html"
                  ><i class="zmdi zmdi-font zmdi-hc-fw"></i> Salon</a
                >
              </li>
            </ul>
          </li>
          <li>
            <a href="#!" class="btn-sideBar-SubMenu">
              <i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Gestion del Administrador
              <i class="zmdi zmdi-caret-down pull-right"></i>
            </a>
            <ul class="list-unstyled full-box">
              <li>
                <a href="usuarios.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuarios</a>
              </li>
              <li>
                <a href="../ciudades/ciudades.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Ciudades</a>
              </li>
              <li>
                <a href="../hoteles/hoteles.php"
                  ><i class="zmdi zmdi-face zmdi-hc-fw"></i> Hoteles</a
                >
              </li>
              <li>
                <a href="../ciudades/habitaciones.php"
                  ><i class="zmdi zmdi-male-female zmdi-hc-fw"></i>
                  Habitaciones</a
                >
              </li>
            </ul>
          </li>
            </ul>
          </li>
        </ul>
      </div>
    </section>

    <!-- Content page-->
    
    <section class="full-box dashboard-contentPage">
      <!-- NavBar -->

      <!-- Content page -->
      <div class="container-fluid">
        <div class="page-header">
          <h1 class="text-titles">
            <i class="zmdi zmdi-account zmdi-hc-fw"></i> Gestionar<small>Usuarios</small>
          </h1>
        </div>
        <p class="lead">LISTADO</p>
      </div>
      
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <ul class="nav nav-tabs" style="margin-bottom: 15px">
            
            <li class="active"><a href="#list" data-toggle="tab">LISTA</a></li> 
            <li ><a href="#modalUsuarios" data-toggle="tab" data-dismiss="modal">NUEVO</a></li>
            <!--<button  class="btn btn-primary float-right" data-toggle="tab" data-target="#modalUsuarios"> Nuevo</button> -->
            </ul>
            
              <div id="myTabContent" class="tab-content">
              
                <!-- ventanas modales-->
                <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalUsuarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                              <div class="modal-content">
                                  <div >
                                    <h5 class="modal-title" id="titulModalUsuarios">Ingresar Roles Usuarios</h5>
                                    <button type="button" onclick="limpiar()" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  
                                  
                                  <form id="usuarios_form" >
                                    <div class="modal-body">
                                      <input type="hidden" name="idUsaurio" id="idUsaurio"/>
                                      
                                        <div class="form-group">
                                          <label for="Nombres" class="control-label">Nombres</label>
                                          <input type="text" name="Nombres" id="Nombres" class="form-control" required/>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label for="Apellidos" class="control-label">Apellidos</label>
                                          <input type="text" name="Apellidos" id="Apellidos" class="form-control" required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="contrasenia" class="control-label">contrasenia</label>
                                            <input type="text" name="contrasenia" id="contrasenia" class="form-control" required/>
                                        </div>                                        
                                        
                                        <div class="form-group">  
                                          <label for="correo" class="control-label">Correo</label>
                                          <input type="mail" name="correo" id="correo" class="form-control" required/>                                                                                          
                                        </div>
                                      
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary">Guardar </button>
                                          <button type="button" class="btn btn-secondary" onclick="limpiar()">Cerrar</button>
                                        </div>
                                    </div>                        
                                  </form> 

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

              <div class="tab-pane fade active in" id="list">
                <div class="table-responsive">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">NOMBRES</th>
                        <th class="text-center">APELLIDOS</th>
                        <th class="text-center">CONTRASEÑA</th>
                        <th class="text-center">CORREO</th>                        
                        <th class="text-center">OPCIONES</th>
                        
                      </tr>
                    </thead>
                      <tbody id="TablaUsuarios">
 
                      </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Notifications area -->

    <!--====== Scripts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../js/jquery-3.1.1.min.js"></script>
    <script src="../../js/sweetalert2.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/material.min.js"></script>
    <script src="../../js/ripples.min.js"></script>
    <script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="./usuarios.js"></script>
    <!-- Incluir la librería de jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Incluir la librería de Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
      $.material.init();
    </script>
  </body>
</html>
