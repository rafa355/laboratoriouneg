<!DOCTYPE html>
<html lang="en">
@include('admin.template.header')

<body class="menubar-left menubar-unfold menubar-light theme-primary">

    @include('admin.template.partials.SideBar')
    
    @include('admin.template.partials.NavBar')

    <main id="app-main" class="app-main">
        
        <div class="wrap">
            @yield('content')
        </div>
    </main>

    @include('admin.template.scripts')

</body>

</html>