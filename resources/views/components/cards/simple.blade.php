<div {{ $attributes->merge(['class' => 'p-2 my-2 bg-white rounded-md']) }}>
    
    @if(isset($header))
        <header>{{ $header }}</header>
    @endif
    
    <div @if($bodyClass) class="{{ $bodyClass }}" @endif>{{ $slot }}</div>
    
    @if(isset($footer))
        <footer>{{ $header }}</footer>
    @endif

</div>
    