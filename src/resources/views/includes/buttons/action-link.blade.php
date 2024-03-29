{{-- 
   $queryName : It is the "page"(hard code) key for pagination 
   $queryValue : It is current page value in pagination
   $action : route name
   $data : It is a model
   $style : Class name
   $confirm : Control the bootstrape modal will show or not
   $title : It is a label
--}}

{{-- Remove code
    if (!empty($queryName) && !empty($queryValue) && !empty($data)) {
        $route = route($action, [$data, $queryName => $queryValue]);
    } elseif (empty($data)) {
        $route = route($action, ['super']);
    } else {
        $route = route($action);
    }
--}}
@php
    if (!empty($queryName) && !empty($queryValue) && !empty($data)) {
        $route = route($action, [$data, $queryName => $queryValue]);
    } elseif (!empty($data)) {
        $route = route($action, [$data]);
    } else {
        $route = route($action);
    }
@endphp

<a class="btn py-1 px-3 btn-outline-dark border-secondary {{ $style }}" href="{{ $route }}" title="{{ $title }}">       
    <div class="d-flex flex-column h-100 justify-content-center">
        @if (isset($icon))
            <i class="{{ $icon }} lh-1"></i>
        @else
            {{ $title }}
        @endif
    </div>
</a>
