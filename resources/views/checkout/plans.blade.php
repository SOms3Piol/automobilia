<x-dashboard-layout>

    <div class="grid grid-cols-3 px-8 py-3 gap-3" >
        @foreach($plans as $plan)
        <div class="flex flex-col justify-between bg-white px-3 py-8 rounded-md border border-slate-300 h-[350px] text-center items-center {{ $plan->id == 1 || ($plan->id !== $purchased->plan_id) ? "" : "shadow-xl" }} " >
            <div>
                <h2 class="text-3xl font-semibold" >{{ $plan->title }}</h2>
            </div>
            <div class='text-3xl' >
                {{ $plan->price }} $
            </div>
            <div>
                <p>Plan includes.</p>
                <p>{{ $plan->allowed_ads }} Ads</p>
            </div>

            @if ($plan->id != $purchased->plan_id)
                <form action="{{ route('checkout.session' , $plan->id) }}">
                    <button type="submit" class="bg-pink-500 font-semibold rounded text-white px-3 py-1 cursor-pointer " >Buy Now</button>
                </form>
            
            @else
                <form action="{{ route('unsubscribe' ) }}">
                    <button type="submit" class=" cursor-pointer font-semibold  px-3 py-1 underline  " >Cancel Plan</button>
                </form>
            @endif
            
        </div>
        @endforeach
    </div>

</x-dashboard-layout>