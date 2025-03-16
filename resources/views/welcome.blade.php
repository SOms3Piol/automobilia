<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script defer src="https://kit.fontawesome.com/00e77377ee.js" crossorigin="anonymous"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body>
        <x-navbar></x-navbar>

         <!-- Hero Section-->
         <section class="relative bg-[url('https://automobiliard.com/user/resources/images/b5.jpg')] bg-no-repeat bg-cover py-18 w-full">
            <div class="absolute inset-0 bg-gradient-to-b from-[rgba(20,32,50,0.7)] to-[rgba(20,32,50,0.7)] z-10"></div>
            <div class="relative container grid grid-cols-2 max-md:grid-cols-1 max-md:py-6 max-md:px-3 gap-8 mx-auto z-10 items-center h-full">
                <div class="text-white">
                    <h2 class="text-5xl font-bold mb-2">Your Trusted Auto Marketplace in the Dominican Republic.</h2>
                    <h3 class="text-xl">At Automobilia we have revolutionized the car buying and selling experience say goodbye to the hassle of traditional car transactions</h3>
                </div>
                <form action="" class="bg-white px-2 py-5 flex flex-col gap-5 rounded border-11 border-slate-400">
                    <div class="flex justify-between items-center text-xl font-medium">
                        <label for="all" class="w-full text-center py-3 cursor-pointer ">
                            All
                            <input class="peer hidden" type="radio" name="type" id="all">
                            <span class="block w-full border-b border-gray-300 peer-checked:border-red-400"></span>
                        </label>
                        <label for="new" class="w-full text-center py-3 cursor-pointer">
                            New
                            <input class="peer hidden" type="radio" name="type" id="new">
                            <span class="block w-full border-b border-gray-300 peer-checked:border-red-400 "></span>
                        </label>
                        <label for="used" class="w-full text-center py-3 cursor-pointer">
                            Used
                            <input class="peer hidden" type="radio" name="type" id="used">
                            <span class="block w-full border-b border-gray-300 peer-checked:border-red-400 "></span>
                        </label>
                    </div>

                    @php
                        $carMakes = ['Ford', 'Mustang', 'Honda'];
                        $carModel = ['GT' , 'V4' , 'Civic'];
                        $carYear = ['2005' , '2004' , '2007']
                    @endphp

                    <x-input 
                        :id="1" 
                        :inputId="'make'" 
                        :placeholder="'Make'" 
                        :options="$carMakes" 
                    />
                    <x-input 
                        :id="2" 
                        :inputId="'model'" 
                        :placeholder="'Model'" 
                        :options="$carModel" 
                    />
                    <x-input 
                        :id="3" 
                        :inputId="'year'" 
                        :placeholder="'Year'" 
                        :options="$carYear" 
                    />




                    <button type="submit" class="bg-blue-700 border-none outline-none cursor-pointer w-full py-3 text-white text-xl mt-3 rounded" >Search</button>
                </form>
            </div>
    
                <img class="absolute -bottom-20 z-10 -translate-x-[50%] left-1/2" src="https://automobiliard.com/user/resources/images/Frame.svg" alt="">
        </section>



        <!-- About Section -->

        <section class="container mx-auto py-20 text-center">
            <h2 class="text-black font-bold text-3xl">Easy Car Buying and Selling—Just 3 Steps!</h2>
            <p class="text-slate-700">Car selling and buying has never been simpler until Automobilia came. Our platform enables you to buy cars in the Dominican Republic and find vehicles for sale without the hassle of unnecessary paperwork. Whether you’re in Santo Domingo or anywhere else, Automobilia makes the process easy and stress-free.</p>
            <div class="grid grid-cols-3 gap-15 sm:max-md:grid-cols-2 max-sm:grid-cols-1">
                <div  class="text-center flex flex-col justify-center">
                    <img src="https://automobiliard.com/user/resources/images/girl-doing-online-payment%201.png" alt="">
                    <h3 class="text-2xl font-bold">Contact Trusted Dealers</h3>
                    <p class="text-slate-700">We connect you to reputable auto dealers in Santo Domingo and across the country for all types of vehicle sales. </p>
                </div>
                <div  class="text-center flex flex-col justify-center">
                    <img src="https://automobiliard.com/user/resources/images/jumping%202.png" alt="paerson is enjouing and happy">
                    <h3 class="text-2xl font-bold">Find the Best Deals</h3>
                    <p class="text-slate-700">Discover the best deals on affordable cars in the Dominican Republic and find quality vehicles for sale at the best prices. </p>
                </div>
                <div class="text-center flex flex-col justify-center">
                    <img class="text-center" src="https://automobiliard.com/user/resources/images/lady-driving-car%202.png" alt="paerson is enjouing and happy">
                    <h3 class="text-2xl font-bold">Find the Best Deals</h3>
                    <p class="text-slate-700">Discover the best deals on affordable cars in the Dominican Republic and find quality vehicles for sale at the best prices. </p>
                </div>
            </div>

        </section>


        <!-- Our Dealers and Buyers  -->


        <section class="bg-blue-600 md:h-[800px] flex flex-col items-center py-8 " >
            <h2 class="text-white text-3xl font-bold" >Our Buyers & Dealers</h2>
            <div class="grid max-md:px-3 py-8 md:grid-cols-2  gap-15 container mx-auto items-start mt-8">
                <div class="bg-white rounded px-3 py-3" >
                    <div>
                    <img src="https://automobiliard.com/user/resources/images/dealership.webp" alt="dealing">
                    </div>
                    <h3 class="text-2xl font-semibold" >For Dealers</h3>
                    <p id="half-1">
                    Automobilia is committed to empowering auto dealers in the Dominican Republic. We offer CRM solutions to manage and maintain your inventory with ease, helping you stay on top of the market. Automobilia provides insigh....
                    </p>
                    <p id="full-1" class="hidden"  >
                    Automobilia is committed to empowering auto dealers in the Dominican Republic. We offer CRM solutions to manage and maintain your inventory with ease, helping you stay on top of the market. Automobilia provides insights into market trends, vehicle valuations, and optimal car selling practices. Our platform streamlines operations, enhances customer engagement, and improves overall efficiency. With real-time data and AI-driven analytics, we help you make smarter business decisions. Connect with us to maximize your dealership’s potential and stay ahead in the competitive automotive industry! 
                    </p>
                    <button id="btn-1" onclick="handleFir()" class="bg-pink-500 px-3 py-2 font-semibold   text-white rounded mt-3">Read More</button>
                </div>
                <div class="bg-white rounded px-3 py-3" >
                    <div>
                    <img src="https://automobiliard.com/user/resources/images/buyer.webp" alt="byig">
                    </div>
                    <h3 class="text-2xl font-semibold" >For Buyers</h3>
                    <p id="half-2">
                    search the best car deals and cheap cars for sale with Automobilia. We link you with verified auto dealers who are ready to provide you with the best quality, low-cost cars, ultimately making this experience less pain....
                    </p>
                    <p id="full-2" class="hidden">
                    Search the best car deals and cheap cars for sale with Automobilia. We link you with verified auto dealers who are ready to provide you with the best quality, low-cost cars, ultimately making this experience less painful. Being one of the most credible car dealerships in Santo Domingo, we help you in searching for cars for sale in the Dominican Republic that suit your budget and requirements. Automobilia helps you buy your dream car with ease and confidence. 
                    </p>
                    <button id="btn-2" onclick="handleSec() " class="bg-pink-500 px-3 py-2 font-semibold  text-white rounded mt-3">Read More</button>
                </div>
            </div>
        </section>


        <section class="container mx-auto my-10">
            <h2 class="text-3xl" > 
                Browse
                <span class="text-3xl font-bold" >Old & New</span> 
                Cars           
            </h2>
            <div class="flex justify-between items-center px-8 py-5 bg-slate-200 rounded-xl my-10">
                <h3 class="text-xl font-semibold" >Select By Make</h3>
                <div class="bg-slate-300 flex rounded overflow-hidden ">
                    <button class="w-full focus:bg-pink-400 focus:text-white px-13 py-3 text-slate-600" >Used</button>
                    <button class="w-full focus:bg-pink-400 focus:text-white px-13 py-3 text-slate-600 " >New</button>
                </div>
            </div>

            <div class="grid md:grid-cols-6 sm:grid-cols-3 grid-cols-1 max-sm:px-3 py-6 gap-8">
                <div class="flex items-center px-4 py-2 gap-3 border group hover:border-blue-700 transition cursor-pointer">
                    <img src="https://automobiliard.com/user/resources/images/Chevrolet.png" alt="">
                    <p class="group-hover:text-blue-700 transition">Cheverolte</p>
                </div>
            </div>
        </section>


        <!-- footer -->

        <x-footer></x-footer>
    </body>



    <script>
        
    let firShow = false;
function handleFir() {
    if (!firShow) {
        document.getElementById('half-1').style.display = 'none';
        document.getElementById('full-1').style.display = 'block';
        document.getElementById('btn-1').textContent = "Read Less";
        firShow = true;
    } else {
        document.getElementById('half-1').style.display = 'block';
        document.getElementById('full-1').style.display = 'none';
        document.getElementById('btn-1').textContent = "Read More";
        firShow = false;
    }
}

let secShow = false;
function handleSec() {
    if (!secShow) {
        document.getElementById('half-2').style.display = 'none';
        document.getElementById('full-2').style.display = 'block';
        document.getElementById('btn-2').textContent = "Read Less";
        secShow = true;
    } else {
        document.getElementById('half-2').style.display = 'block';
        document.getElementById('full-2').style.display = 'none';
        document.getElementById('btn-2').textContent = "Read More";
        secShow = false;
    }
}
    </script>


</html>
c