<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{\Route::current()->getName() =='seo::dashboard.index'?'active':''}}"
                   href="{{route('seo::dashboard.index')}}"><i class="fa fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{\Route::current()->getName() =='seo::dashboard.social'?'active':''}}"
                   href="{{route('seo::dashboard.social')}}"><i class="fa fa-users"></i> Social</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{\Route::current()->getName() =='seo::dashboard.sitemap'?'active':''}}"
                   href="{{route('seo::dashboard.sitemap')}}"><i class="fa fa-code"></i> XML SiteMap
                </a>
            </li>
     
            <li class="nav-item">
                <a class="nav-link {{\Route::current()->getName() =='seo::dashboard.advanced'?'active':''}}"
                   href="{{route('seo::dashboard.advanced')}}"><i class="fa fa-arrow-up"></i> Advanced</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{\Route::current()->getName() =='seo::pages.index'?'active':''}}"
                   href="{{route('seo::pages.index')}}"><i class="fa fa-file"></i> Pages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{\Route::current()->getName() =='seo::meta-tags.index'?'active':''}}"
                   href="{{route('seo::meta-tags.index')}}"><i class="fa fa-code"></i> Meta Tags</a>
            </li>

        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span><i class="fa fa-user"></i> {{auth()->user()->name}}</span>
            <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>

        </ul>
    </div>
</nav>