<?php
$title_admin = "Usuários";
require 'inc/header.inc.php';

if ($login->CheckLevel(3)):
    WSErro('Você não tem permissão para acessar esta página', WS_ALERT);
else:

    $delete = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
    if ($delete):
        require('_models/AdminUser.class.php');
        $delUser = new AdminUser;
        $delUser->ExeDelete($delete);
        WSErro($delUser->getError()[0], $delUser->getError()[1]);
    endif;
    ?>
    <ul class="toolbar">
        <li><a class="mdl-button mdl-js-button mdl-button--raised" href="painel.php?exe=users/create">Cadastrar Usuário</a></li>
    </ul>

    <table class="mdl-data-table mdl-js-data-table" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th class="mdl-data-table__cell--non-numeric">Nome</th>
                <th class="mdl-data-table__cell--non-numeric">E-mail</th>
                <th>Nível</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $read = new Read;
            $read->ExeRead("users", "ORDER BY users_name");
            if ($read->getResult()):
                foreach ($read->getResult() as $user):
                    extract($user);
                    $nivel = ['', 'User', 'Editor', 'Admin'];
                    ?>            
                <tr>
                    <td><?= $idusers; ?></td>
                    <td class="table_content">
                        <b><?= $users_name . ' ' . $users_lastname; ?></b><br>
                        <?php
                            $UsuarioPermissao = new Read();
                            $UsuarioPermissao->FullRead("SELECT site.site FROM usuario_permissao INNER JOIN site ON site.idsite = usuario_permissao.idsite WHERE usuario_permissao.idusuario=:idusuario", "idusuario={$idusers}");
                            if ($UsuarioPermissao->getResult()):
                                foreach($UsuarioPermissao->getResult() as $usuariopermissao):
                                    echo "&raquo; " . $usuariopermissao['site'] . "." . DOMINIO . "<br>";
                                endforeach;
                            endif;
                        ?>
                    </td>
                    <td valign="top" class="table_content"><?= $users_email; ?></td>
                    <td><?= $nivel[$users_level]; ?></td>
                    <td>
                        <a href="painel.php?exe=users/update&userid=<?= $idusers; ?>" title="Editar">Editar</a> |
                        <a href="painel.php?exe=users/users&delete=<?= $idusers; ?>" title="Deletar">Deletar</a>
                    </td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>

    </tbody>
    </table>

<?php
endif; //If Verifica level
require 'inc/footer.inc.php';
?>