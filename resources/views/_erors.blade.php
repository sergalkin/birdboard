@if ($errors->any())
    <div class="field mt-6">
        @if($errors->any)
            @foreach($errors->all() as $error)
                <li class="text-sm text-red">{{ $error }}</li>
            @endforeach
        @endif
    </div>
@endif