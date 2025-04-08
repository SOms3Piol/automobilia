<x-dashboard-layout>
    @if (!$vehicles || $vehicles->isEmpty())
        <p>No Vehicles are Published...</p>
    @else
        @foreach ($vehicles as $vehicle)
            <div class="grid grid-cols-2 max-md:grid-cols-1 gap-3 px-3 py-5">
                <div class="card bg-white shadow-md rounded-md px-3 py-2">
                    <div class="bg-zinc-800 h-[350px] rounded overflow-hidden">
                        <img class="object-fit shadow w-full h-full object-center rounded-sm" 
                             src="{{ asset( 'storage/' . $vehicle->thumbnail) }}" 
                             alt="Vehicle Thumbnail">
                    </div>
                    <div class="mt-3">
                        <h2 class="text-2xl">{{ $vehicle->title }}</h2>
                    </div>
                    <div class="grid grid-cols-2 mt-3 text-slate-500">
                        <span><i class="fas fa-tachometer-alt"></i> {{ $vehicle->mileage }}</span>
                        <span class="text-right"><i class="fas fa-map-marker-alt"></i> {{ $vehicle->location }}</span>
                        <span><i class="fas fa-car-side"></i> {{ $vehicle->make }}</span>
                        <span class="text-right"><i class="fas fa-car-side"></i> {{ $vehicle->modal }}</span>
                    </div>
                    <div>
                        <h2 class="text-3xl text-pink-500 font-bold my-3">USD$ {{ $vehicle->price }}</h2>
                    </div>
                    <div class="flex gap-3 mt-3">


                        <a class="bg-green-700 rounded font-semibold block w-full py-3 text-center text-white" 
                           href="{{ route('vehicle.edit', $vehicle) }}">Edit</a>
                        <form class="block w-full" action="{{ route('vehicle.destroy', $vehicle) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-700 rounded font-semibold cursor-pointer py-3 text-white w-full" 
                                    type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</x-dashboard-layout>