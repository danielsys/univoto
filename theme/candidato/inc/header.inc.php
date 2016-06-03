    <nav class="nav nav-aberta"><!-- Box Flutuante !-->
        <div class="centralizar">
            <ul class="listaNav fl-left">
                <li><a href="<?= HOME . "/" . $site['site']; ?>" class="bg_home transicao">HOME</a></li>
                <li><a href="<?= HOME . "/" . $site['site'] . "/biografia"; ?>" class="transicao">BIOGRAFIA</a></li>
                <li><a href="<?= HOME . "/" . $site['site'] . "/eventos"; ?>" class="transicao">EVENTOS</a></li>
                <li><a href="<?= HOME . "/" . $site['site'] . "/noticia"; ?>" class="transicao">NOTÍCIAS</a></li>
                <li><a href="<?= HOME . "/" . $site['site'] . "/contato"; ?>" class="transicao">FALE COM O CANDIDATO</a></li>
            </ul>
            <div class="logo_partido fl-right"><img src="<?= INCLUDE_PATH; ?>/img/logo_partido.png" /></div>
        </div>
    </nav><!-- Menu !-->


	<div class="centralizar">  <!-- CENTRALIZAR BOXES!-->
<!-- CAPA !-->   

    <section id="capa" class="bloquear_linha">
     <div class="logo_partido_responsivo fl-right"><img src="<?= INCLUDE_PATH; ?>/img/logo_partido.png" /></div>
<!-- FOTO !--> 
    	<div class="foto_perfil fl-left"><img src="<?= INCLUDE_PATH; ?>/img/foto_candidato.png" /></div>
        
<!-- NOME, NUMERO E LINKS !-->   
        <div class="info_candidato cor_branca  fl-left">
            <div class="numero_nome width100">
                <span class="bloquear_linha width100">VEREADOR </span>
                <h1 class="bloquear_linha width100"><?php echo $site['site_nome']; ?></h1>
                <h2 class="bloquear_linha width100 fonte900"><?php echo $site['adicional1']; ?></h2>
        	</div>
<!-- LINKS EXTRAS !-->
            <div class="links_extras">
            	<a href="" class="links_extras transicao"><i class="pe-7s-shield"></i>AGENDA</a>
                <a href="" class="links_extras transicao"><i class="pe-7s-shield"></i>LINHA DO TEMPO</a>
            </div>
            
        </div>
<!-- FIM NOME, NUMERO E LINKS !--> 

<?php if ($site['social_facebook']!='' && $site['social_instagram']!='' && $site['social_twitter']!='' && $site['social_youtube']!='') { ?>
<!-- REDES SOCIAIS ICONES !--> 
        <div class="rede_sociais al-centro fl-right">
        	<h1 class="cor_branca">REDES SOCIAIS</h1>
                <?php if ($site['social_facebook']!='') { ?><a href="https://www.facebook.com/<?=$site['social_facebook'];?>"><i class="socicon-facebook"></i></a><?php } ?>
                <?php if ($site['social_instagram']!='') { ?><a href="http://www.instagram.com/<?=$site['social_instagram'];?>"><span class="icon socicon-instagram"></span></a><?php } ?>
                <?php if ($site['social_twitter']!='') { ?><a href="http://www.twitter.com/<?=$site['social_twitter'];?>"><span class="icon socicon-twitter"></span></a><?php } ?>
                <?php if ($site['social_youtube']!='') { ?><a href="http://www.youtube.com/users/<?=$site['social_youtube'];?>"><span class="icon socicon-youtube"></span></a><?php } ?>
                
        </div>
<?php } ?>
        
<!-- VISUALIZAÇÕES !-->       
        <div class="visualizacoes al-centro cor_branca fl-right">
        	<h1 class="bloquear_linha width100 fonte900"><?php echo $site['acessos']; ?></h1>
			<h2 class="bloquear_linha width100 ">VIZUALIZAÇÕES</h2>
        </div>
    </section>
<!-- FIM CAPA !-->