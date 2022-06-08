<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        {{$title}}
    </h1>
    @isset ($link)
        <a href="{{$href}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas {{$icon}} fa-sm text-white-50"></i> {{$link}}
        </a>
    @else
        @if ($buttons)
            {!! $buttons !!}
        @endif
    @endisset

</div>