<form action="{{ route('search') }}" method="GET" class="search-form">
    <i class="fas fa-search search-icon"></i>
    <input type="text" name="query" value="{{request()->input('query')}}" id="query" claass="search-box" placeholder="Search for product...">
</form>