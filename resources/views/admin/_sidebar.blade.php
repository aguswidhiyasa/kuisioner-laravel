<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ App\Helpers\Helpers::activeLink('admin.home') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="{{ route('kategori') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('kategori*') }}">
                <i class="nav-icon fas fa-project-diagram"></i>
                <p>
                    Kategori
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="{{ route('options') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('options') }}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Option/Opsi Jawaban
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="{{ route('pertanyaan') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('pertanyaan') }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                    Pertanyaan
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview {{ App\Helpers\Helpers::activeLink(['kuisioner', 'kuisioner.master'], true) }}">
            <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon fas fa-file-signature"></i>
                <p>
                    Kuisioner
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('kuisioner.master') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('kuisioner.master') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Kuisioner</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kuisioner') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('kuisioner') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jawaban Kuisioner</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="{{ route('users') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('users') }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Users
                </p>
            </a>
        </li>
    </ul>
</nav>
