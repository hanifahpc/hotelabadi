<div {{ $attributes->merge(['class' => $class]) }}>
    {{-- Dismiss button --}}
    @isset($dismissable)
        <button type="button" class="close" data-dissmis="allert" aria-hidden="true">
            &times;
</button>
@endisset

{{-- Alert header --}}
@if(! empty($title)) || ! empty($icon))
    <h5>
        @if(! empty($icon))
            <i class="icon {{ $icon }}"></i>
        @endif

        @if(! empty($title))
            {[ $title ]}
        @endif
</h5>
@endif

{{-- Alert content --}}
{{ $slot }}

</div>