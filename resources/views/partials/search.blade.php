<form action="{{ route('search') }}" method="GET" class="search-form d-flex">
    {{-- <input type="text" name="query" value="{{request()->input('query')}}" id="query" class="form-control" placeholder="Search for product...">
    <i class="fas fa-search search-icon my-2"></i> --}}
    <div class="form-group row">
        <div class="col-md-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-search search-icon"></span>
                    </span>
                </div>
                <input type="text" name="query" value="{{request()->input('query')}}" id="query" class="form-control" placeholder="Search for product..." style="background-color: #fff;">
            </div>
        </div>
    </div>
</form>
