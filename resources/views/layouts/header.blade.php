<header>
   <nav class="navbar navbar-light bg-light">
       <div class="container">

            @php
                $user = auth()->user();
            @endphp

            {{-- ロゴ --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.sns.png') }}" 
                     alt="ちょるのったー" 
                     class="logo-img" 
                     style="height:50px; width:auto;">
            </a>

            {{-- ユーザー情報とナビ --}}
            <ul class="navbar-nav d-flex flex-row align-items-center">
                <li class="nav-item me-3 d-flex align-items-center">
                    @if ($user && $user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="アバター" class="rounded-circle me-2" style="width:40px; height:40px;">
                    @endif
                    @if ($user)
                        <a href="{{ route('profile.show') }}" class="nav-link">{{ $user->name }}</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if ($user)
                        <a href="{{ route('logout') }}" class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                </li>
            </ul>

        </div>
    </nav>
</header>
