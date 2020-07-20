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
            <a href="{{ route('kategori') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('kategori') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Kategori
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="{{ route('options') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('options') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Option/Opsi Jawaban
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="{{ route('pertanyaan') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('pertanyaan') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Pertanyaan
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="{{ route('kuisioner') }}" class="nav-link {{ App\Helpers\Helpers::activeLink('kuisioner') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Kuisioner
                </p>
            </a>
        </li>
    </ul>
</nav>
