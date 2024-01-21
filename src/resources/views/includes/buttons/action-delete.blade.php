{{-- 
   $queryName : It is the "page"(hard code) key for pagination 
   $queryValue : It is current page value in pagination
   $action : route name
   $data : It is a model
   $style : Class name
   $confirm : Control the bootstrape modal will show or not
   $title : It is a label
--}}

<form class="btn btn-outline-dark border-secondary py-0 overflow-hidden" action="{{ route($action, [$data]) }}" method="post">
    @csrf
    @method('DELETE')

    <button 
        type="submit"
        style="color: inherit"
        class="btn p-0 {{ $style }}">
        @if (isset($icon))
            <i class="{{ $icon }}"></i>
        @else
            {{ $title }}
        @endif
    </button>
</form>

