<?php
    $View = new View;
    $index_slide = $View->Load('index_slide');
    $index_noticia_destaque = $View->Load('index_noticia_destaque');
    $index_noticia_lista = $View->Load('index_noticia_lista');
?>
<!-- CONTEÚDO CENTRO !-->
<section id="conteudo" class="bloquear_linha">
    <!-- BOX DIREITA!-->   
    <div class="box_esquerda fl-left">
        <div id="banners" >
            <h1 class="bloquear_linha width100 fontsize2b fonte900">EM DESTAQUE</h1>
            <div id="owl-demo" class="owl-carousel"> 
                <?php
                    $qslide = new Read();
                    $qslide->ExeRead("post", "WHERE idsite=:idsite AND destaque=1 ORDER BY idpost DESC LIMIT 0, 4", "idsite={$site['idsite']}");
                    if (!$qslide->getResult()):
                        WSErro("Não existe notícias em destaque cadastrada", WS_INFOR);
                    else:
                        foreach ($qslide->getResult() as $slide):
                            $slide['SITE'] = $site['site'];
                            $slide['publicacao'] = Check::DataExtenso($slide['publicacao']);
                            $View->Show($slide, $index_slide);
                        endforeach;
                    endif;
                ?>
            </div>
        </div>


        <div id="noticia">
<?php
                $post = new Read();
                $post->ExeRead("post", "ORDER BY idpost DESC LIMIT :limit OFFSET :offset", "limit=1&offset=0");
                
                if ($post->getResult()):
                    foreach($post->getResult() as $noticia):
                        $noticia['SITE'] = $site['site'];
                        $noticia['publicacao'] = Check::DataExtenso($noticia['publicacao']);
                        $View->Show($noticia, $index_noticia_destaque);
                    endforeach;
                endif;
                $post->setPlaces("limit=8&offset=1");
                
                if ($post->getResult()):
                    foreach($post->getResult() as $noticia):
                        $noticia['SITE'] = $site['site'];
                        $noticia['publicacao'] = Check::DataExtenso($noticia['publicacao']);
                        $View->Show($noticia, $index_noticia_lista);
                    endforeach;
                endif;
                
            ?>
        </div><!-- FIM NOTICIAS!-->
    </div>
    <!-- BOX ESQUERDA!-->          
    <div class="box_direita fl-right">
        <div class="box_agenda_redes bloquear_linha width100"><!-- AGENDA!-->
            <h1 class="bloquear_linha width100 fontsize1b fonte900">AGENDA <i class="pe-7s-target"></i></h1>
			<a href="">
            <div class="agenda_principal bloquear_linha bg_branco width100">
                <div class="data_agenda_principal bg_preto al-centro fl-left">
                    <h1 class="fontsize2b cor_branca fonte900">04</h1>
                    <h2 class="fontsize1b cor_branca fonte700">AGO</h2>
                </div>
                <div class="texto_agenda_principal fl-left">
                    <span class="fontsize1">COMICIO NO BAIRRO TAL</span>
                </div>
            </div>
            </a>
            <!-- agenda 1 !-->
			<a href="">
            <div class="agenda_principal bloquear_linha bg_branco width100">
                <div class="data_agenda_principal bg_preto al-centro fl-left">
                    <h1 class="fontsize2b cor_branca fonte900">05</h1>
                    <h2 class="fontsize1b cor_branca fonte700">AGO</h2>
                </div>
                <div class="texto_agenda_principal fl-left">
                    <span class="fontsize1">COMICIO NO BAIRRO TAL</span>
                </div>
            </div>
            </a>
            <!-- agenda 2 !-->

			<a href="">
            <div class="agenda_principal bloquear_linha bg_branco width100 ">
                <div class="data_agenda_principal bg_preto al-centro fl-left">
                    <h1 class="fontsize2b cor_branca fonte900">06</h1>
                    <h2 class="fontsize1b cor_branca fonte700">AGO</h2>
                </div>
                <div class="texto_agenda_principal fl-left">
                    <span class="fontsize1">COMICIO NO BAIRRO TAL</span>
                </div>
            </div>
            </a>
            <!-- agenda 3 !-->
			<a href="">
            <div class="agenda_principal bloquear_linha bg_branco width100">
                <div class="data_agenda_principal bg_preto al-centro fl-left">
                    <h1 class="fontsize2b cor_branca fonte900">07</h1>
                    <h2 class="fontsize1b cor_branca fonte700">AGO</h2>
                </div>
                <div class="texto_agenda_principal fl-left">
                    <span class="fontsize1">COMICIO NO BAIRRO TAL</span>
                </div>
            </div>
            </a>
            <!-- agenda 4 !-->
			<a href="">
            <div class=" agenda_principal bloquear_linha bg_branco width100 5">
                <div class="data_agenda_principal bg_preto al-centro fl-left">
                    <h1 class="fontsize2b cor_branca fonte900">08</h1>
                    <h2 class="fontsize1b cor_branca fonte700">AGO</h2>
                </div>
                <div class="texto_agenda_principal fl-left">
                    <span class="fontsize1">COMICIO NO BAIRRO TAL</span>
                </div>
            </div>
            </a>
            <!-- agenda 5 !-->
        </div>

        <div class="box_agenda_redes bloquear_linha width100"><!-- FACEBOOK!-->
            <h1 class="bloquear_linha width100 fontsize1b fonte900">FACEBOOK</h1>
        </div>

        <div class="box_agenda_redes bloquear_linha width100"><!-- TWITTER!-->
            <h1 class="bloquear_linha width100 fontsize1b fonte900">TWITTER</h1>
        </div>

        <div class="box_agenda_redes bloquear_linha width100"><!-- INSTAGRAM!-->
            <h1 class="bloquear_linha width100 fontsize1b fonte900">INSTAGRAM</h1>
        </div>
    </div>
</section> 
</div>

<!-- VIDEOS!-->     
<section id="videos" class="width100">
    <div class="centralizar ">
        <h1 class="bloquear_linha width100 h1_videos  espaco_menor fontsize2b fonte900">VÍDEOS</h1>
        <div class=" bloquear_linha">
            <div class="video_principal fl-left">
                <img src="tema/visual/img/materia-principal.jpg" class="width100" />
                <h1 class=" fontsize1 cor_laranja fonte900">11 DE JULHO DE 2016</h1>
                <h2 >Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                </h2>
            </div>

            <div class="videos_miniatura fl-right">

                <div class="box_ministura_video bloquear_linha width100">
                    <img src="tema/visual/img/materia-principal.jpg" class="fl-left" />
                    <div class="data_titulo_video_miniatura">
                        <h1 class=" fontsize1 cor_laranja fonte900">13/05/2016</h1>
                        <h2 >REUNIÃO SOBRE OBRA DO AEROPORTO DE MACAPÁ</h2>
                    </div>
                </div>

                <div class="box_ministura_video bloquear_linha width100">
                    <img src="tema/visual/img/materia-principal.jpg" class="fl-left" />
                    <div class="data_titulo_video_miniatura">
                        <h1 class=" fontsize1 cor_laranja fonte900">13/05/2016</h1>
                        <h2 >REUNIÃO SOBRE OBRA DO AEROPORTO DE MACAPÁ</h2>
                    </div>
                </div>

                <div class="box_ministura_video bloquear_linha width100">
                    <img src="tema/visual/img/materia-principal.jpg" class="fl-left" />
                    <div class="data_titulo_video_miniatura">
                        <h1 class=" fontsize1 cor_laranja fonte900">13/05/2016</h1>
                        <h2 >REUNIÃO SOBRE OBRA DO AEROPORTO DE MACAPÁ</h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>