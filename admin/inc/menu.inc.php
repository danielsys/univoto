      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
            <img src="images/header_logo.png" >
            <hr>
          <div class="demo-avatar-dropdown">
            <span><?php echo $userlogin['users_name']; ?></span>
            
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                <li class="mdl-menu__item"><a class="mdl-color-text--blue-grey-400" href="painel.php?exe=users/profile">Alterar Senha</a></li>
              <li class="mdl-menu__item"><a class="mdl-color-text--blue-grey-400" href="painel.php?logoff=true">Sair</a></li>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="painel.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href="painel.php?exe=post/index"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">subject</i>Post</a>
          <a class="mdl-navigation__link" href="painel.php?exe=sms/index"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>SMS</a>
          <a class="mdl-navigation__link" href="painel.php?exe=users/users">Usuários</a>
          <a class="mdl-navigation__link" href="painel.php?exe=socials/index"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Redes Sociais</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i>Novidades</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i>Ajuda</a>
        </nav>
      </div>
