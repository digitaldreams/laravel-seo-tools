<p class="text-small text-muted">This data is shown as metadata in your site. It is intended to appear in
    Google's Knowledge Graph.
    You can be either a company or a person</p>
<form action="{{route('seo::settings.store')}}" method="post">
    {{csrf_field()}}
    <div class="form-group row">
        <label for="settings_ownership_type" class="col-sm-3">Organization / person</label>
        <select class="form-control col-sm-9" name="settings[ownership_type][value]"
                id="settings_ownership_type">
            <option value="">Choose</option>
            <option value="Person" {{$model->getValueByKey('ownership_type')=='Person'?'selected':''}}>Person</option>
            <option value="Organization" {{$model->getValueByKey('ownership_type')=='Organization'?'selected':''}}>
                Organization
            </option>
        </select>
    </div>

    <div class="form-group row">
        <label for="settings_ownership_url" class="col-sm-3"><i class="fa fa-external-link"></i> Web
            Site</label>
        <input type="url" name="settings[ownership_url][value]" class="form-control col-sm-9"
               id="settings_ownership_url" value="{{$model->getValueByKey('ownership_url')}}"
               placeholder="e.g. www.your-site.com">
    </div>

    <div class="form-group row">
        <label for="settings_ownership_email" class="col-sm-3"><i class="fa fa-envelope"></i> Email Address</label>
        <input type="email" name="settings[ownership_email][value]" class="form-control col-sm-9"
               id="settings_ownership_email" value="{{$model->getValueByKey('ownership_email')}}"
               placeholder="e.g. mail@your-site.com">
    </div>

    <div class="form-group row">
        <label for="settings_ownership_address" class="col-sm-3"><i class="fa fa-map-marker"></i> Address </label>
        <input type="text" name="settings[ownership_address][value]" class="form-control col-sm-9"
               id="settings_ownership_address" value="{{$model->getValueByKey('ownership_address')}}"
               placeholder="e.g. locality, city, Country">
        <p class="text-muted text-center">Physical address of Company</p>
    </div>
    <div class="form-group row">
        <label for="settings_ownership_logo" class="col-sm-3"><i class="fa fa-image"></i> Logo </label>
        <input type="text" name="settings[ownership_logo][value]" class="form-control col-sm-9"
               id="settings_ownership_logo" value="{{$model->getValueByKey('ownership_logo')}}"
               placeholder="e.g. https://www.your-site.com/logo.png">
        <p class="text-muted text-center">
            URL of a logo that is representative of the organization.

        <ul>
            <li> Additional image guidelines:</li>
            <li> The image must be 112x112px, at minimum.</li>
            <li> The image URL must be crawlable and indexable.</li>
            <li> The image must be in .jpg, .png, or. gif format.</li>
        </ul>


        </p>
    </div>


    <div class="form-group row">
        <label for="ownership_contact_point_telephone" class="col-sm-3"><i class="fa fa-phone-square"></i> Customer
            Service Number </label>
        <input type="text" name="settings[ownership_contact_point_telephone][value]" class="form-control col-sm-9"
               id="ownership_contact_point_telephone"
               value="{{$model->getValueByKey('ownership_contact_point_telephone')}}"
               placeholder="e.g. +1-401-555-1212">
    </div>

    <div class="form-group text-right">
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</form>