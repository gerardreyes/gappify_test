<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav-pills">
            <li class="nav-item"><span class="navbar-brand mb-0 h1 font-weight-bolder">GAPPIFY </span></li>
            <li class="nav-item" id="header_li_home"><a class="nav-link" href="{{URL::to('home');}}"><i class="fas fa-home"></i> Home </a></li>
            <li class="nav-item" id="header_li_transaction"><a class="nav-link" href="{{URL::to('transactions');}}"><i class="fas fa-file-invoice-dollar"></i> Transactions </a></li>
            @if(isset(Auth::user()->access) && Auth::user()->access==1)
            <li class="nav-item" id="header_li_add"><a class="nav-link" href="{{URL::to('add_company');}}"><i class="fas fa-plus"></i> Add Company </a></li>
            <li class="nav-item" id="header_li_add_transaction"><a class="nav-link" href="{{URL::to('add_transaction');}}"><i class="fas fa-cart-plus"></i> Add Transaction </a></li>
            @endif
        </ul>

        <ul class="navbar-nav nav-pills">
            <li class="nav-item"><a class="nav-link no-pointer-events"><i class="fas fa-user"></i> Welcome {{ Auth::check() ? Auth::user()->username : 'Guest' }}</a></li>
            <li class="nav-item" id="header_li_login">
                @if(Auth::check())
                <a class="nav-link" href="{{URL::to('logout');}}" id="button_logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                @else
                <a class="nav-link" href="{{URL::to('login');}}"><i class="fas fa-sign-in-alt"></i> Login</a>
                @endif
            </li>
        </ul>
    </div>
</nav>