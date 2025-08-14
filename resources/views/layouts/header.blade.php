<header>
   <nav class="navbar navbar-light bg-light">
       <div class="container">
            
            {{-- ロゴ（高さは自由に調整可能） --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.sns.png') }}" 
                     alt="ちょるのったー" 
                     class="logo-img" 
                     style="height:70px; width:auto;">
            </a>

            {{-- ユーザー情報とナビ --}}
            <ul class="navbar-nav d-flex flex-row align-items-center ms-auto gap-2">
                <li class="nav-item">
                    @php $user = auth()->user(); @endphp
                    <a href="{{ route('profile.show') }}" class="nav-link py-1">{{ $user->name }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link py-1"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
