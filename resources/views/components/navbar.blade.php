<header class=" py-8 bg-[#f7f9faff] sticky top-0 z-20">
            <nav class="container mx-auto flex justify-between items-center">
                <div class="md:w-[350px]">
                    <img src="https://automobiliard.com/user/resources/images/AMnav.png" alt="compnay logo" class="object-fit ">
                </div>
                <div class="flex gap-8 text-xl text-blue-700 font-medium max-[850px]:hidden">
                    <a href="{{ route('home') }}">Home</a>
                    <div name="nav-option" id="nav-opt" class="w-fit relative group ">
                        <button value="cars" selected class=" peer w-fit px-8 cursor-pointer">Buy</button>
                        <div class="hidden group-hover:flex group-hover:flex-col group-hover:gap-3 absolute top-9 px-10   py-2 rounded border-t shadow-xl   bg-white transition">
                            <a href="/search?category=used" value="used" class="whitespace-nowrap" >Used Cars</a>
                            <a href="/search?category=new" value="new">New Cars</a>
                            
                        </div>
                        
                    </div>
                    <a href="{{ route('vehicles') }}">Search</a>
                </div>
                @if (Auth::check())
                <div class="flex  justify-between  " >
                        <a href="{{ route('user.dashboard') }}" class=" cursor-pointer  ml-auto" >
                            <img class="mix-blend-multiply" width="49px" src="https://automobiliard.com/user/resources/images/d-avatar.jpg" alt="avatar user picture">
                        </a>
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