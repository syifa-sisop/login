<li class="nav-item">
    <a href="{{ url('home')}}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Beranda
          </p>
    </a>
</li>

@if($user->level == 1)

<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manajemen Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('dataguru')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('kelas')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('datasiswa')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('absensi')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Absensi
                  </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('rekap')}}" class="nav-link">
                <i class="nav-icon fas fa-file-signature"></i>
                  <p>
                    Rekap Absensi
                  </p>
            </a>
        </li>

         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Akun
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guru</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('logout')}}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                   Logout
                  </p>
            </a>
        </li>

@endif

@if($user->level == 2)

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                  <p>
                   Manajemen Kelas
                  </p>
            </a>
        </li>

         <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Absensi
                  </p>
            </a>
        </li>

         <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                  <p>
                    Akun
                  </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('logout')}}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                   Logout
                  </p>
            </a>
        </li>

@endif

@if($user->level == 3)

<li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Absensi
                  </p>
            </a>
        </li>

         <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                  <p>
                    Akun
                  </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('logout')}}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                   Logout
                  </p>
            </a>
        </li>

@endif