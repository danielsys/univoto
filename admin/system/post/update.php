<?php

    $title_admin = "Posts &middot; Atualizar";
    
    require('inc/header.inc.php');
?>

<ul class="toolbar">
    <li><a class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" href="painel.php?exe=post/index"><i class="material-icons">keyboard_arrow_left</i> VOLTAR</a></li>
</ul>
<?php
            $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $postid = filter_input(INPUT_GET, 'postid', FILTER_VALIDATE_INT);
            
            
            
            if (isset($post) && $post['SendPostForm']):
                unset($post['SendPostForm']);
                $post['capa'] = ($_FILES['capa']['tmp_name'] ? $_FILES['capa'] : 'null');
                
                require('_models/AdminPost.class.php');
                
                $cadastra = new AdminPost();
                $cadastra->ExeUpdate($postid, $post);
                
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
                
                if (!empty($_FILES['gallery']['tmp_name'])):
                    $sendGallery = new AdminPost;
                    $sendGallery->gbSend($_FILES['gallery'], $postid);
                endif;
                
                
                
            else:
                $read = new Read;
                $read->ExeRead("post", "WHERE idpost = :idpost", "idpost={$postid}");
                if (!$read->getResult()):
                    header("Location:painel.php?exe=post/index&empty=true");
                else:
                    $post = $read->getResult()[0];
                    $post['publicacao'] = Check::DataBR($post['publicacao']);
                    $post['destaque_datainicial'] = Check::DataBR($post['destaque_datainicial']);
                    $post['destaque_datafinal'] = Check::DataBR($post['destaque_datafinal']);
                endif;
            endif;
            
            
            $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
            if ($checkCreate && empty($cadastra)):
                WSErro("O post <b>{$post['post_nome']}</b> foi cadastrado com sucesso.", WS_ACCEPT);
            endif;
            
?>

<form name="PostForm" action="" method="post" enctype="multipart/form-data" class="formPadrao">

            <label class="label">
                <span class="field">Capa (Imagem):</span>
                <input type="file" name="capa" />
            </label>
c
            <label class="label">
                <span class="field">Tipo de Post:</span>
                <select name="post_tipo">
                    <option value="0">Padrão</option>
                    <option value="1">Vídeo</option>
                </select>
            </label>

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="post_nome" value="<?php if (isset($post['post_nome'])) echo $post['post_nome']; ?>" />
            </label>

            <label class="label">
                <span class="field">Sub titulo:</span>
                <input type="text" name="post_subtitulo" value="<?php if (isset($post['post_subtitulo'])) echo $post['post_subtitulo']; ?>" />
            </label>
            
            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor editor" name="conteudo" rows="40"><?php if (isset($post['conteudo'])) echo htmlspecialchars($post['conteudo']); ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Publicacao:</span>
                    <input type="text" class="formDate center" name="publicacao" value="<?php
                    if (isset($post['publicacao'])): echo $post['publicacao'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>" />
                </label>

                <label class="label_small">
                    <span class="field">Categoria:</span>
                    <select name="idcategoria">
                        <?php
                        $readCategoria = new Read;
                        $readCategoria->ExeRead("categoria");
                        if ($readCategoria->getRowCount() >= 1):
                            foreach ($readCategoria->getResult() as $cat):
                                echo "<option value=\"{$cat['idcategoria']}\"> {$cat['categoria_nome']} </option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

                <label class="label">
                    <span class="field">Destaque:</span>
                    <select name="destaque">
                        <option value="0" <?php if (isset($post['destaque']) && $post['destaque']=='0') echo ' selected '; ?>>Não</option>
                        <option value="1" <?php if (isset($post['destaque']) && $post['destaque']=='1') echo ' selected '; ?>>Sim</option>
                    </select>
                </label>

                <label class="label">
                    <span class="field">Mostrar título em destaque:</span>
                    <select name="destaque_titulo">
                        <option value="0" <?php if (isset($post['destaque_titulo']) && $post['destaque_titulo']=='0') echo ' selected '; ?>>Não</option>
                        <option value="1" <?php if (isset($post['destaque_titulo']) && $post['destaque_titulo']=='1') echo ' selected '; ?>>Sim</option>
                    </select>
                </label>
                
                <label class="label_small">
                    <span class="field">Destaque (Data Inicial):</span>
                    <input type="text" class="formDate center" name="destaque_datainicial" value="<?php
                    if (isset($post['destaque_datainicial'])): echo $post['destaque_datainicial'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>" />
                </label>

                <label class="label_small">
                    <span class="field">Destaque (Data Final):</span>
                    <input type="text" class="formDate center" name="destaque_datafinal" value="<?php
                    if (isset($post['destaque_datafinal'])): echo $post['destaque_datafinal'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>" />
                </label>
                
                <label class="label">
                    <span class="field">Vídeo (URL):</span>
                    <input type="text" name="video" value="<?php if (isset($post['video'])) echo $post['video']; ?>" />
                </label>

                <label class="label">
                    <span class="field">Vídeo (Destaque):</span>
                    <select name="video_destaque">
                        <option value="0" <?php if (isset($post['video_destaque']) && $post['video_destaque']=='0') echo ' selected '; ?>>Não</option>
                        <option value="1" <?php if (isset($post['video_destaque']) && $post['video_destaque']=='1') echo ' selected '; ?>>Sim</option>
                    </select>
                </label>

            </div><!--/line-->
            
            <!--
            <div class="label gbform">
                <label class="label">             
                    <span class="field">Enviar Galeria:</span>
                    <input type="file" multiple name="gallery_covers[]" />
                </label>             
            </div>
            -->
            <input type="submit" class="btn blue" value="Atualizar" name="SendPostForm" />
            
            
            <div id="galeria_enviar">
                <label class="label" id="gbfoco">
                    <span class="field">Enviar Galeria:</span>
                    <input type="file" multiple name="gallery[]" />
                </label>
            </div>

            <?php
            $delGb = filter_input(INPUT_GET, 'gbdel', FILTER_VALIDATE_INT);
            if ($delGb):
                require_once('_models/AdminPost.class.php');
                $DelGaleria = new AdminPost();
                $DelGaleria->gbRemove($delGb);
                
                WSErro($DelGaleria->getError()[0], $DelGaleria->getError()[1]);
            endif;
            ?>
            
            <ul class="galeria">
                <?php
                $gbi = 0;
                $Galeria = new Read();
                $Galeria->ExeRead("galeria", "WHERE idpost=:idpost", "idpost={$postid}");
                if ($Galeria->getResult()):
                    foreach($Galeria->getResult() as $gb):
                        $gbi++
                ?>
                <li <?php if ($gbi % 5 == 0) echo 'class="right"'; ?>>
                    <div class="img thumb_small">
                        <?php echo Check::Image('../uploads/'.$gb['foto'], $gbi, 146, 100); ?>
                    </div>
                    <a href="painel.php?exe=post/update&postid=<?= $postid; ?>&gbdel=<?= $gb['idgaleria']; ?>#gbfoco" class="del">Deletar</a>
                </li>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
            
            
        </form>

<?php
    require('inc/footer.inc.php');
?>