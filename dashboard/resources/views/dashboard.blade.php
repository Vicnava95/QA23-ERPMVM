@extends('master')
@section('title')
    <title>Dashboard</title>
@stop
@section('extra_links')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>

    <link href="css/dashboard-style.css" rel="stylesheet" type="text/css" />

    <script src="js/dashboard/dashboard.js"></script>

    <!-- Favicon (Icono Pequeño) -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    

@stop
@section('content')

	<!-- Barra de Navegacion -->

	<!-- Fin de Barra de Navegacion -->

	<!-- Iconos de Navegacion de Sistema -->
	<div class="container text-center">
        <div class="col-md-1"></div>
		<!-- Col md 10 -->
		<div class="row newIcon" style="margin-top: 30px;">
			<div class="col-md-11 col-xs-12">
				<div class="row" style="text-align: center;">
					<!-- Inicio de Icono de Notificaciones -->
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            <a href="{{route('project.active')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="{{ asset('images/icons/icon9.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Projects</strong></p>
                            </span></a>
                        </div>
                    @else
                        @if (Auth::user()->rol == 'report')

                        @else
                            <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                                <a href="{{route('project.active2')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                    <p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="{{ asset('images/icons/icon9.png') }}"></p>
                                    <p style="padding-top: 5px; margin-top: 0px;"><strong>Projects</strong></p>
                                </span></a>
                            </div>
                            
                        @endif
                        
                    @endif
					<!-- Fin de Icono de Notificaciones -->
					<!-- Inicio de Icono de Notificaciones -->
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            <a href="{{route('showPermits')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="{{ asset('images/icons/icon10.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Permits</strong></p>
                            </span></a>
                        </div>
                    @endif
					<!-- Fin de Icono de Notificaciones -->
					<!-- Inicio de Icono de Notificaciones -->
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            <a href="" onclick="location.href='/payrollToday/'+today+'/'+today+'/'+1;return false;" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="{{ asset('images/icons/icon12.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Payroll</strong></p>
                            </span></a>
                        </div>
                    @endif
					<!-- Fin de Icono de Notificaciones -->
					<!-- Inicio de Icono de Notificaciones -->
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor')
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            <a href="{{route('dispatchcenter')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="{{ asset('images/icons/icon3.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Rental Schedule</strong></p>
                            </span></a>
                        </div>
                        {{-- <!-- Fin de Icono de Notificaciones -->
                        <!-- Inicio de Icono de Notificaciones -->
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            <a href="{{route('clientsweb')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="{{ asset('images/icons/icon4.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Leads</strong></p>
                            </span></a>
                        </div>
                        <!-- Fin de Icono de Notificaciones -->
                        <!-- Inicio de Icono de Notificaciones -->
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            <a href="{{route('allContacts')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="{{ asset('images/icons/icon5.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Clients</strong></p>
                            </span></a>
                        </div> --}}
                    @endif
                    
                    @if (Auth::user()->rol == 'labor')
                        {{-- Se agregó este para que no se desconfigure el dashboard, pero está oculto --}}
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            
                        </div>
                    @endif
                    
					<!-- Fin de Icono de Notificaciones -->
					<!-- Inicio de Icono de Notificaciones -->
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            <a href="" onclick="location.href='/reportsToday/'+today+'/'+1;return false;" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="{{ asset('images/icons/icon11.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Reports</strong></p>
                            </span></a>
                        </div>
                        {{-- <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            <a href="{{route('smsDashboard')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img style="width: 80px; height: 80px;border-radius:12px;" src="{{ asset('images/icons/smsIcon.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>SMS</strong></p>
                            </span></a>
                        </div> --}}
                    @endif
                    @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo" hidden>
                            <a href="{{route('showAdminExpenses')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img style="width: 80px; height: 80px;border-radius:12px;" src="{{ asset('images/icons/adminExpenses.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Admin Expenses</strong></p>
                            </span></a>
                        </div>
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo" hidden>
                            <a href="{{route('calculator.index')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img style="width: 80px; height: 80px;border-radius:12px;" src="{{ asset('images/icons/iconcalculator.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Estimate Calculator</strong></p>
                            </span></a>
                        </div>
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            {{-- <a href="{{route('reportProjects',1)}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img style="width: 80px; height: 80px;border-radius:12px;" src="{{ asset('images/icons/iconreport.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Project Report</strong></p>
                            </span></a> --}}
                        </div>
                    @endif

                    @if (Auth::user()->rol == 'report' || Auth::user()->rol == 'labor')
                        <div class="col-md-2 col-xs-6 col-sm-2 estilo">
                            <a href="{{route('dailyReport')}}" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
                                <p style="margin-botttom: 0px; padding-bottom: 0px;"><img style="width: 80px; height: 80px;border-radius:12px;" src="{{ asset('images/icons/report.png') }}"></p>
                                <p style="padding-top: 5px; margin-top: 0px;"><strong>Daily Report</strong></p>
                            </span></a>
                        </div>
                    @endif

					<!-- Comentado para futuros modulos
					<div class="col-md-2 col-xs-6 col-sm-2" style="margin-top: 20px;">
						<a href="template.php" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
							<p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="src/img/icon1.png"></p>
							<p style="padding-top: 5px; margin-top: 0px;"><strong>Notificaciones</strong></p>
						</span></a>
					</div>
					<div class="col-md-2 col-xs-6 col-sm-2" style="margin-top: 20px;">
						<a href="template.php" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
							<p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="src/img/icon2.png"></p>
							<p style="padding-top: 5px; margin-top: 0px;"><strong>Compras</strong></p>
						</span></a>
					</div>
					<div class="col-md-2 col-xs-6 col-sm-2" style="margin-top: 20px;">
						<a href="template.php" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
							<p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="src/img/icon3.png"></p>
							<p style="padding-top: 5px; margin-top: 0px;"><strong>Facturacion</strong></p>
						</span></a>
					</div>
					<div class="col-md-2 col-xs-6 col-sm-2" style="margin-top: 20px;">
						<a href="template.php" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
							<p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="src/img/icon7.png"></p>
							<p style="padding-top: 5px; margin-top: 0px;"><strong>POS</strong></p>
						</span></a>
					</div>
					<div class="col-md-2 col-xs-6 col-sm-2" style="margin-top: 20px;">
						<a href="template.php" style="text-decoration: none; color: inherit; outline: 0; margin-top: 20px;"><span class="text-center">
							<p style="margin-botttom: 0px; padding-bottom: 0px;"><img src="src/img/icon8.png"></p>
							<p style="padding-top: 5px; margin-top: 0px;"><strong>Ayuda</strong></p>
						</span></a>
					</div>
					-->
				</div> <!-- /row pequeño -->
			</div> <!-- /colmd10 -->
			
		</div> <!-- /row grande -->
	</div> <!-- /container -->
	<!-- Fin de Iconos de Navegacion de Sistema -->

    <!--Dashboard Cards + Bages ////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="container" style="margin-top: 20px;">
        {{-- <div class="row-center mobile-hide">
            <div class="card-group" style="border:1px; margin-right: 18px;">
                <!--<div class="col-12">-->
                @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                    <div class="caja bg-light" style="margin: 10px; border-left: 1px solid #d9dadb;">
                        <div class="card-body text-center">
                            <a class="nav-link" href="{{route('project.active')}}" style="color: inherit; ">
                                <i class="fas fa-folder-open fa-2x" style="padding: 10px;"></i>
                                <h5 class="card-title">Projects</h5>
                            </a>
                        </div>
                    </div>
                    <div class="caja bg-light" style=" margin: 10px; border-left: 1px solid #d9dadb;">
                        <div class="card-body text-center responsive">
                            <a class="nav-link" href="{{route('showPermits')}}" style="color: inherit;">
                                <i class="fas fa-clipboard-check fa-2x" style="padding: 10px;"></i>
                                <h5 class="card-title">Permits</h5>
                            </a>
                        </div>
                    </div>
                    <div class="caja bg-light" style=" margin: 10px; border-left: 1px solid #d9dadb;">
                        <div class="card-body text-center">
                            <a class="nav-link" href="{{route('dispatchcenter')}}" style="color: inherit;">
                                <i class="fas fa-shipping-fast fa-2x" style="padding: 10px;"></i>
                                <h5 class="card-title text-center">Equipment Rentals</h5>
                            </a>
                        </div>
                    </div>
                    <div class="caja bg-light" style="margin: 10px; border-left: 1px solid #d9dadb;">
                        <div class="card-body text-center responsive" >
                            <a class="nav-link" href="{{route('clientsweb')}}" style="color: inherit;">
                                <i class="fab fa-google fa-2x" style="padding: 10px;"></i>
                                <h5 class="card-title">Google Leads</h5>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="caja bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                        <div class="card-body text-center">
                            <a class="nav-link" href="{{route('project.active2')}}" style="color: inherit; ">
                                <i class="fas fa-folder-open fa-2x" style="padding: 10px;"></i>
                                <h5 class="card-title">Projects</h5>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div> --}}

        {{-- <div class="row-center mobile-hide">
            <div class="card-group" style="border:1px; margin-right: 18px;">
                <!--<div class="col-12">-->
            @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
                    <div class="caja bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                        <div class="card-body text-center">
                            <a class="nav-link" href="{{route('allContacts')}}" style="color: inherit;">
                                <i class="fas fa-user-tie fa-2x" style="padding: 10px;"></i>
                                <h5 class="card-title">Clients</h5>
                            </a>
                        </div>
                    </div>
            @endif
            @if (Auth::user()->rol != 'secretary')
                <div class="caja bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center">
                        <!-- <a class="nav-link" href="" onclick="location.href='/payrollToday/'+today+'/'+today+'/'+1;return false;" style="color: inherit;"> -->
                        <a class="nav-link" href="" onclick="location.href='/dashboard/public/payrollToday/'+today+'/'+today+'/'+1;return false;" style="color: inherit;">
                            <i class="fas fa-users fa-2x" style="padding: 10px;"></i>
                            <h5 class="card-title">Payroll</h5>
                        </a>
                    </div>
                </div>
                <div class="caja bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center responsive">
                        <!-- <a class="nav-link" href="" onclick="location.href='/reportsToday/'+today+'/'+1;return false;" style="color: inherit;"> -->
                        <a class="nav-link" href="" onclick="location.href='/dashboard/public/reportsToday/'+today+'/'+1;return false;" style="color: inherit;">
                            <i class="fas fa-file-invoice-dollar fa-2x" style="padding: 10px;"></i>
                            <h5 class="card-title">Reports</h5>
                        </a>
                    </div>
                </div>
            @endif
            <div class="caja bg-white" style="margin: 10px; border:solid #ffffff">
                <div class="card-body text-center responsive" hidden>
                    <a class="nav-link" href="{{route('calculator.index')}}" style="color: inherit;">
                        <i class="fas fa-calculator fa-2x" style="padding: 10px;"></i>
                        <h5 class="card-title">Estimate Calculator</h5>
                    </a>
                </div>
            </div>
                <!--</div>-->
            </div>
        </div> --}}

        <!--                DASHBOARD RESPONSIVE FOR MOBILE                   -->
        {{-- @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
        <div class="row desktop-hide">
            <div class="col" style="width: 50%; padding-right:0px;">
                <div class="card bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center">
                        <a class="nav-link" href="{{route('project.active')}}" style="color: inherit; padding: 0px;">
                            <i class="fas fa-folder-open fa-2x" style="padding: 10px;"></i>
                            <h6 class="card-title">Projects</h6>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col" style="width: 50%; padding-left:0px;">
                <div class="card bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center responsive">
                        <a class="nav-link" href="{{route('showPermits')}}" style="color: inherit; padding: 0px;">
                            <i class="fas fa-clipboard-check fa-2x" style="padding: 10px;"></i>
                            <h6 class="card-title">Permits</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row desktop-hide">
            <div class="col" style="width: 50%; padding-right:0px;">
                <div class="card bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center">
                        <a class="nav-link" href="{{route('dispatchcenter')}}" style="color: inherit; padding: 0px;">
                            <i class="fas fa-shipping-fast fa-2x" style="padding: 10px;"></i>
                            <h6 class="card-title">Equipment Rentals</h6>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col" style="width: 50%; padding-left:0px;">
                <div class="card bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center responsive" >
                        <a class="nav-link" href="{{route('clientsweb')}}" style="color: inherit; padding: 0px;">
                            <i class="fab fa-google fa-2x" style="padding: 10px;"></i>
                            <h6 class="card-title">Google Leads</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="card bg-light col-md-12 col-sm-12 col-xs-12 col-lg-12" style="margin: 10px; border-left: 1px solid #d9dadb">
                <div class="card-body text-center">
                    <a class="nav-link" href="{{route('project.active2')}}" style="color: inherit; ">
                        <i class="fas fa-folder-open fa-2x" style="padding: 10px;"></i>
                        <h5 class="card-title">Projects</h5>
                    </a>
                </div>
            </div>
        @endif
        @if (Auth::user()->rol != 'secretary')
        <div class="row desktop-hide">
            <div class="col" style="width: 50%; padding-right:0px;">
                <div class="card bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center">
                        <!-- <a class="nav-link" href="" onclick="location.href='/payrollToday/'+today+'/'+today+'/'+1;return false;" style="color: inherit;"> -->
                        <a class="nav-link" href="" onclick="location.href='/dashboard/public/payrollToday/'+today+'/'+today+'/'+1;return false;" style="color: inherit; padding: 0px;">
                            <i class="fas fa-users fa-2x" style="padding: 10px;"></i>
                            <h6 class="card-title">Payroll</h6>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col" style="width: 50%; padding-left:0px;">
                <div class="card bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center responsive">
                        <!-- <a class="nav-link" href="" onclick="location.href='/reportsToday/'+today+'/'+1;return false;" style="color: inherit;"> -->
                        <a class="nav-link" href="" onclick="location.href='/dashboard/public/reportsToday/'+today+'/'+1;return false;" style="color: inherit; padding: 0px;">
                            <i class="fas fa-file-invoice-dollar fa-2x" style="padding: 10px;"></i>
                            <h6 class="card-title">Reports</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary')
        <div class="row desktop-hide">
            <div class="col" style="width: 50%; padding-right:0px;">
                <div class="card bg-light" style="margin: 10px; border-left: 1px solid #d9dadb">
                    <div class="card-body text-center">
                        <a class="nav-link" href="{{route('allContacts')}}" style="color: inherit; padding: 0px;">
                            <i class="fas fa-user-tie fa-2x" style="padding: 10px;"></i>
                            <h6 class="card-title">Clients</h6>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col" style="width: 50%; padding-left:0px;">
                <div class="card bg-white" style="margin: 10px; border: white;">
                    <div class="card-body text-center responsive" hidden>
                        <a class="nav-link" href="{{route('showPermits')}}" style="color: inherit; padding: 0px;">
                            <i class="fas fa-clipboard-check fa-2x" style="padding: 10px;"></i>
                            <h6 class="card-title">Permits</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif --}}
    </div>

    <script>
        var mobile = (/iphone|ipad|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
        if (mobile) {$('.card-group-2').hide();}
    </script>

    <style>
        @media only screen and (max-width: 1000px) {
            .card-group{
                flex-direction: column;
                width: auto;
            }
            .container{
                max-width: 1000px;
                
            }
            .newIcon{
                flex-wrap: nowrap | wrap | wrap-reverse;
                padding-left:10vw;
                /* padding-right:10vw; */
            }
        }  
        .caja{
            width: 150px;
            border: 1px solid #d9dadb;
        }
        @media only screen and (min-width: 601px) {
            .desktop-hide{
                display: none;
            }
            .container{
            width: max-content !important;
            }
            
        }
        .estilo{
            /* margin-left: 15px;
            margin-right: 15px; */
            padding-left: 0px;
            padding-right: 0px;
            width: 100px;
        }
    </style>
    @if (Auth::user()->rol == 'secretary')
    <style>
    .estilo{
                margin-left: 15px;
                margin-right: 15px;
                padding-left: 0px;
                padding-right: 0px;
                width: 400px;
            }
    </style>
    @endif
@stop
