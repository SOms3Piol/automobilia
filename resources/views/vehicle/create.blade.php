<x-dashboard-layout>

    <div class="p-8" >
        <div class="text-center" >
            <h2 class="text-2xl  font-semibold" >Publish New Vehicle.</h2>
            <p class="text-slate-600" >Cars are not just transportation; they are an expression of who we are.</p>
        </div>
        <form action="{{ route('vehicle.store') }}" method="post" class="my-10  max-w-[750px] mx-auto " enctype="multipart/form-data">
            @csrf

            <div class="bg-zinc-800 h-[350px] rounded overflow-hidden relative " >
                @error('image')
                    <p>{{ $message }}</p>
                @enderror
                @error('mimes')
                    <p>{{ $message }}</p>
                @enderror
                @error('required')
                    <p>{{ $message }}</p>
                @enderror
                <label for="imgUpload" class="absolute top-0 w-full h-full cursor-pointer z-10" >
                    <img class="object-fit shadow w-full h-full object-center rounded-sm hover:opacity-[.5] transition " src="https://picsum.photos/300/200" alt="Placeholder Image">
                </label>
                <input class="opacity-0" type="file" name="thumbnail" accept=".jpg, .jpeg , .webp , .png" id="imgUpload" required >
            </div>
            <div class=" my-7 text-2xl font-semibold" >
            <h2>Main Information.</h2>
            </div>
            <div class="flex max-sm:flex-col gap-3 my-8 " >
                
                <div class="flex flex-col gap-1 w-full" >
                    <label for="title">Vehicle Title</label>
                    <input class="border  border-slate-500 bg-white py-1 px-2 outline-none rounded shadow" type="text" placeholder="e.g vehicle Title" name="title" required >
                </div>
                <div class="w-full flex flex-col gap-1" >
                    <label for="price">Vehicle Price</label>
                    <input class="border  border-slate-500 bg-white py-1 px-2 outline-none rounded shadow [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none " name="price" type="number" placeholder="e.g 500000" required >
                </div>
            </div>
            <div class="flex max-sm:flex-col gap-3 my-7 " >
                <div class="flex flex-col gap-1 w-full" >
                    <label for="title">Vehicle Model</label>
                    <input class="border  border-slate-500 bg-white py-1 px-2 outline-none rounded shadow" type="text" placeholder="e.g F8 tributo" name="model" required >
                </div>
                <div class="w-full flex flex-col gap-1" >
                    <label for="price">Vehicle Make</label>
                    <input class="border border-slate-500 bg-white py-1 px-2 outline-none rounded shadow" type="text" placeholder="e.g Ferrari, Ford, Honda" name="make" required >
                </div>
            </div>
            <div class="flex gap-3 my-7 " >
                <div class="flex flex-col gap-1 w-full" >
                    <label for="title">Vehicle Year</label>
                    <input class="border  border-slate-500 bg-white py-1 px-2 outline-none rounded shadow [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" placeholder="e.g 2005" name="year" required >
                </div>
                <div class="flex flex-col gap-1 w-full" >
                    <label for="title">Location</label>
                    <input class="border  border-slate-500 bg-white py-1 px-2 outline-none rounded shadow " type="text" placeholder="e.g Azua,Azua" name="location" required >
                </div>
            </div>

            <div class="my-8 text-2xl font-semibold " >
                <h2>Vehicle Details.</h2>
            </div>

            <div class="flex max-sm:flex-col gap-3 my-7 " >
                <div class="flex flex-col gap-1 w-full" >
                    <label for="title">Vehicle Mileage</label>
                    <input class="border  border-slate-500 bg-white py-1 px-2 outline-none rounded shadow [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" placeholder="e.g 42000km" name="mileage" required >
                </div>
                <div class="w-full flex flex-col gap-1" >
                    <label for="price">Manufacture By.</label>
                    <input class="border border-slate-500 bg-white py-1 px-2 outline-none rounded shadow" type="text" placeholder="e.g Pakistan, Englad, USA" name="manufacture_country" required >
                </div>
            </div>
            <div class="flex max-sm:flex-col gap-3 my-7 " >
                <div class="flex flex-col gap-1 w-full" >
                    <label for="price">Exterior Color</label>
                    <input class="border border-slate-500 bg-white py-1 px-2 outline-none rounded shadow" type="text" placeholder="e.g Black" name="exterior_color" required >
                </div>
                <div class="w-full flex flex-col gap-1" >
                    <label for="price">Interior Color</label>
                    <input class="border border-slate-500 bg-white py-1 px-2 outline-none rounded shadow" type="text" placeholder="e.g Red" name="interior_color" required >
                </div>
            </div>
            <div class="flex max-sm:flex-col gap-3 my-7 " >
                <div class="flex flex-col gap-1 w-full" >
                    <label for="title">Vehicle Category</label>
                    <select name="category" id="category" class="bg-white py-2 rounded border-slate-300 px-2 shadow" required >
                        <option  hidden>Select any option.</option>
                        <option value="used">Used</option>
                        <option value="new">New</option>
                    </select>
                </div>
                <div class="w-full flex flex-col gap-1" >
                    <label for="price">Engine Type</label>
                    <input class="border border-slate-500 bg-white py-1 px-2 outline-none rounded shadow" type="text" placeholder="e.g Gasoline" name="engine_type" required >
                </div>
            </div>
            <div class="flex max-sm:flex-col gap-3 my-7 " >
                <div class="flex flex-col gap-1 w-full" >
                    <label for="title">Vehicle Transmission.</label>
                    <input class="border border-slate-500 bg-white py-1 px-2 outline-none rounded shadow" type="text" placeholder="e.g Gasoline" name="transmission" required >
                </div>
                <div class="w-full flex flex-col gap-1" >
                    <label for="price">Engine capacity</label>
                    <input class="border border-slate-500 bg-white py-1 px-2 outline-none rounded shadow" type="text" placeholder="e.g 4.6-L V-8 SOHC 16V" name="engine_capacity" required >
                </div>
            </div>


            <div class="text-2xl font-semibold my-9" >
                <h2>Additional Feature</h2>
            </div>
            <div id="input-container" class="flex flex-col gap-3 py-7" >
                <div class="relative" >
                    <input class="w-full block p-2 outline-none border rounded border-slate-300 bg-white" type="text" placeholder="e.g Air Bags" name="additional_feature[]" required>
                </div>
            </div>
            <div id="add_input" class="bg-white rounded py-2 text-center text-2xl hover:opacity-[0.6] cursor-pointer w-full" >
                <i class="fa-solid fa-plus"></i>
            </div>

            <div class="my-8" >
                <h2 class="text-2xl font-semibold" >Vehicle Overview.</h2>
                <textarea required placeholder="e.g description of the vehicle" class="bg-white rounded outline-none mt-7 w-full p-3" name="description" id="description" maxlength="200" ></textarea>
            </div>

            <button class="bg-pink-700 cursor-pointer hover:bg-pink-500 transition all py-3 w-full text-center text-white my-7 rounded" type="submit" >Publish Vehicle</button>
        </form>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const input_container = document.getElementById('input-container');
        const add_input = document.getElementById('add_input');

        add_input.addEventListener('click', addInput);

        function addInput() {
            const container = document.getElementById('input-container');

            // Create a wrapper div for the input and delete button
            const div = document.createElement('div');
            div.classList.add('relative');

            // Create the input element
            const input = document.createElement('input');
            input.setAttribute('required','true')
            input.type = 'text';
            input.placeholder = 'e.g Air Bags';
            input.name = 'additional_feature[]';
            input.classList.add('w-full', 'block', 'p-2', 'outline-none', 'border', 'rounded', 'border-slate-300', 'bg-white');

            // Create the delete button
            const button = document.createElement('div');
            button.classList.add('absolute', '-right-2', '-top-3', 'h-[23px]', 'bg-slate-300', 'cursor-pointer', 'w-[23px]', 'flex', 'items-center', 'justify-center', 'border', 'rounded-full');

            button.innerHTML = '<i class="fa-solid fa-xmark"></i>';
            button.addEventListener('click',function() {
                div.remove();  
            }); 

        // Append the input and delete button to the wrapper div
        div.appendChild(input);
        div.appendChild(button);

        // Append the wrapper div to the container
        container.appendChild(div);
    }

        });
    </script>


</x-dashboard-layout>