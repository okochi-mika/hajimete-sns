<header>
   <nav class="navbar navbar-light bg-light">
       <div class="container">
           <a href="{{ route('posts.index') }}" class="navbar-brand">ちょるのったー</a>

           <ul class="navbar-nav d-flex flex-row align-items-center">
               <li class="nav-item me-3">
                   <a href="{{ route('profile.show') }}" class="nav-link">プロフィール</a>
               </li>
               <li class="nav-item">
                   <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                       @csrf
                   </form>
               </li>
           </ul>
       </div>
   </nav>
</header>
