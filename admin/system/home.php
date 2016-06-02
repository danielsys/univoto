<?php 
    $slidebar = true;
    require('inc/header.inc.php'); 
?>

<h5>Selecione o site que você deseja gerenciar:</h5>
<?php
    
    $idusers = $userlogin['idusers'];
    
    $sites = new Read();
    $sites->FullRead("SELECT usuario_permissao.*, site.idsite, site.site FROM usuario_permissao, site WHERE site.idsite=usuario_permissao.idsite AND idusuario=:idusuario", "idusuario={$idusers}");
      
    echo '<div class="demo-list-action mdl-list">';
        foreach($sites->getResult() as $site):
            echo '<div class="mdl-list__item">';
            echo '<span class="mdl-list__item-primary-content">';
            echo '<i class="material-icons mdl-list__item-avatar">person</i>';
            echo "<a href=\"painel.php?site=" . $site['idsite'] . "\"><span>" . $site['site'] . "." . DOMINIO .  "</span></a>";
            echo "</span></div>";
        endforeach;
    echo '</div>';
?>


<style>
.demo-list-action {
  width: 300px;
}
</style>


<?php require('inc/footer.inc.php');