<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    
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
            <a id="dashboard" href="#" class="focus:text-blue-700 transition all "> <i class="fa-solid fa-layer-group mr-2 "></i> Dashboard</a>
            <a id="manage_ads" href="#" class="focus:text-blue-700 transition all " > <i class="fa-solid fa-rectangle-ad mr-2"></i> Manage Ads</a>
            <a id="manage_cars" href="#" class="focus:text-blue-700 transition all " > <i class="fa-solid fa-car mr-2"></i> Manages Vehicles</a>
            <a id="chats" href="#" class="focus:text-blue-700 transition all " > <i class="fa-brands fa-rocketchat mr-2"></i> chats</a>
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
                        <span>username</span>
                        <span>email@test.com</span>
                    </div>
                </div>
                <a href="{{ route('user.setting') }}">Profile Setting</a>
                <a href="{{ route('user.logout') }}">Logout</a>
            </div>

        </div>

        <div class="flex max-sm:flex-col mt-3 justify-center  gap-8 items-start px-5  " >
            <div class="bg-white max-sm:w-full flex-2/3  sm:mt-8 py-8 rounded-md shadow-xl px-7 " >
                <div>
                    <i class="fa-solid fa-rectangle-ad mr-2"></i> <a href="#" class="underline" >All</a>      
                </div>
                <div class="flex justify-between mt-8" >
                    <div>
                        <p>Total Ads</p>
                         <p>0</p>
                    </div>
                    <div>
                        <p>Active Ads</p>
                        <p>0</p>
                    </div>
                </div>
            </div>
            <div class=" flex-2/2 max-sm:w-full bg-white  sm:mt-8 rounded-md shadow-xl py-8 px-7 " >
                <h2 class="font-semibold" > <i class="fa-solid fa-user"></i> &MediumSpace;  Profile Analysis</h2>
                <div class="flex justify-between mt-8" >
                    <div>
                        <p>Total Views</p>
                        <span>0</span>
                    </div>
                    <div>
                        <p>Total Likes</p>
                        <span>0</span>
                    </div>
                    <div>
                        <p>Total Reviews</p>
                        <span>0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-5  h-full py-3  bg-white shadow-xl rounded-md my-3 mt-8 mx-5">
            <h2 class="text-xl font-semibold mt-2" >Latest Reviews.</h2>
            <div class="review-card border border-slate-500 rounded bg-white 
            shadow-md mt-3 py-3"  >
                <div class="flex items-center text-xl font-semibold gap-3" >
                     <span><img width="55px" height="55px" src="https://automobiliard.com/user/resources/images/d-avatar.jpg" alt="">
                    </span> 
                    <span>username</span>
                </div>
                <p class="ml-3" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus dolor laudantium rerum corrupti animi dolorum? Magni distinctio quam praesentium sit maxime dolorum rerum expedita, beatae neque optio culpa quod eum at dolore molestiae.</p>
            </div>
        </div>
    </section>   



    <script>
        const sidebar = document.getElementById('sidebar');
        const dialogBox = document.getElementById('user-dialog');
        let active = false;
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