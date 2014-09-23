<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Alerta &middot MX</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBpW3yK0fHqf6_Vou_pJHv8gBns5JI6t6U&sensor=false"></script>

    <script>
</script>
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Abrir Menú"></div>
              </div>
            <!--logo start-->
            <a class="logo"><b>Alerta &middot MX</b></a>
            <!--logo end-->
                    
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a ><img src="/assets/img/icon__144x144.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Smartplace</h5>

              	  <li class="sub-menu" id="view-map">
                      <a class="active">
                          <i class="fa fa-ambulance"></i>
                          <span>Ver Alertas</span>
                      </a>
                  </li>
              	  
                  <li class="sub-menu" id="sm-addcap">
                      <a>
                          <i class="fa fa-map-marker"></i>
                          <span>Agregar CAP</span>
                      </a>
                  </li>

                    <li class="sub-menu" id="sm-addriskzone">
                      <a>
                          <i class="fa fa-exclamation-triangle"></i>
                          <span>Agregar Zona de Riesgo</span>
                      </a>
                  </li>
                  
                  <li class="sub-menu" id="sm-push">
                      <a>
                          <i class="fa fa-twitch"></i>
                          <span>Notificaciónes</span>
                      </a>
                  </li>

                   <li class="sub-menu">
                      <a>
                          <i class="fa fa-list-alt"></i>
                          <span>Crear Cuestionario</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">
          
			<div id="googleMap" class="mapwrapper"></div>
		
			<!-- <div id="action-container" style="visibility: hidden;"> -->
				<div id="form_cap">
					<div class="row action-form">
						<div class="col-xs-4 col-xs-offset-4 center-text">
							<input type="text" class="form-control form-input" id="input_nombre"  name="nombre" placeholder="Nombre">
							
							<input type="url" class="form-control form-input" id="input_capurl" name="url" placeholder="URL">
							
							<button class="btn btn-default form-input" id="submitCAP_btn">Agregar CAP</button>
						</div>
					</div>

       <div class="container">
          <div class="col-xs-12 center-text">
            <hr>
            <table id="cap_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Nombre</th>
                      <th>URL</th>
                  </tr>
              </thead>
         
              <tfoot>
                  <tr>
                      <th>Nombre</th>
                      <th>URL</th>
                  </tr>
              </tfoot>

            </table>
          </div>

          <div class="col-xs-4 col-xs-offset-4 center-text">
              <button class="btn btn-danger form-input" id="remove_cap_btn">Eliminar CAPs</button>
            </div>

        </div>
				
				</div>
				
		
				<div id="form_riskzone">

					<div class="row action-form">
						<div class="col-xs-4 col-xs-offset-4 center-text">
							<input type="text" class="form-control form-input" id="input_rz_nombre"  name="nombre" placeholder="Nombre">
						
							<input type="url" class="form-control form-input" id="input_rz_capurl" name="url" placeholder="URL">
						
							<button class="btn btn-default form-input" id="submitriskzone_btn">Agregar Zona de Riesgo</button>
						</div>
					</div>

          <div class="container">
            <div class="col-xs-12 center-text">
              <hr>
              <table id="rz_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>URL</th>
                    </tr>
                </thead>
           
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>URL</th>
                    </tr>
                </tfoot>

              </table>
            </div>

            <div class="col-xs-4 col-xs-offset-4 center-text">
              <button class="btn btn-danger form-input" id="remove_riskzone_btn">Eliminar Zonas de Riesgo</button>
            </div>

          </div>

				</div>
				
				<div id="form_push">
					<div class="row action-form">
						<div class="col-xs-4 col-xs-offset-4 center-text">
							<input type="text" class="form-control form-input" id="input_push"  name="nombre" placeholder="Ingrese su mensaje">
							<button class="btn btn-default form-input" id="sendpush_btn">Enviar Push</button>
						</div>
					</div>
				</div>
			<!-- </div> -->

      

      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/jquery.dataTables.js"></script>
    <script src="/assets/js/dataTables.bootstrap.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.scrollTo.min.js"></script>
    <script src="/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="/assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    
    
  <script>
      //custom select box

      $(function(){
/*           $('select.styled').customSelect(); */
      });

  </script>

  </body>
</html>
