{{-- @if(session()->has('admin')) --}}
@if(session()->has('admin'))
<div class="navbar navbar-expand-md container" style='justify-content:space-between'>
    <a class="navbar-brand float-left" href="/">
        <span class='ml-0'><img style="max-height:70px" src='{{asset('images/icons/headphone.svg')}}'></span>
    </a>
    <div class="navbar-nav" style='flex-direction: row;align-items: center'>
        
        <a class="btn btn-danger btn-sm " id="btn-dashboard" style='color:#fff' href="/dashboard">Dashboard</a>
        &nbsp;
        @if(session('admin')==0)
        <div class="dropdown show">
            <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <x-heroicon-o-cog style="height:20px" />
                Settings
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="user/profile">Profile </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/user/logout">
                    Logout</span>
                </a>
            </div>
        </div>
        
        @elseif(session('admin')==1)
        <a class="btn btn-default btn-sm " id="btn-dashboard" style='' href="/logout">Logout</a>
        @endif
    </div>

</div>
@else
<div class="navbar navbar-expand-md container" style='justify-content:space-between'>
    <a class="navbar-brand float-left" href="/">
        <span class='ml-0'><img style="max-height:70px" src='{{asset('images/icons/headphone.svg')}}'></span>
    </a>
    <div class="navbar-nav" style='flex-direction: row;align-items: center'>
        <a class="btn btn-danger btn-sm " style='color:#fff' href="/login">Login</a>
        <a class="nav-item-btn nav-item btn btn-sm btn-red text-white" href=/register>
            Register<span id="nav-item__free"></span>
        </a>
    </div>

</div>
@endif
