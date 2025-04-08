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
    
        <section class="bg-[#f7f9faff] py-18  " >
            <div class="container mx-auto" >
                <h2 class="text-4xl font-semibold" >{{ !empty($queryParams['category']) ?  $queryParams['category']  : "All" }} Cars</h2>
                <div class="flex items-center gap-1 mt-3 " >
                    <span class="text-blue-700" >Home </span>
                    / 
                    <span class="text-slate-600" >Search</span>
                </div>
                <p class="mt-3 text-zinc-700 text-2xl" >Total cars found: {{ $total }}</p>
            </div>


            <div class=" grid grid-cols-4 gap-4 container items-start mx-auto h-full " >
                <div class=" " >
                    <form action="{{ route('search.vehicle') }}  " method="get" class="bg-white p-3 rounded-md flex flex-col gap-4" >
                    <div class="flex text-left rounded overflow-hidden " >
                            <input type="radio" name="category" value="used" class="w-full focus:bg-pink-600 focus:text-white  bg-slate-200 p-3 "> Used 
                            <input type="radio" name="category" value="new" class="w-full focus:bg-pink-600 focus:text-white bg-slate-200 p-3">New
                        </div>
                        @php
                            $carMakes = ['Ford' , 'Mustang' , 'Honda'];
                            $carModel = ['Gt' , 'V4' , 'CIVIC'];
                            $carYear = ['2005' , '2004' , '2007'];
                        @endphp
                        <x-input 
                            :id="1" 
                            :inputId="'make'" 
                            :placeholder="'Select Make'" 
                            :options="$carMakes" 
                        />
                        <x-input 
                            :id="2" 
                            :inputId="'modal'" 
                            :placeholder="'Select Model'" 
                            :options="$carModel" 
                        />
                        <x-input 
                            :id="3" 
                            :inputId="'year'" 
                            :placeholder="'Select Year'" 
                            :options="$carYear" 
                        />
                        <button type="submit" class="bg-blue-700 rounded text-white py-3" >Search</button>
                    </form>
                </div>
                <div class=" col-span-3   " >
                    <div class="bg-white px-2 py-3 rounded-md" >
                        <div class="flex items-center gap-5 flex-wrap" >
                            @foreach ($queryParams as $key => $value )
                                
                            @if(!empty($value))
                                <button type="button"  id="{{ $key }}" class=" button   bg-pink-600 px-3 rounded-md py-2 text-white flex items-center w-fit gap-1" >{{ $value }} 
                                    <i class="fa-solid fa-circle-xmark"></i>  
                                </button>
                            @endif
                            @endforeach
                        </div>
                        <a class="mt-2 block text-blue-700" href="{{ route('vehicles') }}">clear filters</a>
                    </div>

                    
                    @if ($total == 0)
                    
                        <div class="rounded-md  bg-white mt-8  top-0 w-full h-full  " >
                            <div class="h-full flex justify-center" >
                                <img width="500px" height="500px" src="https://automobiliard.com/user/resources/images/Nodata.png" alt="">
                            </div>
                            
                        </div>
                    @else
                    <div class="grid grid-cols-3 relative w-full h-full mt-7" >
                        @foreach ($vehicles as $vehicle )
                            <div class="card bg-white shadow-md rounded-md px-3 py-2">
                                <div class="bg-zinc-800 h-[350px] rounded overflow-hidden">
                                    <a href="{{ route('vehicle.show',$vehicle->id) }}">
                                    <img class="object-fit shadow w-full h-full object-center rounded-sm" 
                                        src="{{ asset( 'storage/' . $vehicle->thumbnail) }}" 
                                        alt="Vehicle Thumbnail">
                                    </a>
                                </div>
                                <div class="mt-3">
                                    <h2 class="text-2xl">{{ $vehicle->title }}</h2>
                                </div>
                                <div class="grid grid-cols-2 mt-3 text-slate-500">
                                    <span><i class="fas fa-tachometer-alt"></i> {{ $vehicle->mileage }}</span>
                                    <span class="text-right"><i class="fas fa-map-marker-alt"></i> {{ $vehicle->year }}</span>
                                    <span><i class="fas fa-car-side"></i> {{ $vehicle->make }}</span>
                                    <span class="text-right"><i class="fas fa-car-side"></i> {{ $vehicle->modal }}</span>
                                </div>
                                <div>
                                    <h2 class="text-3xl text-pink-500 font-bold my-3">USD$ {{ $vehicle->price }}</h2>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @endif
                    

                    
                </div>
            </div>

        </section>

       


    <x-footer></x-footer>

    
</body>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const filters = document.querySelectorAll('.button')
            filters.forEach(button => {
                button.addEventListener('click' , (e)=>{
                    let url = new URL(window.location.href)
               
                    var search_params = url.searchParams;

// new value of "id" is set to "101"
                    search_params.set(e.target.id, "");

                    // change the search property of the main url
                    url.search = search_params.toString();

                    // the new url string
                    var new_url = url.toString();

                    // output : http://demourl.com/path?id=101&topic=main
                    window.location.href = new_url
                })
            })
        })
    </script>
</html> 