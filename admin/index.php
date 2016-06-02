<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title>Site Admin - <?= SITENAME; ?></title>

        <script src="<?= HOME; ?>/_script/jquery.js"></script>

        <link rel="stylesheet" href="css/material.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <script src="css/material.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <style>
            .login-form {
                width: 25rem; height: 20rem; position: fixed; top: 50%;
                margin-top: -9.375rem; left: 50%; margin-left: -12.5rem; background-color: #ffffff;
                 }
            </style>

        </head>
        <body class="bg-darkTeal">


        <?php
        $login = new Login(1);
        if ($login->CheckLogin()):
            header('Location:painel.php');
        endif;

        $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($dataLogin['AdminLogin'])):

            $login->ExeLogin($dataLogin);

            if (!$login->getResult()):
                WSErro($login->getError()[0], $login->getError()[1]);
            else:
                header('Location:painel.php');
            endif;

        endif;

        $getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
        if (!empty($getexe)):
            if ($getexe == 'restrito'):
                WSErro('Acesso negado. Favor efetue login para acessar o painel!', WS_ALERT);
            elseif ($getexe == 'logoff'):
                WSErro('<b>Sucesso ao deslogar:</b> Sua sessão foi finalizada.!', WS_ALERT);
            endif;
        endif;
        ?>
        <div class="login-form">
            <form name="AdminLoginForm" action="" method="post">
                <h4>Entrar</h4>
                
                <br />
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input name="user" class="mdl-textfield__input" type="email" id="user" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$">
                  <label class="mdl-textfield__label" for="user">E-mail</label>
                  <span class="mdl-textfield__error">Digite seu e-mail corretamente</span>
                </div>                

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input name="pass" class="mdl-textfield__input" type="password" id="pass" size="30">
                  <label class="mdl-textfield__label" for="pass">Senha</label>
                  <span class="mdl-textfield__error">Digite sua senha</span>
                </div>                
                
                <br />
                <br />
                <div class="form-actions">
                    <input type="submit" name="AdminLogin" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Entrar">
                    <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">Cancelar</button>
                </div>
            </form>
        </div>


    </body>
</html>