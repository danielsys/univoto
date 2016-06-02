<?php
$title_admin = "Usuários &middot; Cadastrar";
require 'inc/header.inc.php';

if ($login->CheckLevel(3)):
    WSErro('Você não tem permissão para acessar esta página', WS_ALERT);
else:
?>
    <article>

        <h1>Cadastrar Usuário!</h1>

        <?php
        $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($ClienteData && $ClienteData['SendPostForm']):
            unset($ClienteData['SendPostForm']);

            require('_models/AdminUser.class.php');
            $cadastra = new AdminUser;
            $cadastra->ExeCreate($ClienteData);

            if ($cadastra->getResult()):
                header("Location: painel.php?exe=users/update&create=true&userid={$cadastra->getResult()}");
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;
        ?>

        <form action = "" method = "post" name = "UserCreateForm">
            <label class="label">
                <span class="field">Nome:</span>
                <input
                    type = "text"
                    name = "users_name"
                    value="<?php if (!empty($ClienteData['users_name'])) echo $ClienteData['users_name']; ?>"
                    title = "Informe seu primeiro nome"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">Sobrenome:</span>
                <input
                    type = "text"
                    name = "users_lastname"
                    value="<?php if (!empty($ClienteData['users_lastname'])) echo $ClienteData['users_lastname']; ?>"
                    title = "Informe seu sobrenome"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">E-mail:</span>
                <input
                    type = "email"
                    name = "users_email"
                    value="<?php if (!empty($ClienteData['users_email'])) echo $ClienteData['users_email']; ?>"
                    title = "Informe seu e-mail"
                    required
                    />
            </label>

            <div class="label_line">
                <label class="label_medium">
                    <span class="field">Senha:</span>
                    <input
                        type = "password"
                        name = "users_password"
                        value="<?php if (!empty($ClienteData['users_password'])) echo $ClienteData['users_password']; ?>"
                        title = "Informe sua senha [ de 6 a 12 caracteres! ]"
                        pattern = ".{6,12}"
                        required
                        />
                </label>


                <label class="label_medium">
                    <span class="field">Nível:</span>
                    <select name = "users_level" title = "Selecione o nível de usuário" required >
                        <option value = "">Selecione o Nível</option>
                        <option value = "1" <?php if (isset($ClienteData['user_level']) && $ClienteData['user_level'] == 1) echo 'selected="selected"'; ?>>User</option>
                        <option value="2" <?php if (isset($ClienteData['user_level']) && $ClienteData['user_level'] == 2) echo 'selected="selected"'; ?>>Editor</option>
                        <option value="3" <?php if (isset($ClienteData['user_level']) && $ClienteData['user_level'] == 3) echo 'selected="selected"'; ?>>Admin</option>
                    </select>
                </label>
            </div><!-- LABEL LINE -->

            <input type="submit" name="SendPostForm" value="Cadastrar Usuário" class="btn green" />
        </form>

    </article>
<?php
endif; //If Verifica level
require 'inc/footer.inc.php';
?>