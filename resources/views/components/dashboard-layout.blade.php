<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script defer src="https://kit.fontawesome.com/00e77377ee.js" crossorigin="anonymous"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  
    <title>Laravel</title>
    <style>
        *{
            box-sizing: border-box;
        }
    </style>
</head>
<body class="flex  " >
    
    <aside id="sidebar" class="sidebar fixed max-[850px]:-left-[330px] z-10 bg-white w-fit  transition all duration-200 border-r border-slate-300 h-screen  "> 
        <div class="flex items-center gap-3 bg-[#fafcff] px-3 py-5 w-[255px] border-b border-slate-300 " >
            <a href="{{ route('home') }}"><img class="object-fit w-full h-full " src="https://automobiliard.com/user/resources/images/AMnav.png" alt=""></a>
            <button onclick="closeSidebar()" class="cursor-pointer min-[850px]:hidden" ><i class="fa-solid fa-xmark border px-0.5 rounded-full"></i></button>
        </div>
        <div class="flex flex-col gap-5 px-3 mt-8" >
            <a id="dashboard" href="{{ route('user.dashboard')}}" class=" transition all {{ request()->routeIs('user.dashboard') ? 'text-blue-700' : "" }} "> <i class="fa-solid fa-layer-group mr-2 "></i> Dashboard</a>
            <div >
                 <a  href="{{ route('dealer.ads') }}" class="focus:text-blue-700 transition all cursor-pointer {{ request()->routeIs('dealer.ads') ? 'text-blue-700' : "" }} " >
                    <i class="fa-solid fa-rectangle-ad mr-2"></i> 
                    Manage Ads
                 </a>

            </div>
            <div>
                 <button onclick="handleClick(event)" id="manage_cars"  class=" focus:text-blue-700 transition all  {{ request()->routeIs('vehicle.create') || request()->routeIs('vehicle.index') ? "text-blue-700" : "" }} " >
                    <i class="fa-solid fa-car mr-2"></i> 
                    Manage Vehicle
                 </button>
                 <div id="car-opt" class=" hidden  flex-col gap-3 items-start px-7 py-2" >
                     <a class=" {{ request()->routeIs('vehicle.create') ? "text-blue-700" : "" }}" href="{{ route('vehicle.create') }}" >Publish Car</a>
                     <a class=" {{ request()->routeIs('vehicle.index') ? "text-blue-700" : "" }}" href="{{ route('vehicle.index') }}">All Cars</a>
                 </div>
            </div>
            <a id="chats" href="{{route('chat.index')}}" class=" {{ request()->routeIs('vehicle.index') ? "text-blue-700" : "" }}"> <i class="fa-brands fa-rocketchat mr-2"></i> chats</a>
            <a href= '{{ route('plans.index') }}  ' class="{{ request()->routeIs('plans.index') ? 'text-blue-700' : "" }}" >Plans</a>
       
        </div>
    </aside>
    
    <section class=" flex flex-col bg-[#ebecee]  min-[850px]:ml-[255px] w-full  min-h-screen transition all " >
        <div class="flex  justify-between px-6 bg-white shadow-sm " >
            <button onclick="openSidebar()" class=" cursor-pointer min-[850px]:hidden  text-blue-700 text-xl" >
                <i class="fa-solid fa-bars"></i>
            </button>
            <button onclick="toggleDialog()" class=" cursor-pointer py-2 ml-auto" >
                <img width="49px" src="https://automobiliard.com/user/resources/images/d-avatar.jpg" alt="avatar user picture">
            </button>
            <div id="user-dialog" class=" hidden flex-col justify-start gap-2 absolute top-18 right-8 bg-white shadow-md px-8 py-3 rounded-md " >
                <div class="flex items-center bg-white" >
                    <img width="50px" src="https://automobiliard.com/user/resources/images/d-avatar.jpg" alt="avatar user picture">
                    <div class="flex flex-col px-3" >
                        <span>{{ request()->user()->name  }}</span>
                        <span>{{ request()->user()->email  }}</span>
                    </div>
                </div>
                <a href="{{ route('user.setting') }}">Profile Setting</a>
                <form action="{{ route('user.logout') }}" method="post">
                    @csrf
                    <button>Logout</button>
                </form>
            </div>

        </div>

        {{ $slot }}
    </section>




   


    <script>
        const sidebar = document.getElementById('sidebar');
        const dialogBox = document.getElementById('user-dialog');
        const car_opt =document.getElementById('car-opt');
        let active = false;
        let car_menu = false;


        function handleClick(event){
        
            car_menu = !car_menu;
            car_opt.classList.toggle('hidden', !car_menu);
            car_opt.classList.toggle('flex', car_menu);
    
        }


        function toggleDialog(){    
            console.log('clicked')
            if(!active){
                dialogBox.classList.add('flex');
                dialogBox.classList.remove('hidden')
                active = true;
            }
            else{
                dialogBox.classList.remove('flex');
                dialogBox.classList.add('hidden')
                active = false;
            }
        }
    
        let isSidebarActive = false;
        function openSidebar(){
            if(!isSidebarActive){
                sidebar.style.left = '0'
                isSidebarActive = true;
            }       
        }
        function closeSidebar(){
            if(isSidebarActive){
                sidebar.style.left = '-300px';
                isSidebarActive = false
            }
        }

        window.addEventListener('resize' , (e)=>{
            if(window.innerWidth > 850){
                sidebar.style.left = '0'
            }
            else{
                sidebar.style.left = '-300px'
            }
        })
    </script>

</body>
</html>