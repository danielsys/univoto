                <div class="sidebar-wrapper">

                    <div class="user">
                        <div class="photo">
                            <img src="img/default-avatar.png" />
                        </div>                 
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                <?=$userlogin['users_name'] . " " . $userlogin['users_lastname']; ?>
                                <b class="caret"></b>
                            </a>                
                            <div class="collapse" id="collapseExample">
                                <ul class="nav">
                                    <li><a href="users/index">Perfil</a></li>
                                    <li><a href="users/password">Alterar Senha</a></li>
                                    <li><a href="painel.php?logoff=true">Sair</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <ul class="nav">
                        <li <?php if (!isset($getexe)) echo 'class="active"'; ?> >                   
                            <a href="painel.php">
                                <i class="pe-7s-graph"></i> 
                                <p>Dashboard</p>
                            </a>                
                        </li>
                        <li>                   
                            <a data-toggle="collapse" href="#componentsExamples">                        
                                <i class="pe-7s-news-paper"></i> 
                                <p>Posts
                                    <b class="caret"></b>
                                </p>
                            </a>                
                            <div class="collapse" id="componentsExamples">
                                <ul class="nav">
                                    <li><a href="painel.php?exe=post/index">Todos os Posts</a></li>
                                    <li><a href="painel.php?exe=post/add">Adicionar Post</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>                   
                            <a href="painel.php?exe=analytics/index">
                                <i class="fa fa-line-chart"></i> 
                                <p>Analytics</p>
                            </a>                
                        </li>
                        
                        <li class="divider"></li>
                        
                        <li>
                            <a href="painel.php?exe=config/index">
                                <i class="pe-7s-tools"></i>
                                <p>Configurações</p>
                            </a>
                        </li>
                        
                        <li>
                            <a href="painel.php?exe=suporte/index">
                                <i class="pe-7s-help1"></i>
                                <p>Suporte</p>
                            </a>
                        </li>
                    </ul>  
                </div>
