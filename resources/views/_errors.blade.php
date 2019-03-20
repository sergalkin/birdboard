@if ($errors->{ $bag ?? 'default' }->any())
    <ul class="field mt-6 list-reset">
        @if($errors->any)
            @foreach($errors->{ $bag ?? 'default' }->all() as $error)
                <li class="text-sm text-red">{{ $error }}</li>
            @endforeach
        @endif
    </ul>
@endif