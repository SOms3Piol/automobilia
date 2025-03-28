<header class=" py-8 bg-[#f7f9faff] sticky top-0 z-20">
            <nav class="container mx-auto flex justify-between items-center">
                <div class="md:w-[350px]">
                    <img src="https://automobiliard.com/user/resources/images/AMnav.png" alt="compnay logo" class="object-fit ">
                </div>
                <div class="flex gap-8 text-xl text-blue-700 font-medium max-[850px]:hidden">
                    <a href="{{ route('home') }}">Home</a>
                    <div name="nav-option" id="nav-opt" class="w-fit relative group ">
                        <a value="cars" selected class="w-fit px-8 cursor-pointer">Buy</a>
                        <div class="hidden absolute top-6.5 px-10   py-2 rounded border-t shadow-xl hover:block group-hover:block bg-white transition">
                            <a value="used" class="whitespace-nowrap" >Used Cars</a>
                            <a value="new">New Cars</a>
                            <a value="sports">Sports Cars</a>
                        </div>
                        
                    </div>
                    <a href="{{ route('home') }}">Search</a>
                </div>
                @if (Auth::check())
                    <div class="flex gap-3 text-blue-700 font-medium text-xl max-[850px]:hidden ">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="cursor-pointer" type="submit">logout</button>
                        </form>
                    </div>
               
                @else
                    <div class="flex gap-3 text-blue-700 font-medium text-xl max-[850px]:hidden ">
                        <a href="{{ route('login') }}">Login</a>
                        <span class="bg-blue-700 px-[1px]"></span>
                        <a href="{{ route('register') }}">Register</a>
                    </div>
                @endif
                    <button class="md:hidden">
                        <i class="fa-solid fa-bars "></i>
                    </button>
               
            </nav>
        </header>