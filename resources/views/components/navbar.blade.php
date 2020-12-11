@if(session()->has('email'))
<div class="navbar navbar-expand-md container" style='justify-content:space-between'>
    <a class="navbar-brand float-left" href="/">
        <span class='ml-0'><img src='https://via.placeholder.com/50C/O%20https://placeholder.com/'></span>
    </a>
    <div class="navbar-nav" style='flex-direction: row;align-items: center'>
        <a class="nav-item nav-item--standard btn btn-link" id="btn-dashboard" style='color:#fff' href="/dashboard">Dashboard</a>
        <a class="nav-item-btn nav-item btn btn-sm btn-red text-white" href="/user/logout">
            Logout<span id="nav-item__free"></span>
        </a>
    </div>
</div>
@else 
<div class="navbar navbar-expand-md container" style='justify-content:space-between'>
    <a class="navbar-brand float-left" href="/">
        <span class='ml-0'><img src='https://via.placeholder.com/50C/O%20https://placeholder.com/'></span>
    </a>
    <div class="navbar-nav" style='flex-direction: row;align-items: center'>
        <a class="nav-item nav-item--standard btn btn-link" style='color:#fff' href="/login">Login</a>
        <a class="nav-item-btn nav-item btn btn-sm btn-red text-white" href=/register>
            Register<span id="nav-item__free"></span>
        </a>
    </div>
</div>
@endif

