<?php 
    
    $title_admin = 'Posts';
    
    require 'inc/header.inc.php'; 
    
    $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
    if ($empty):
        WSErro('Ops! Você tentou editar um post que não existe.', WS_ALERT);
    endif;

    $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
    if ($action):
        
        require('_models/AdminPost.class.php');
        
        $postAction = filter_input(INPUT_GET, 'postid', FILTER_VALIDATE_INT);
        $postUpdate = new AdminPost();
        
        
        switch($action):
            case 'delete':
                $postUpdate->ExeDelete($postAction);
                WSErro($postUpdate->getError()[0], $postUpdate->getError()[1]);
                break;
            default:
                WSErro("Ação não identificada", WS_ERROR);
        endswitch;
    endif;
    
    $PaginaAtual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
    $Pager = new Pager('painel.php?exe=post/index&atual=', 'Primeira', 'Última');
    $Pager->ExePager($PaginaAtual, 20);
        
    $post = new Read();
    $post->FullRead("SELECT post.idpost, post.idsite, post.idcategoria, post.post_nome, post.publicacao, post.atualizacao, categoria.categoria_nome FROM post, categoria WHERE post.idsite=:idsite AND categoria.idcategoria = post.idcategoria ORDER BY idpost DESC LIMIT :limit OFFSET :offset", "idsite={$userlogin['site']}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    
    if (!$post->getRowCount()):
        $Pager->ReturnPage();
    endif;
    
    $Pager->ExePaginatorFullRead("SELECT post.idpost, post.idsite, post.idcategoria, post.post_nome, post.publicacao, post.atualizacao, categoria.categoria_nome FROM post, categoria WHERE post.idsite=:idsite AND categoria.idcategoria = post.idcategoria ORDER BY idpost DESC", "idsite={$userlogin['site']}");
?>

<ul class="toolbar">
    <li><a class="mdl-button mdl-js-button mdl-button--raised" href="painel.php?exe=post/add">Adicionar Notícia</a></li>
</ul>

<table class="mdl-data-table mdl-js-data-table" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Categoria</th>
            <th class="mdl-data-table__cell--non-numeric">Título</th>
            <th>Publicação</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
    <?php

        foreach ($post->getResult() as $postlist):
    ?>
        <tr>
            <td width="10" align="left"><?=$postlist['idpost']; ?></td>
            <td width="50"><?=$postlist['categoria_nome']; ?></td>
            <td class="table_content"><?php echo Check::Words($postlist['post_nome'], 50); ?></td>
            <td><?=date('d/m/Y', strtotime($postlist['publicacao'])); ?></td>
            <td><a href="painel.php?exe=post/update&postid=<?=$postlist['idpost']; ?>">Editar</a> | <a href="painel.php?exe=post/index&action=delete&postid=<?=$postlist['idpost']; ?>">Excluir</a></td>
        </tr>
    <?php
        endforeach;
    ?>
    </tbody>
</table>
<?php echo $Pager->getPaginator(); ?>

<?php require 'inc/footer.inc.php'; ?>