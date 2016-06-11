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

    $site = filter_input(INPUT_GET, 'site', FILTER_VALIDATE_INT);
    if ($site):
        $valida_usuario_site = new Read();
        $valida_usuario_site->ExeRead("usuario_permissao", "WHERE idusuario=:idusuario AND idsite=:idsite", "idusuario={$userlogin['idusers']}&idsite={$site}");
        if ($valida_usuario_site->getRowCount() == 1):
            $_SESSION['userlogin']['site'] = $site;
            $userlogin['site'] = $site;
        endif;
    endif;

endif;

if ($logoff) {
    unset($_SESSION['userlogin']);
    header('Location:index.php?exe=logoff');
}

$userlogin['site'] = (!isset($userlogin['site']) ? '' : $userlogin['site']);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>AdminPro</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

        <script src="<?= HOME; ?>/_script/jquery.js"></script>


        <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800' rel='stylesheet' type='text/css'> -->

        <!--[if lt IE 9]>
            <script src="../_script/html5.js"></script> 
        <![endif]-->
    
        <link rel="shortcut icon" href="images/favicon.png">

        <link rel="stylesheet" href="css/material.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <script src="css/material.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    </head>
    <body>


        <div id="painel">
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


        <script src="../_script/jquery.js"></script>
        <script src="../_script/jmask.js"></script>
        <!--<script src="../_script/combo.js"></script>-->
        <script src="__jsc/tiny_mce/tiny_mce.js"></script>
        <script src="__jsc/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
        <script src="__jsc/admin.js"></script>
        <script>
        </script>
    </body>
</html>
<?php
ob_end_flush();
