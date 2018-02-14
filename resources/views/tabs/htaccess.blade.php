<div class="tab-pane show active" id="nav-robot-txt" role="tabpanel" aria-labelledby="nav-robot-txt-tab">
    <form action="{{route('seo::settings.htaccess')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <textarea name="htaccess" rows="15" class="form-control"
                      placeholder="Content of your .htaccess"><?php $htaccess = new \SEO\Services\HtaccessFile();echo $htaccess->get(); ?></textarea>

            <small id="site-title-help" class="form-text text-muted">
                Please write content here carefully. Your application will be down if file edit with wrong content
            </small>

            <a class="lead text-primary" href="https://code.tutsplus.com/tutorials/the-ultimate-guide-to-htaccess-files--net-4757">Learn more about .htaccess</a>

        </div>
        <div class="form-group text-right">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>