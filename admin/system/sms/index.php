<?php
require 'inc/header.inc.php';
?>


<h4>SMS</h4>
<?php

    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (isset($post) && $post['SendPostForm']):
        try {
            $post['mensagem'] = urlencode($post['mensagem']);
            //echo "http://54.173.24.177/painel/api.ashx?action=sendsms&lgn=96981120634&pwd=e2fsck3j&msg={$post['mensagem']}&numbers={$post['numero']}&url_callback=http://www.univoto.com.br/sms_retorno.php";
            $handle = fopen("http://54.173.24.177/painel/api.ashx?action=sendsms&lgn=96981120634&pwd=e2fsck3j&msg={$post['mensagem']}&numbers={$post['numero']}&url_callback=http://www.univoto.com.br/sms_retorno.php", "r");
            echo "SMS enviado";
        } catch (Exception $e) {
            echo "Erro ao enviar sms";
        } 
    endif;
?>
<form method="post" action="">
    <div>
        Número <input type="text" name="numero" />
    </div>
    <div>
        Mensagem (sem acento)<input type="text" name="mensagem" maxlength="140" />
    </div>
    <input type="submit" name="SendPostForm" />
</form>

<?php
require 'inc/footer.inc.php';
?>