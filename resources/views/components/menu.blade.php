<section>
    <nav>
        <ul>
            <li>
                <a href="{{ route('register') }}" @if (URL::full() == route('register')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>Novo funcionário</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" @if (URL::full() == route('logout')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>Sair</span>
                </a>
            </li>
        </ul>
    </nav>
</section>
