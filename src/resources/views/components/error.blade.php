@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-red-600 text-sm font-bold">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif