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
    </head>
    <body>
        <header class=" py-8 bg-[#f7f9faff] sticky top-0">
            <nav class="container mx-auto flex justify-between items-center">
                <div class="md:w-[350px]">
                    <img src="https://automobiliard.com/user/resources/images/AMnav.png" alt="compnay logo" class="object-fit ">
                </div>
                <div class="flex gap-8 text-xl text-blue-700 font-medium max-[850px]:hidden">
                    <a href="{{ route('home') }}">Home</a>
                    <select name="nav-option" id="nav-opt" class="w-fit">
                        <option value="cars" selected class="w-fit px-8">Buy</option>
                        <option value="used">Used Cars</option>
                        <option value="new">New Cars</option>
                        <option value="sports">Sports Cars</option>
                    </select>
                    <a href="{{ route('home') }}">Search</a>
                </div>
                <div class="flex gap-3 text-blue-700 font-medium text-xl max-[850px]:hidden ">
                    <a href="{{ route('login') }}">Login</a>
                    <span class="bg-blue-700 px-[1px]"></span>
                    <a href="{{ route('register') }}">Register</a>
                </div>

                    <button class="md:hidden">
                        <i class="fa-solid fa-bars "></i>
                    </button>
               
            </nav>
        </header>

         <!-- Hero Section-->
         <section class="relative bg-[url('https://automobiliard.com/user/resources/images/b5.jpg')] bg-no-repeat bg-cover h-screen w-full">
            <div class="absolute inset-0 bg-gradient-to-b from-[rgba(20,32,50,0.7)] to-[rgba(20,32,50,0.7)] z-10"></div>
            <div class="relative container grid grid-cols-2 gap-8 mx-auto z-10 items-center h-full">
                <div class="text-white">
                    <h2>Your Trusted Auto Marketplace in the Dominican Republic.</h2>
                    <h3>At Automobilia we have revolutionized the car buying and selling experience say goodbye to the hassle of traditional car transactions</h3>
                </div>
                <form action="" class="bg-white px-2 py-5">
                    <div class="flex justify-between items-center text-xl font-medium">
                        <label for="all" class="w-full text-center py-3 cursor-pointer ">
                            All
                            <input class="peer hidden" type="radio" name="type" id="all">
                            <span class="block w-full border-b border-gray-300 peer-checked:border-red-400 peer-checked:border-b-2"></span>
                        </label>
                        <label for="new" class="w-full text-center py-3 cursor-pointer">
                            New
                            <input class="peer hidden" type="radio" name="type" id="new">
                            <span class="block w-full border-b border-gray-300 peer-checked:border-red-400 peer-checked:border-b-2"></span>
                        </label>
                        <label for="used" class="w-full text-center py-3 cursor-pointer">
                            Used
                            <input class="peer hidden" type="radio" name="type" id="used">
                            <span class="block w-full border-b border-gray-300 peer-checked:border-red-400 peer-checked:border-b-2"></span>
                        </label>
                    </div>



                    
                </form>
            </div>
        </section>



    </body>
</html>
