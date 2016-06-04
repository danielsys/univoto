    <footer>
    	<div class="centralizar espaco_medio al-centro">
        	<div class="redes_base">
                    <img src="<?= INCLUDE_PATH; ?>/img/icones/facebook_footer.png" />
                    <img src="<?= INCLUDE_PATH; ?>/img/icones/twitter_footer.png" />
                    <img src="<?= INCLUDE_PATH; ?>/img/icones/instagram_footer.png" />
                    <img src="<?= INCLUDE_PATH; ?>/img/icones/youtube_footer.png" />
        	</div>
            
            <div class="info_base espaco_menor">
            	<img src="<?= INCLUDE_PATH; ?>/img/foto_candidato.png" class="fl-left" />
            	<h1 class="fontsize1"><?php echo $site['site_nome']; ?></h1><br>
                <h2 class="fontsize4 fonte900"><?php echo $site['adicional1']; ?></h2><br>
                <img src="<?= INCLUDE_PATH; ?>/img/logo_partido.png" />
             </div>
        </div>
        
        <div class="copyright bloquear_linha width100 al-centro">© 2016 -  www.univoto.com.br</div>
    </footer> 
</body>
    <script src="<?= HOME; ?>/_script/banner-scripts/owl.carousel.js"></script>
    <!-- Demo -->
    <style>
    #owl-demo .owl-item img{ width: 100%; height: auto;}
    </style>
        <script>
        $(document).ready(function() {
          $("#owl-demo").owlCarousel({
            autoPlay : 4000,
            stopOnHover :false,
            navigation:false,
            paginationSpeed : 2000,
            goToFirstSpeed : 1000,
            singleItem : true,
            autoHeight : false,
            transitionStyle:"fade",
          });
        });
        </script>
