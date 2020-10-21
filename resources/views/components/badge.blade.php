
@if(!isset($show) || $show)

    <h6><span class="badge badge-{{ $type ?? 'danger'}}">
        {{ $slot }}
    </span></h6>
    
@endif