<div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
            
            <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
                <h2 class="mdl-card__title-text">Informativo</h2>
              </div>
              <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                Nenhum informativo
              </div>
              <div class="mdl-card__actions mdl-card--border">
                <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">Leia mais</a>
              </div>
            </div>
              
            <div class="demo-separator mdl-cell--1-col"></div>



    <!-- Wide card with share menu button -->
    <style>
    .demo-card-wide.mdl-card {
      width: 512px;
    }
    .demo-card-wide > .mdl-card__title {
      color: #fff;
      height: 100px;
      background:#00e676; /** url('../assets/demos/welcome_card.jpg') center / cover; **/
    }
    .demo-card-wide > .mdl-card__menu {
      color: #fff;
    }
    </style>

    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Sistema</h2>
      </div>
      <div class="mdl-card__supporting-text">
          Versão do AdminPro: <b>1.0</b><br>
          IP: <b><?php echo $_SERVER['REMOTE_ADDR']; ?></b><br>
          Navegador: <b><?php echo $_SERVER['HTTP_USER_AGENT']; ?></b>
      </div>
    </div>        

    
</div> <!-- endslidebar -->