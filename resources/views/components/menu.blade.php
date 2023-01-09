<section>
    <nav>
        <ul>
            <li>
                <a href="{{ route('comercial_passivo.index') }}" @if (URL::full() == route('comercial_passivo.index')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>CP - Lista de Leads</span>
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}" @if (URL::full() == route('register')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>G - Cadastrar funcionário</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cliente.adiciona') }}" @if (URL::full() == route('cliente.adiciona')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>CA - Cadastrar Lead</span>
                </a>
            </li>
            <li>
                <a href="{{ route('como_soube.index') }}" @if (URL::full() == route('como_soube.index')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>CA - Como Soube</span>
                </a>
            </li>
            <li>
                <a href="{{ route('comercial_pap.adiciona') }}" @if (URL::full() == route('comercial_pap.adiciona')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>CP - Cadastrar Lead</span>
                </a>
            </li>
            <li>
                <a href="{{ route('como_soube.index') }}" @if (URL::full() == route('como_soube.index')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>CP - Como Soube</span>
                </a>
            </li>
            <li>
                <a href="{{ route('comercial_reativo.index') }}" @if (URL::full() == route('comercial_reativo.index')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>CR - Leads</span>
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
