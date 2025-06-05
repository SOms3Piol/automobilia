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

           

           const fetchMessageForChat = async (id , chat_id)=> {
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
                
              if(chat_id != id){
                let unread_marker = true;
                message_container.innerHTML= '';
                array.messages.forEach((message)=>{

                    if((message.id > array.last_seen_id.message_id) && (message.sender_id != user_id) && unread_marker){
                        
                        const div = document.createElement('div');
                        div.className = 'w-full my-3 text-center border-b border-t py-1 border-t-slate-300 border-b-slate-300';
                        div.textContent = 'unread messages';
                        message_container.appendChild(div);
                        unread_marker = false;
                        
                    }

                    const div = document.createElement('div');
                    div.className = `line-break w-fit max-w-[450px] my-2 p-2 rounded ${
                        message.sender_id == user_id ? 'ml-auto bg-pink-300' : 'mr-auto bg-slate-300'
                    }`;
                    div.textContent = message.message;
                    message_container.appendChild(div);
                })
                message_container.scrollTo({
                        top: message_container.scrollHeight,
                        behavior: 'smooth'  
                });
              }
            }
        
        })
    </script>

</x-dashboard-layout>