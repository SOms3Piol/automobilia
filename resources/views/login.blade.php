<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite('resources/css/app.css')
    <title>Laravel</title>

</head>
<body>

    <header class="flex container items-center justify-between px-3 py-8 mx-auto" >
        <a href="{{ route('home') }}" class="hover:underline" >Home</a>
        <a href="{{ route('home') }}"  >
            <img width="155px" height="155px" src="https://automobiliard.com/user/resources/images/AMnav.png" alt=" imgage logo">
        </a>
        <a href="{{ route('register') }}" class="hover:underline" >Register</a>
    </header>

    <section class="h-screen w-full bg-slate-200 flex justify-center items-center" >
         <form action="{{ route('user.auth') }}" method="post"  class="bg-white py-8 px-3 rounded-xl basis-128 flex flex-col gap-5 text-slate-600 shadow-2xl " >
            @csrf   
         <h2 class="text-2xl font-semibold text-center" >Log In</h2>   
         @error('login')
             <span class="my-6 text-red-500 font-medium">{{ $message }}</span>
         @enderror
         <div class="flex flex-col gap-3" >
                <label for="email">Email</label>
                <input class=" px-3 py-2 rounded border outline-none border-slate-500 focus:border-blue-700" name="email" type="email" placeholder="Email">
                @error('email')
                    <span class="my-6 text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-3" >
                <label for="password">Password</label>
                <input class=" px-3 py-2 rounded border outline-none border-slate-500 focus:border-blue-700" name="password" type="password" placeholder="Password">
                @error('password')
                    <span class="my-6 text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="hover:bg-blue-700 border-none outline-none px-5 py-2 rounded-xl text-white font-semibold cursor-pointer bg-blue-500 transition" >Sign In</button>
         </form>
    </section>

</body>
</html>