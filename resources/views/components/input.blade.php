<div id="{{ $id }}" class="input relative">
    @if(Route::currentRouteName() == 'home')
        <label class="px-1" for="{{ $inputId }}">Select By {{ $inputId }}</label>
    @endif

    <input id="{{ $inputId }}" name="{{ $inputId }}" class="border my-1  cursor-pointer border-slate-300 rounded w-full px-3 py-2" type="text" placeholder="{{ $placeholder }}" style="caret-color:transparent;" readonly>

    <div id="drop-down" class="bg-white">
        <input class="border border-slate-300 w-full mt-1 px-3 " type="text">
        <div class="h-[150px] overflow-y-scroll flex flex-col items-start">
            @foreach ($options as $option)
                <button type="button" name="{{ $inputId }}" class="hover:bg-blue-950 hover:text-white w-full text-left py-3 px-1">
                    {{ $option }}
                </button>
            @endforeach
        </div>
    </div>
</div>
