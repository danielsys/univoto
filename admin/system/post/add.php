<?php 
    
            $title_admin = 'Posts &middot; Cadastrar';

            require 'inc/header.inc.php'; 
            
            $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if (isset($post) && $post['SendPostForm']):
                unset($post['SendPostForm']);
                $post['capa'] = ($_FILES['capa']['tmp_name'] ? $_FILES['capa'] : null);
                
                require('_models/AdminPost.class.php');
                
                $cadastra = new AdminPost();
                $cadastra->ExeCreate($post);
                
                if ($cadastra->getResult()):
                    //Cadastro OK
                    header("Location: painel.php?exe=post/update&create=true&postid=" . $cadastra->getResult());
                else:
                    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
                endif;
                 
            endif;
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data" class="formPadrao">

            <label class="label">
                <span class="field">Capa (Imagem):</span>
                <input type="file" name="capa" />
            </label>

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
                <textarea class="js_editor" name="conteudo" rows="10"><?php if (isset($post['conteudo'])) echo htmlspecialchars($post['conteudo']); ?></textarea>
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

            </div>
            
            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm" />

        </form>
<?php require 'inc/footer.inc.php'; ?>