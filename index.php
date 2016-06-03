<?php

    //START21 - ALTER
    //ALTER2
    ob_start();
    
    //DAN
    require('./_app/Config.inc.php');

    $Url[1] = (empty($Url[1]) ? null : $Url[1]);        
    
    $Vereador = new Read();
    $Vereador->ExeRead("site", "WHERE site = :site ", "site={$Url[0]}");
    $site = $Vereador->getResult()[0];

    //$Acesso = new Read();
    //$Acesso->FullRead("UPDATE site SET acessos = acessos + 1 WHERE site = :site", "site={$site['idsite']}");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">

        <!--[if lt IE 9]>
            <script src="<?= HOME; ?>/_cdn/html5.js"></script>
         <![endif]-->   

        <?php
		/*
			META TAGS
		*/
        $Link = new Link; 
        $Link->getTags();
        ?>
        
        <!--<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />-->
    
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" /> <!-- Fontes -->
        
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/estilo.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/menu.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/responsivo.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/boot.css">
    
        <script src="<?= HOME;?>/_script/jquery.js"></script>

        <link href="<?= HOME; ?>/_script/banner-scripts/owl.carousel.css" rel="stylesheet">
        <link href="<?= HOME; ?>/_script/banner-scripts/owl.theme.css" rel="stylesheet">
        <link href="<?= HOME; ?>/_script/banner-scripts/owl.transitions.css" rel="stylesheet">

        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/boot.css">

        <title><?php ?></title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <?php
        require(REQUIRE_PATH . '/inc/header.inc.php');

        //if (!require($Link->getPatch())):
        //    WSErro('Erro ao incluir arquivo de navegação!', WS_ERROR, true);
        //endif;
                        
        if ($Vereador->getRowCount()) {
            
            if (!$Url[1]) {
                require(REQUIRE_PATH . '/index.php');
            } else {
                        
            switch ($Url[1]):

                    case 'noticia':
                        $Url[2] = (empty($Url[2]) ? null : $Url[2]);
                        if ($Url[2]):
                            $Post = new Read();
                            $Post->ExeRead("post", "WHERE post=:post", "post={$Url[2]}");
                            
                            if ($Post->getResult()):
                                $post = $Post->getResult()[0];
                                require(REQUIRE_PATH . '/noticia-visualiza.php');
                            else:
                                require(REQUIRE_PATH . '/404.php');
                            endif;
                            
                        else:
                            require(REQUIRE_PATH . '/noticia.php');
                        endif;
                        break;
                    
                    case 'categoria':    
                        $Url[2] = (empty($Url[2]) ? null : $Url[2]);
                        if ($Url[2]):
                            require(REQUIRE_PATH . '/categoria.php');
                        else:
                            require(REQUIRE_PATH . '/404.php');
                        endif;
                        break;
                    
                    case 'contato':
                            require(REQUIRE_PATH . '/contato.php');
                        break;
                        
                    default:
                        //Page
                        $Url[1] = (empty($Url[1]) ? null : $Url[1]);
                        $Page = new Read();
                        $Page->ExeRead("pagina", "WHERE pagina = :pagina", "pagina={$Url[1]}");
                        
                        if ($Page->getResult()):
                            require(REQUIRE_PATH . '/pagina.php');
                        else:
                            require(REQUIRE_PATH . '/404.php');
                        endif;
                            break;
            endswitch;
            }
            
        } else {
            require(REQUIRE_PATH . '/404.php');           
        }
        
        require(REQUIRE_PATH . '/inc/footer.inc.php');
        ?>

    </body>
</html>
