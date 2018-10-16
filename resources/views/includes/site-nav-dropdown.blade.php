<div class="btn-group">
    <button class="btn btn-default btn-sm" type="button" data-toggle="dropdown">
        {{isset($menu)?$menu:'Dashboard'}}
    </button>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="dLabel">
        <a class="dropdown-item {{\Route::current()->getName() =='seo::dashboard.index'?'active':''}}"
           href="{{route('seo::dashboard.index')}}">Dashboard</a>
        <a class="dropdown-item {{\Route::current()->getName() =='seo::dashboard.social'?'active':''}}"
           href="{{route('seo::dashboard.social')}}">Social</a>
        <a class="dropdown-item {{\Route::current()->getName() =='seo::dashboard.sitemap'?'active':''}}"
           href="{{route('seo::dashboard.sitemap')}}">XML SiteMap</a>
        <a class="dropdown-item {{\Route::current()->getName() =='seo::dashboard.tools'?'active':''}}"
           href="{{route('seo::dashboard.tools')}}">Tools</a>
        <a class="dropdown-item {{\Route::current()->getName() =='seo::dashboard.advanced'?'active':''}}"
           href="{{route('seo::dashboard.advanced')}}">Advanced</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item {{\Route::current()->getName() =='seo::pages.index'?'active':''}}"
           href="{{route('seo::pages.index')}}">Pages</a>
        <a class="dropdown-item {{\Route::current()->getName() =='seo::meta-tags.index'?'active':''}}"
           href="{{route('seo::meta-tags.index')}}">Meta Tags</a>
    </div>
</div>