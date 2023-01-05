<section>
    <nav>
        <ul>
            <li>
                <a href="{{ route('logout') }}" @if (URL::full() == route('logout')) class="active" @endif>
                    <span class="icon"><i class="tes te-solicitation"></i></span>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</section>
