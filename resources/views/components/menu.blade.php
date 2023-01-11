<section>
    <nav>
        <ul>
            @if (auth()->user()->tipo_de_usuario == 1 || auth()->user()->tipo_de_usuario == 0)
            <li>
                <span>
                    <p style="padding-left: 20px;">Comercial Ativo</p>
                    <span class="icon"><i class="tes te-dropdown"></i></span>
                </span>
                <ul class="dropdown">
                    <li>
                        <a href="{{ route('comercial_ativo.adiciona') }}" @if (URL::full() == route('comercial_ativo.adiciona')) class="active" @endif>
                            <span style="padding-left: 20px;">Cadastrar Lead</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('como_soube.index') }}" @if (URL::full() == route('como_soube.index')) class="active" @endif>
                            <span style="padding-left: 20px;">Como Soube</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if (auth()->user()->tipo_de_usuario == 4 || auth()->user()->tipo_de_usuario == 0)
            <li>
                <span>
                    <p style="padding-left: 20px;">Comercial PAP</p>
                    <span class="icon"><i class="tes te-dropdown"></i></span>
                </span>
                <ul class="dropdown">
                    <li>
                        <a href="{{ route('comercial_pap.adiciona') }}" @if (URL::full() == route('comercial_pap.adiciona')) class="active" @endif>
                            <span style="padding-left: 20px;">Cadastrar Lead</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('como_soube.index') }}" @if (URL::full() == route('como_soube.index')) class="active" @endif>
                            <span style="padding-left: 20px;">Como Soube</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if (auth()->user()->tipo_de_usuario == 2 || auth()->user()->tipo_de_usuario == 0)
            <li>
                <span>
                    <p style="padding-left: 20px;">Comercial Passivo</p>
                    <span class="icon"><i class="tes te-dropdown"></i></span>
                </span>
                <ul class="dropdown">
                    <li>
                        <a href="{{ route('comercial_passivo.index') }}" @if (URL::full() == route('comercial_passivo.index')) class="active" @endif>
                            <span style="padding-left: 20px;">Lista de Leads</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if (auth()->user()->tipo_de_usuario == 3 || auth()->user()->tipo_de_usuario == 0)
            <li>
                <span>
                    <p style="padding-left: 20px;">Comercial Reativo</p>
                    <span class="icon"><i class="tes te-dropdown"></i></span>
                </span>
                <ul class="dropdown">
                    <li>
                        <a href="{{ route('comercial_reativo.index') }}" @if (URL::full() == route('comercial_reativo.index')) class="active" @endif>
                            <span style="padding-left: 20px;">Lista de Leads</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if (auth()->user()->tipo_de_usuario == 0)
            <li>
                <span>
                    <p style="padding-left: 20px;">Gerente</p>
                    <span class="icon"><i class="tes te-dropdown"></i></span>
                </span>
                <ul class="dropdown">
                    <li>
                        <a href="{{ route('gerente.cadastro_funcionario') }}" @if (URL::full() == route('gerente.cadastro_funcionario')) class="active" @endif>
                            <span style="padding-left: 20px;">Cadastrar funcionário</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('plano.index') }}" @if (URL::full() == route('plano.index')) class="active" @endif>
                            <span style="padding-left: 20px;">Cadastrar planos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gerente.gerenciar_funcionario') }}" @if (URL::full() == route('gerente.gerenciar_funcionario')) class="active" @endif>
                            <span style="padding-left: 20px;">Gerenciar funcionários</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gerente.relatorio_conversao') }}" @if (URL::full() == route('gerente.relatorio_conversao')) class="active" @endif>
                            <span style="padding-left: 20px;">Relatório de conversão</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if (auth()->user()->tipo_de_usuario == 5 || auth()->user()->tipo_de_usuario == 0)
            <li>
                <span>
                    <p style="padding-left: 20px;">Marketing</p>
                    <span class="icon"><i class="tes te-dropdown"></i></span>
                </span>
                <ul class="dropdown">
                    <li>
                        <a href="{{ route('marketing.index') }}" @if (URL::full() == route('marketing.index')) class="active" @endif>
                            <span style="padding-left: 20px;">Relatório</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li>
                <a href="{{ route('perfil') }}" @if (URL::full() == route('perfil')) class="active" @endif>
                    <span style="padding-left: 20px;">Meu perfil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" @if (URL::full() == route('logout')) class="active" @endif>
                    <span style="padding-left: 20px;">Sair</span>
                </a>
            </li>
        </ul>
    </nav>
</section>
