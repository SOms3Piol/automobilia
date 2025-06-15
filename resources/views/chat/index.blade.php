<x-dashboard-layout>

    
    <div class="flex  w-full h-full " >
        <div class="sidebar-chat border-r border-r-slate-300 shrink-0 flex-4/12" >
            @if (!$chats)
                <p>No Chats Found!</p>
            @else
                @foreach ($chats as $chat)
                    @php
                        $user = $chat->sender->id == auth()->user()->id ? $chat->receiver : $chat->sender;
                    @endphp
                <div id="{{ $chat->id }}" data-user-profile="{{ $user->profile_img }}" data-name="{{ $user->name }}" class="chat-card {{ $chat->unread_count ? 'border border-pink-500 bg-pink-100' : 'bg-slate-300' }} cursor-pointer flex mx-3 my-5 py-2 rounded items-center" >
                    <div class="h-[50px] w-[50px] " >
                        <img  class="object-fit w-full h-full mix-blend-multiply" src="{{ $user->profile_img }}" alt="user profile pics">
                    </div>
                    <div id="unread_container" class="flex justify-between px-3 w-full items-center" >
                        <div>
                            <p >{{ $user->name }}</p>
                        </div>
                            <span id="unread_count_{{ $chat->id }}"  class="bg-pink-500 px-1 rounded-full text-white text-xs " >{{ $chat->unread_count ? $chat->unread_count : '' }}</span>
                        
                    </div>
                </div>
                @endforeach
            @endif
            
        </div>
        <div class="message-container flex flex-col h-full w-full" >
            <div class="bg-white py-1 px-3 shadow-xl flex gap-3 items-center m-1 rounded top-bar" >
                <div class="h-[50px] w-[50px]" >
                    <img id="profile-img" class="object-fit h-full w-full mix-blend-multiply" src="https://automobiliard.com/user/resources/images/d-avatar.jpg" alt="">
                </div>
                <div>
                    <p id="username" >username</p>
                    <span id="status" class="text-xs" >offline</span>
                </div>
            </div>
            <div class="message-list overflow-auto h-[400px] shadow  px-1" >
                
            </div>
            <div class="message-input bg-white mx-1 rounded  flex  mt-auto ">
                <input id="message-input" class="flex-grow border-b border-b-slate-300 py-3 px-1" type="text" placeholder="Type your message.....">
                <button id="send-button" class="bg-pink-500 text-white border-none rounded px-3" ><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>
        <div class="placeholder flex items-center justify-center h-full w-full" >
            <h1>No Chat Is Selected!</h1>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', ()=>{

            const container = document.querySelector('.message-container')
            

            const message_container = document.querySelector('.message-list');
            const user_id = {{  auth()->user()->id  }}
            const chat_cards = document.querySelectorAll('.chat-card');

            const message_input = document.getElementById('message-input');
            
            const send_button = document.getElementById('send-button');

            const user_profile = document.getElementById('profile-img');
            const username = document.getElementById('username');
            const status = document.getElementById('status')
            const placeholder = document.querySelector('.placeholder');
            var nextPageUrl;



    


            send_button.addEventListener('click' , async ()=>{
                const message_content = message_input.value;
                if(!message_content){
                    return;
                }
                const response_json = await fetch(`/api/chat/${selected_chat}/messages`,{
                    method:'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body:JSON.stringify({message: message_content}),
                    credentials: 'include',
                });

                const response = await response_json.json();
                if(response.success){
                    const div = document.createElement('div');
                    div.className = `message w-fit max-w-[450px] my-2 p-2 rounded ml-auto bg-pink-300
                    `;
                    div.textContent = message_content;
                    message_container.appendChild(div);
                    message_container.scrollTo({
                        top: message_container.scrollHeight,
                        behavior: 'smooth'  
                    });

                }
            })



            // chat selection and load messages w.r.t chat_id;
            let selected_chat = 0 ;
            
            if(!selected_chat){
                container.classList.remove('flex')
                container.classList.add('hidden')
                placeholder.classList.add('flex');
                placeholder.classList.remove('hidden')
            }


            chat_cards.forEach( (card)=>{
                card.addEventListener('click',(e)=>{
                    container.classList.remove('hidden')
                    container.classList.add('flex')
                    placeholder.classList.add('hidden');
                    placeholder.classList.remove('flex')
                    if(selected_chat != e.currentTarget.id){

                        if(selected_chat){
                            window.Echo.leave(`chat.${selected_chat}`)
                        }

                        chat_cards[Number(selected_chat)].classList.remove('bg-pink-300')
                        chat_cards[Number(selected_chat)].classList.add('bg-slate-300');
                        



                        fetchMessageForChat(e.currentTarget.id , selected_chat);
                        
                        setTimeout(() => {
                           const line_break = document.querySelector('.line-break');
                           if(line_break){
                            line_break.remove();
                           }
                        }, 3 * 1000);
                        user_profile.src = e.currentTarget.dataset.userProfile;
                        username.innerHTML = e.currentTarget.dataset.name;
                        selected_chat = e.currentTarget.id;
                        hideUnreadCount(selected_chat)
            

                        window.Echo.private(`chat.${selected_chat}`)
                        .listen('.message.sent', (data)=>{
                            console.log(card.id)
                            if(data.sender_id != user_id ){
                                console.log(data)
                                const div = document.createElement('div');
                                div.className = `message w-fit max-w-[450px] my-2 p-2 rounded mr-auto bg-slate-300
                                `;
                                div.textContent = data.message;
                                message_container.appendChild(div);
                                message_container.scrollTo({
                                    top: message_container.scrollHeight,
                                    behavior: 'smooth'  
                                });

                                
                            }
                            
                        });

                        window.Echo.join(`status.${selected_chat}`)
                        .here(users => {
                            const isOtherUserOnline = users.some(user => user.id !== user_id);
                            status.textContent = isOtherUserOnline ? 'ONLINE' : 'OFFLINE';
                        })
                        .joining((user) => {
                            if (user.id !== user_id) {
                                status.textContent = 'ONLINE';
                            }
                        })
                        .leaving((user) => {
                            if (user.id !== user_id) {
                                status.textContent = 'OFFLINE';
                            }
                        });


                        e.currentTarget.classList.remove('bg-slate-300')
                        e.currentTarget.classList.add('bg-pink-300')
                        e.currentTarget.classList.remove('border')
                        
                    }
                    
                })

                
            })

            
            

            const incrementUnreadCount = (chat_id) =>  {
                
                const chat = document.getElementById(`${chat_id}`);
                chat.classList.add('border', 'border-pink-500', 'bg-pink-100');
                chat.classList.remove('bg-slate-300');
                const span = document.getElementById(`unread_count_${chat_id}`);
                let count  = Number(span.textContent) || 0;
                count++;
                span.textContent = count;
                
            }
            

            

            function hideUnreadCount(chat_id){
                const unread_count = document.getElementById(`unread_count_${chat_id}`);
                if(!unread_count) return;
                unread_count.textContent = ''; 
            }

           
          

            window.Echo.private(`notification`)
                .listen('.message.sent' , (data) => {
                    if(data.chat_id != selected_chat){
                        incrementUnreadCount(data.chat_id)
                    }
                })

           




                let dayNames = [
                    {
                        name: "Monday",
                        grouped: false
                    },
                    {
                        name: "Tuesday",
                        grouped: false
                    },
                    {
                        name : "Wednesday",
                        grouped: false
                    },
                    {
                        name : "Thursday",
                        grouped: false
                    },
                    {
                        name : "Friday",
                        grouped: false
                    },
                    {
                        name: "Saturday",
                        grouped: false
                    },
                    {
                        name : "Sunday",
                        grouped: false
                    },

                ];
                function handleMessageGroup(currentDay){
                    let dayNameGrouped = dayNames[currentDay -1];
                        let count = 0;
                        let previousDay = null;
                        if(!dayNameGrouped.grouped){
                            const dayTitle = document.createElement('div');
                            dayTitle.className = 'bg-slate-200 py-1 my-4 px-4 rounded shadow-md w-fit mx-auto';
                            dayTitle.textContent = dayNameGrouped.name;
                            message_container.appendChild(dayTitle);
                            dayNameGrouped.grouped = true;
                            count = count + 1;
                        }

                        if(count === 7){
                            if(previousDay != time.getDay()){
                                const dayTitle = document.createElement('div');
                                dayTitle.className = 'bg-slate-200 py-1 my-4 px-4 rounded shadow-md w-fit mx-auto';
                                const formatted = time.toLocaleDateString('en-US', {
                                                    year: 'numeric',
                                                    month: 'long',
                                                    day: 'numeric',
                                                });
                                dayTitle.textContent = formatted;
                                message_container.appendChild(dayTitle);
                                previousDay = time.getDay();
                            }
                        }
                }

    
          
            async function fetchMessageForChat(id , chat_id){
                const response = await fetch(`/api/chat/${id}/messages` , {
                        method:'get',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        credentials: 'include',
                        });
                const array = await response.json();
                nextPageUrl = array.next_page_url;
              
              if(chat_id != id){
                let unread_marker = true;
                message_container.innerHTML= '';
                message_container.innerHTML = 
                `<div class='flex justify-center py-3' >
                    <button id='nextpage-button' class=" cursor-pointer border-b border-slate-300 w-fit mx-auto" >click to load older messages</button>
                </div>`;



                array.messages.data.reverse().forEach((message)=>{

                    if((message.id > array.last_seen_id.message_id) && (message.sender_id != user_id) && unread_marker){
                        
                        const div = document.createElement('div');
                        div.className = 'w-full my-3 text-center border-b border-t py-1 border-t-slate-300 border-b-slate-300';
                        div.textContent = 'unread messages';
                        message_container.appendChild(div);
                        unread_marker = false;
                        
                    }               
                    // Message div 
                    const div = document.createElement('div');
                    div.className = `line-break text-left w-fit flex flex-col max-w-[450px] my-2 p-2 rounded ${
                        message.sender_id == user_id ? 'ml-auto bg-pink-300' : 'mr-auto bg-slate-300'
                    }`;

                    const time = new Date(message.created_at);
                    const formattedTime = time.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                    currentDay = time.getDay();


                    handleMessageGroup(currentDay);



                   
                    div.innerHTML = `${message.message} <small class='text-right pl-3 py-1' >${formattedTime}</small> `;
                    message_container.appendChild(div);
                })

                

                message_container.scrollTo({
                        top: message_container.scrollHeight,
                        behavior: 'smooth'  
                });
                var next_button = document.getElementById('nextpage-button');
                // next messages according to pagination

            next_button.addEventListener('click' , ()=>{
                        fetch(`${nextPageUrl}` , {
                            method:'get',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            credentials: 'include',
                        })
                        .then((data)=>  data.json())
                        .then((response)=>{
                             // Create HTML from messages
                            const html = response.messages.data.reverse().map(msg => {
                                
                                return `
                                <div class=' line-break w-fit max-w-[450px] my-2 p-2 rounded ${
                                    msg.sender_id == user_id ? 'ml-auto bg-pink-300' : 'mr-auto bg-slate-300'
                                }'>
                                ${msg.message}
                                </div>`
                            }).join('');

                            previousScrollHeight = message_container.scrollHeight

                            // Prepend to container
                            message_container.insertAdjacentHTML('afterbegin', html);

                            // Adjust scroll so user doesn't jump
                            message_container.scrollTop = container.scrollHeight - previousScrollHeight;

                            // Update next page URL or disable button
                            nextPageUrl = response.next_page_url;
                            if (!nextPageUrl) {
                                next_button.style.display = 'none';
                            }

                        })
                    })
                
                if(!array.next_page_url){
                    next_button.classList.add('hidden')
                }
               
              }
            }


        

        })
    </script>

</x-dashboard-layout>