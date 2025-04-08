<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script defer src="https://kit.fontawesome.com/00e77377ee.js" crossorigin="anonymous"></script>
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Laravel</title>
</head>
<body>

    <x-navbar></x-navbar>
    
        <section class="bg-[#f7f9faff] py-8" >
            <div class="container mx-auto">
                <p class="text-blue-700 text" ><i class="fa-solid fa-arrow-left"></i> Return to search</p>
                <div class="mt-7 flex flex-col gap-8" >
                    <h2 class="text-4xl font-semibold" >{{$vehicle->title}}</h2>
                    <div class="flex gap-3 items-center" >
                        <span class=" bg-slate-300 text-blue-700 rounded-full h-[33px] w-[33px] flex justify-center items-center" ><i class="fa-solid fa-location-dot "></i></span>
                        <p class="text-slate-500 text-xl"  > {{$vehicle->location}}</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-5 my-5">
                    <div class="left-block" >
                        <div class="rounded-md overflow-hidden" >
                            <img src="{{ asset('storage/' . $vehicle->thumbnail)  }}" class="object-fit w-full h-full" alt="">
                        </div>
                        <div class="w-[90px] h-[70px] rounded mt-5 overflow-hidden border-2 border-blue-400" >
                            <img  class="object-fit w-full h-full" src="{{ asset('storage/' . $vehicle->thumbnail)  }}"  alt="">
                        </div>
                        <div class="bg-white px-8 py-5 rounded-md my-5" >
                            <h2 class="text-2xl" >Additional Features</h2>
                            <div class="grid grid-cols-2 justify-between mt-3" >
                                @php
                                    $array = json_decode($vehicle->additional_feature);
                                    foreach($array as $feature){
                                        echo "
                                            <span class='font-thin' ><i class='fa-solid fa-check text-pink-500 '></i> $feature</span>
                                        ";
                                    }
                                @endphp
                                
                                
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 py-5 px-8 bg-white rounded-md" >
                            <h2 class="text-2xl " >Vehicle Overview</h2>
                            <p class="leading-6 text-base text-slate-500 " >{{ $vehicle->description  }}</p>
                        </div>
                    </div>
                    <div class="right-block" >
                        <div class="bg-zinc-800 text-white text-center py-5 rounded-md " >
                            <h2 class="text-3xl font-bold " >USA$ {{ $vehicle->price  }}</h2>
                            <a href="#" class="bg-pink-500 px-3 py-1 text-xl font-semibold rounded block mt-3 w-fit mx-auto" >Chat with Dealer</a>
                        </div>


                        <div class="additional-info px-3 py-5 bg-white mt-5 rounded-md" >
                            <h2 class="text-2xl not-[]:" >Car details</h2>
                            <div class="flex items-center justify-between gap-4 mt-3 " >
                                <div class="bg-[#F7F7F7] text-[#7A7A7A] px-8 py-3 rounded text-base font-semibold" >Manufactured in country</div>
                                <div class="bg-[#FCFCFC] text-[#142032] px-3 py-3 rounded" >{{$vehicle->manufacture_country}}</div>
                            </div>
                            <div class="flex items-center justify-between gap-4 mt-3 " >
                                <div class="bg-[#F7F7F7] text-[#7A7A7A] px-8 py-3 rounded text-base font-semibold" >Mileage</div>
                                <div class="bg-[#FCFCFC] text-[#142032] px-3 py-3 rounded" >{{ $vehicle->mileage }} km</div>
                            </div>
                            <div class="flex items-center justify-between gap-4 mt-3 " >
                                <div class="bg-[#F7F7F7] text-[#7A7A7A] px-8 py-3 rounded text-base font-semibold" >Transmission</div>
                                <div class="bg-[#FCFCFC] text-[#142032] px-3 py-3 rounded" >{{ $vehicle->transmission }}</div>
                            </div>
                            <div class="flex items-center justify-between gap-4 mt-3 " >
                                <div class="bg-[#F7F7F7] text-[#7A7A7A] px-8 py-3 rounded text-base font-semibold" >Exterior Color</div>
                                <div class="bg-[#FCFCFC] text-[#142032] px-3 py-3 rounded" >{{ $vehicle->exterior_color  }}</div>
                            </div>
                            <div class="flex items-center justify-between gap-4 mt-3 " >
                                <div class="bg-[#F7F7F7] text-[#7A7A7A] px-8 py-3 rounded text-base font-semibold" >Interior Color</div>
                                <div class="bg-[#FCFCFC] text-[#142032] px-3 py-3 rounded" >{{ $vehicle->interior_color }}</div>
                            </div>
                            <div class="flex items-center justify-between gap-4 mt-3 " >
                                <div class="bg-[#F7F7F7] text-[#7A7A7A] px-8 py-3 rounded text-base font-semibold" >Engine Capacity</div>
                                <div class="bg-[#FCFCFC] text-[#142032] px-3 py-3 rounded" >{{$vehicle->engine_capacity}}</div>
                            </div>
                            <div class="flex items-center justify-between gap-4 mt-3 " >
                                <div class="bg-[#F7F7F7] text-[#7A7A7A] px-8 py-3 rounded text-base font-semibold" >Engine Type</div>
                                <div class="bg-[#FCFCFC] text-[#142032] px-3 py-3 rounded" >{{ $vehicle->engine_type }}</div>
                            </div>
                            
                        </div>
                        <div class="px-3 py-5 bg-white rounded-md mt-5 flex flex-col gap-5" >
                            <h2 class="text-2xl" >Automotive Avenue</h2>
                            <div class="flex gap-3 items-center" >
                                <span><i class="fa-regular fa-user"></i></span>
                                <a href="#"  class="text-blue-700">{{ $user->name }}</a>
                            </div>
                            <div class="flex items-center gap-3" >
                                <span><i class="fa-solid fa-globe"></i></span>
                                <span class="text-slate-600" >Automoblia</span>
                            </div>
                            <div class="flex items-center gap-3" >
                                <span><i class="fa-solid fa-phone"></i></span>
                                <span class="text-slate-600" >{{ $vehicle->phoneNumber }}</span>
                            </div>
                            <div class="flex items-center gap-3" >
                                <span><i class="fa-solid fa-location-dot"></i></span>
                                <span class="text-slate-600" >{{ $vehicle->location  }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <x-footer></x-footer>


</body>
</html>