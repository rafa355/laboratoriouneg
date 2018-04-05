<!-- APP ASIDE ==========-->
<aside id="menubar" class="menubar light">
    <div class="app-user">
      <div class="media">
        <div class="media-left">
          <div class="avatar avatar-md avatar-circle">
            <a href="javascript:void(0)"><img class="img-responsive" src={{ asset('images/221.png')}} alt="avatar"/></a>
          </div><!-- .avatar -->
        </div>
        <div class="media-body">
          <div class="foldable">
            <h5><a href="javascript:void(0)" class="username">{{ Auth::user()->name }}</a></h5>
            <ul>
              <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <small>Administrador</small>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu animated flipInY">
                  
                  <li>
                    <a class="text-color" href="{{route('home.logout')}}">
                      <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                      <span>Cerrar Sesion</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div><!-- .media-body -->
      </div><!-- .media -->
    </div><!-- .app-user -->
  
    <div class="menubar-scroll">
      <div class="menubar-scroll-inner">
        <ul class="app-menu">
          <li class="has-submenu">
            <a href="{{ route('home') }}" >
              <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
              <span class="menu-text">Inicio</span>
            </a>
          </li>
          
          <li class="has-submenu">
            <a href="javascript:void(0)" class="submenu-toggle">
              <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
              <span class="menu-text">Administración</span>
              <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
            </a>
            <ul class="submenu">
              <li><a href="{{ route('admin.estudiantes.index') }}"><span class="menu-text">Estudiantes</span></a></li>
              <li><a href="{{ route('admin.computadoras.index') }}"><span class="menu-text">Computadoras</span></a></li>
            </ul>
          </li>
  

        </ul><!-- .app-menu -->
      </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
  </aside>
  <!--========== END app aside -->