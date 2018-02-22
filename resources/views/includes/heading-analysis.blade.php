<div id="accordionH{{$level}}" role="tablist" aria-multiselectable="true">
    <div class="card">
        <div class="card-title" role="tab" id="headingH{{$level}}">
            <h5 class="mb-0">
                <a data-toggle="collapse" data-parent="#accordionH{{$level}}" href="#collapseH{{$level}}"
                   aria-expanded="false" aria-controls="collapse{{$level}}">
                    &nbsp;&nbsp;
                    <label><b>{{count($tags)}}</b>

                    </label>  found <i class="fa fa-arrow-down"></i>
                </a>
            </h5>
        </div>
        <div id="collapseH{{$level}}" class="collapse hide" role="tabpanel"
             aria-labelledby="headingH{{$level}}">
            <div class="card-block">
                <ul class="list-group">
                    @foreach($tags as $h)
                        <li class="list-group-item">{{$h}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>