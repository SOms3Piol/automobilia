import './bootstrap';


 document.addEventListener('DOMContentLoaded', function() {
    // Get all input containers
    const inputContainers = document.querySelectorAll('.input');

    inputContainers.forEach(container => {
        const mainInput = container.querySelector('input[type="text"]');
        const dropdown = container.querySelector('#drop-down');
        const buttons = dropdown.querySelectorAll('button');

        // Set up dropdown styling
        dropdown.style.position = 'absolute';
        dropdown.style.display = 'none';
        dropdown.style.zIndex = '10';
        dropdown.style.border = 'border'
        dropdown.style.width = `${mainInput.offsetWidth}px`; // Match input width
        dropdown.style.top = `${mainInput.offsetHeight + 25}px`; // Position below input
        container.style.position = 'relative'; // For absolute positioning context

        // Show dropdown when input is focused
        mainInput.addEventListener('focus', function(e) {
            if(mainInput.id == e.target.id) dropdown.style.display = 'none';
            // Hide all other dropdowns
            inputContainers.forEach(otherContainer => {
                if (otherContainer !== container) {
                    otherContainer.querySelector('#drop-down').style.display = 'none';
                }
            });
            // Show this dropdown and ensure correct positioning
            dropdown.style.display = 'block';
            dropdown.style.width = `${mainInput.offsetWidth}px`; // Update width in case of resize
        });

        // Handle button clicks
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                mainInput.value = button.textContent.trim();
                dropdown.style.display = 'none';
            });
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!container.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Optional: Handle window resize to keep dropdown width matched
        window.addEventListener('resize', function() {
            dropdown.style.width = `${mainInput.offsetWidth}px`;
        });
    });

    const sidebar = document.getElementById('mbl-sidebar');
    const mbl_btn = document.getElementById('mbl-btn');

    const category_selector = document.getElementById('toggle-category')
    const car_category = document.getElementById('car-category')


    category_selector.addEventListener('click' , ()=>{
        car_category.classList.toggle('hidden')
    })
    document.getElementById('lg-menu').addEventListener('click' , ()=>{
        document.getElementById('lg-car-menu').classList.toggle('hidden')
    })

    let active = false;
    mbl_btn.addEventListener('click' , ()=>{
        if(!active){
            sidebar.style.transform = 'translateX(230px)'
            active = true;
        }
        else{
            sidebar.style.transform = 'translateX(-230px)';
            active = false;
        }
    })



    

});
    


        

    