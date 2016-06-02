Pagina
<br>pagina: <?php echo $Url[1]; ?>
<br>
<?php
    $pagina = $Page->getResult()[0];
    
    echo "Titulo: " . $pagina['pagina_nome'];
    echo "<br>Pub: " . Check::DataBR($pagina['publicacao']);
    
?>