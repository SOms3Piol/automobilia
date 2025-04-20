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
        <a href="{{ route('login') }}" class="hover:underline" >Login</a>
    </header>

    <section class="h-full py-8 w-full bg-slate-200 flex justify-center items-center" >
         <form action="{{ route('user.create') }}" method="post"  class="bg-white py-8 px-3 rounded-xl basis-128 flex flex-col gap-5 text-slate-600 shadow-2xl " >
            @csrf  
         <h2 class="text-2xl font-semibold text-center" >Register Account</h2>   
         <div class="flex flex-col gap-3" >
                <label for="email">Name</label>
                <input class=" px-3 py-2 rounded border outline-none border-slate-500 focus:border-blue-700" type="text" name="name" placeholder="username">
                
                    <span class=" text-red-500 font-medium px-3" >
                    @error('name')
                        {{ $message }}
                    @enderror
                    </span>
                
            </div>
            <div class="flex flex-col gap-3" >
                <label for="email">Email</label>
                <input class=" px-3 py-2 rounded border outline-none border-slate-500 focus:border-blue-700" type="email" name="email" placeholder="Email">
                    <span class=" text-red-500 font-medium px-3" >
                    @error('email')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            <div class="flex flex-col gap-3" >
                <label for="phone">Phone Number</label>
                <input class=" px-3 py-2 rounded border outline-none border-slate-500 focus:border-blue-700" type="number" min="0"  maxlength="12" name="phone_number" placeholder="e.g 0312323111">
                    <span class=" text-red-500 font-medium px-3" >
                    @error('phone_number')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            
            <div class="flex flex-col gap-3" >
                <label for="password">Password</label>
                <input class=" px-3 py-2 rounded border outline-none border-slate-500 focus:border-blue-700" type="password" name="password" placeholder="Password">
                    <span class=" text-red-500 font-medium px-3" >
                    @error('password')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            <div class="flex flex-col gap-3" >
                <label for="cpass">Confirm Password</label>
                <input class=" px-3 py-2 rounded border outline-none border-slate-500 focus:border-blue-700" name="password_confirmation" type="password" placeholder="Confirm password">
                    <span class=" text-red-500 font-medium px-3" >
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            <button type="submit" class="hover:bg-blue-700 border-none outline-none px-5 py-2 rounded-xl text-white font-semibold cursor-pointer bg-blue-500 transition" >Sign Up</button>
         </form>
    </section>

</body>
</html>