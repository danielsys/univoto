<?php
ob_start();
session_start();
require('../_app/Config.inc.php');

$login = new Login(1);

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location:index.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin'];

    $idsite = filter_input(INPUT_GET, 'idsite', FILTER_VALIDATE_INT);
    if ($idsite):
        $valida_usuario_site = new Read();
        $valida_usuario_site->ExeRead("usuario_permissao", "WHERE idusuario=:idusuario AND idsite=:idsite", "idusuario={$userlogin['idusers']}&idsite={$idsite}");
        if ($valida_usuario_site->getRowCount() == 1):
            $_SESSION['userlogin']['site'] = $idsite;
            $userlogin['site'] = $idsite;
        endif;
    endif;

endif;

if ($logoff) {
    unset($_SESSION['userlogin']);
    header('Location:index.php?exe=logoff');
}

if (isset($userlogin['site'])):
    $site = new Read();
    $site->ExeRead("site", "WHERE idsite=:idsite", "idsite={$userlogin['site']}");
    $site = $site->getResult()[0];
endif;
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>AdminPRO - Univoto</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />

        <!--  Light Bootstrap Dashboard core CSS    -->
        <link href="css/light-bootstrap-dashboard.css" rel="stylesheet"/>    

        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="css/demo.css" rel="stylesheet" />


        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />

    </head>
    <body> 

        <div class="wrapper">
            <div class="sidebar" data-color="orange" data-image="../assets/img/full-screen-image-3.jpg">    
                <!--   
                    
                    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" 
                    Tip 2: you can also add an image using data-image tag
                    
                -->

                <div class="logo">
                    <a href="http://www.univoto.com.br" class="logo-text">
                        UNIVOTO
                    </a>
                </div>
                
                <?php require 'inc/menu.inc.php'; ?>
                
            </div>

            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">    
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Dashboard<?php if (isset($userlogin['site'])): echo " &middot; " . $site['site_nome']; endif; ?></a>
                        </div>
                        <div class="collapse navbar-collapse">       

                            <!--<form class="navbar-form navbar-left navbar-search-form" role="search">                  
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <input type="text" value="" class="form-control" placeholder="Search...">
                                </div> 
                            </form>-->

                            <ul class="nav navbar-nav navbar-right">

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gavel"></i>
                                        <p class="hidden-md hidden-lg">
                                            Actions
                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Create New Post</a></li>
                                        <li><a href="#">Manage Something</a></li>
                                        <li><a href="#">Do Nothing</a></li>
                                        <li><a href="#">Submit to live</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Another Action</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-newspaper-o"></i>
                                        <p class="hidden-md hidden-lg">
                                            Notifications
                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        $idusers = $userlogin['idusers'];

                                        $sites = new Read();
                                        $sites->FullRead("SELECT usuario_permissao.*, site.idsite, site.site FROM usuario_permissao, site WHERE site.idsite=usuario_permissao.idsite AND idusuario=:idusuario", "idusuario={$idusers}");

                                        foreach ($sites->getResult() as $site):
                                            echo "<li><a href=\"painel.php?idsite=" . $site['idsite'] . "\">" . $site['site'] . "." . DOMINIO . "</a></li>";
                                        endforeach;
                                        ?>                                       
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>


                <div class="content">
                    <div class="container-fluid">    


                        <!--      here you can write your content for the main area                     -->
                        <?php
                        if (isset($userlogin['site']) && $userlogin['site'] != '') {

                            //QUERY STRING
                            if (!empty($getexe)):
                                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');
                            else:
                                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'home.php';
                            endif;

                            if (file_exists($includepatch)):
                                require_once($includepatch);
                            else:
                                echo "<div class=\"content notfound\">";
                                WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$getexe}.php!", WS_ERROR);
                                echo "</div>";
                            endif;
                        } else {
                            $erro_site = true;
                            $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'home.php';
                            require_once($includepatch);
                        }
                        ?>



                    </div>
                </div>


                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>

                                <!--        here you can add more links for the footer                       -->
                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                            &copy; 2016 <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
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


</html>



<?php
ob_end_flush();



