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
    
        <section class="bg-[#f7f9faff] py-18 min-h-screen " >
            <div class="container mx-auto" >
                <h2 class="text-4xl font-semibold" >used cars for sale</h2>
                <div class="flex items-center gap-1 mt-3 " >
                    <span class="text-blue-700" >Home </span>
                    / 
                    <span class="text-slate-600" >Search</span>
                </div>
                <p class="mt-3 text-zinc-700 text-2xl" >Total cars found: 3</p>
            </div>


            <div class=" grid grid-cols-4 gap-4 container mx-auto " >
                <div class=" " >
                    <form class="bg-white p-3 rounded-md flex flex-col gap-4" >
                        <div class="flex rounded overflow-hidden " >
                            <button class="w-full focus:bg-pink-600 focus:text-white  bg-slate-200 p-3 ">Used</button>
                            <button class="w-full focus:bg-pink-600 focus:text-white bg-slate-200 p-3">New</button>
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
                            :inputId="'Model'" 
                            :placeholder="'Select Model'" 
                            :options="$carModel" 
                        />
                        <x-input 
                            :id="3" 
                            :inputId="'Year'" 
                            :placeholder="'Select Year'" 
                            :options="$carYear" 
                        />
                        <button class="bg-blue-700 rounded text-white py-3" >Search</button>
                    </form>
                </div>
                <div class=" col-span-3  " >
                    <div class="bg-white px-2 py-3 rounded-md" >
                        <div class="flex items-center gap-5 flex-wrap" >
                            <button class="bg-pink-600 px-3 rounded-md py-2 text-white flex items-center w-fit gap-1" >Used Cars  
                                <i class="fa-solid fa-circle-xmark"></i>  
                            </button>
                        </div>
                        <a class="mt-2 block text-blue-700" href="{{ route('vehicles') }}">clear filters</a>
                    </div>


                    <div class="rounded-md bg-white mt-8 " >
                        <div class=" h-[500px]" >
                            <img class="object-cover w-full h-full" src="https://automobiliard.com/user/resources/images/Nodata.png" alt="">
                        </div>
                        
                    </div>
                </div>
            </div>

        </section>


    <x-footer></x-footer>
</body>
</html>