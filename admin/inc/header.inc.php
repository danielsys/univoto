<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title"><?php echo (isset($title_admin) ? $title_admin : '<b>ADMIN</b>PRO v1.0'); ?></span>


            <div class="mdl-layout-spacer"></div> 
            <!-- Navigation -->
            <nav class="mdl-navigation">
                <b style="text-transform: uppercase;"><?= Check::SiteById($userlogin['site']) . "." . DOMINIO; ?> (<?=$userlogin['site'];?>)</b>
            </nav>
        </div>
    </header>

    <?php require('inc/menu.inc.php'); ?>

    <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

            
                <?php
                /// Mostra MSG caso não tenha site selecionado
                if (isset($erro_site)):
                    echo '<div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">';
                    WSErro('Você precisa selecionar um site', WS_ALERT);
                    echo '</div>';
                endif;
                ?>

            
            <?php if (!isset($slidebar)): ?>  
                <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <?php else: ?>
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
                    <?php endif; ?>
