@if($errors->all())
    @foreach($errors->all() as $erro)
        <x-message color="orange">
            {{$erro}}
        </x-message>
    @endforeach
@endif

@if(session()->exists('message'))
    <x-message color="{{ session()->get('color') }}">
        {{ session()->get('message') }}
    </x-message>
@endif
