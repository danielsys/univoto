<?php
ob_start();
session_start();
require('../_app/Config.inc.php');

$login = new Login(1);
if ($login->CheckLogin()):
    header('Location:painel.php');
endif;

$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dataLogin['AdminLogin'])):

    $login->ExeLogin($dataLogin);

    if (!$login->getResult()):
        $msg_alert = $login->getError()[0];
    else:
        header('Location:painel.php');
    endif;

endif;

$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
if (!empty($getexe)):
    if ($getexe == 'restrito'):
        $msg_alert = 'Acesso negado. Favor efetue login para acessar o painel!';
    elseif ($getexe == 'logoff'):
        $msg_alert = '<b>Sucesso ao deslogar:</b> Sua sessão foi finalizada.!';
    endif;
endif;
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>AdminPRO - Univoto</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />

        <!--  Light Bootstrap Dashboard core CSS    -->
        <link href="css/light-bootstrap-dashboard.css" rel="stylesheet"/>

        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />

    </head>
    <body> 

        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container">    
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= HOME; ?>">Univoto</a>
                </div>
                <div class="collapse navbar-collapse">       

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="register.html">
                                Suporte
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="wrapper wrapper-full-page">
            <div class="full-page login-page" data-color="orange" data-image="img/full-screen-image-1.jpg">   

                <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
                <div class="content">
                    <div class="container">
                        <div class="row">                   
                            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                                <form method="post" action="index.php" name="AdminLoginForm">

                                    <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                                    <div class="card card-hidden">
                                        <div class="header text-center">Entrar</div>
                                        <div class="content">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" placeholder="E-mail" name="user" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Senha</label>
                                                <input type="password" placeholder="Senha" name="pass" class="form-control">
                                            </div>                                    
                                        </div>
                                        <div class="footer text-center">
                                            <input type="submit" value="Entrar" name="AdminLogin" class="btn btn-fill btn-warning btn-wd"/>
                                        </div>
                                    </div>

                                </form>

                            </div>                    
                        </div>
                    </div>
                </div>

                <footer class="footer footer-transparent">
                    <div class="container">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Univoto
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Clientes
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                            &copy; 2016 <a href="http://www.univoto.com.br">Univoto</a>. Gerenciamento Político
                        </p>
                    </div>
                </footer>

            </div>                             

        </div>


    </body>

    <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script> 
    <script src="js/bootstrap.min.js" type="text/javascript"></script>


    <!--  Forms Validations Plugin -->
    <script src="js/jquery.validate.min.js"></script>

    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="js/moment.min.js"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="js/bootstrap-datetimepicker.js"></script>

    <!--  Select Picker Plugin -->
    <script src="js/bootstrap-selectpicker.js"></script>

    <!--  Checkbox, Radio, Switch and Tags Input Plugins -->
    <script src="js/bootstrap-checkbox-radio-switch-tags.js"></script>

    <!--  Charts Plugin -->
    <script src="js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="js/bootstrap-notify.js"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="js/sweetalert2.js"></script>

    <!-- Vector Map plugin -->
    <script src="js/jquery-jvectormap.js"></script>

    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Wizard Plugin    -->
    <script src="js/jquery.bootstrap.wizard.min.js"></script>

    <!--  Datatable Plugin    -->
    <script src="js/bootstrap-table.js"></script>

    <!--  Full Calendar Plugin    -->
    <script src="js/fullcalendar.min.js"></script>

    <!-- Light Bootstrap Dashboard Core javascript and methods -->
    <script src="js/light-bootstrap-dashboard.js"></script>

    <script type="text/javascript">
        $().ready(function () {
            lbd.checkFullPageBackgroundImage();

            setTimeout(function () {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)


<?php if (isset($msg_alert)): ?>
                $.notify({message: '<?= $msg_alert; ?>'},
                        {
                            placement: {
                                align: 'center'
                            }
                        });
<?php endif; ?>
        });
    </script>

</html>