<div class="search-form">
    {{ Form::open(array('url' => 'search', 'method' => 'GET')) }}
    <i class="fa fa-search icon"></i>
    <input class="serach-field" type="text" placeholder="{{ trans('messages.search')}}....." name="keyword" value="{{ $query }}" />
    {{ Form::close() }}
</div>