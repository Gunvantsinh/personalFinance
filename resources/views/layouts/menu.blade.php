<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home*') ? 'active' : '' }}" ">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-bars"></i>
        <p>Categories</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('modes.index') }}"
       class="nav-link {{ Request::is('modes*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-hand-holding-usd"></i>
        <p>Payment Modes</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('accounts.index') }}"
       class="nav-link {{ Request::is('accounts*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-landmark"></i>
        <p>Accounts</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('transcations.index') }}"
       class="nav-link {{ Request::is('transcations*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-tasks"></i>
        <p>Transcations</p>
    </a>
</li>
<li class="nav-item">
    <a href="javascript::void()"
       class="nav-link">
       <i class="nav-icon fas fa-file"></i>
        <p>Reports</p>
    </a>
</li>


