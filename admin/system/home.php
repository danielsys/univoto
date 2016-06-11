<?php if (isset($userlogin['site'])): ?>
<?php else: ?>
    <div class="alert alert-warning">
        <span><b>Atenção! </b> Você precisa selecionar um site para gerenciar o conteúdo</span>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="content">
                        <h4 class="title">Selecione um site para gerenciar o conteúdo</h4>
                        <p>Você precisa selecionar um site na lista para gerenciar o conteúdo. Se você está sem acesso entre em contato com o suporte</p>
                        
                        
                                    <ul>
                                        <?php
                                        $idusers = $userlogin['idusers'];

                                        $sites = new Read();
                                        $sites->FullRead("SELECT usuario_permissao.*, site.idsite, site.site, site.site_nome FROM usuario_permissao, site WHERE site.idsite=usuario_permissao.idsite AND idusuario=:idusuario", "idusuario={$idusers}");

                                        foreach ($sites->getResult() as $site):
                                            echo "<li><a href=\"painel.php?idsite=" . $site['idsite'] . "\"><b>" . $site['site_nome'] . "</b> - " . $site['site'] . "." . DOMINIO . "</a></li>";
                                        endforeach;
                                        ?>                                       
                                    </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">1</div>
                
                <h5>Suporte</h5>
                <div class="card">
                    <div class="content">
                        Versão: <b>1.0</b><br>
                        IP: <b><?php echo $_SERVER['REMOTE_ADDR']; ?></b><br>
                        Navegador: <b><?php echo $_SERVER['HTTP_USER_AGENT']; ?></b>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php endif; ?>

