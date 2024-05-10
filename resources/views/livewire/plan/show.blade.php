
<div class="flex h-full w-full">
    <div class="flex h-full w-1/3 flex-col border-r bg-gray-5f0 dark:border-gray-800 ">
      <header class="flex items-center justify-between border-b px-4 py-3 dark:border-gray-800">
       <div class="">
        <h2 class="text-lg font-semibold">Rooms</h2>
        <small class="mx-2"> Rooms: {{ $plan->rooms->count() }}</small>
       </div>
       @auth
       @if (Auth::user()->id  == $plan->user_id)
       <button  wire:click="$dispatch('openModal', { component: 'room.create-room', arguments: { plan: {{ $plan->id }} } })" 
        class="flex gap-2 items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-auto">

          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="h-5 w-5"
          >
            <path d="M5 12h14"></path>
            <path d="M12 5v14"></path>
          </svg>
          <span class="sr-only">Add Project</span>
          add
        </button>
       @endif
     @endauth
      
      </header>
      <div class="flex-1 overflow-y-auto p-4 custom-scroll">
        <div class="grid gap-4">
         @php
           $rooms = $plan->rooms->sortByDesc('created_at');
           $count = $plan->rooms->count();
         @endphp
         @foreach ($rooms as $room )
         <div class="rounded-lg border bg-card text-card-foreground shadow-sm" >
          <div class="flex-col space-y-1.5 p-6 flex items-start justify-between">
            <div class="flex w-full justify-between">
              <div class="text-left">
                <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Room: {{  $count-- }}</h3>
                <p class="text-sm text-muted-foreground">{{ $room->type }} Height: {{ $room->height }} | Width: {{ $room->width }}</p>
              </div>
              <div class="">
                <button wire:click="deleteRoom({{ $room->id }}, {{ $plan->id }})"
                wire:confirm="Are you sure you want to delete this Room?"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="h-5 w-5"
                  >
                    <path d="M3 6h18"></path>
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                  </svg>
                  <span class="sr-only">Delete</span>
                </button>
              </div>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
              Devices: <br>
              @foreach ($room->devices as $device )
              <div class="inline-flex w-fit items-center whitespace-nowrap rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-green-100 text-orange-600 dark:bg-green-900/20 dark:text-orange-400">
                {{ $device['value'] }}
              </div>
              @endforeach
              
             
            </div>
           
             <div class="flex items-center gap-2 mt-3">
                <button style="--clr: #423f44" class="button" @if ($room->generated  == 0) disabled @endif 
                wire:click="getDeviceSuggestions({{ $room->id }},'show')">
                  <span class="button__icon-wrapper">
                      <svg width="10" class="button__icon-svg" wire:loading.remove xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 15">
                          <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                      </svg>
                      <svg class="button__icon-svg  button__icon-svg--copy" wire:loading xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle fill="#443842" stroke="#443842" stroke-width="15" r="15" cx="40" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate></circle><circle fill="#443842" stroke="#443842" stroke-width="15" r="15" cx="100" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate></circle><circle fill="#443842" stroke="#443842" stroke-width="15" r="15" cx="160" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate></circle></svg>
                      
                      <svg class="button__icon-svg  button__icon-svg--copy" wire:loading.remove xmlns="http://www.w3.org/2000/svg" width="10" fill="none" viewBox="0 0 14 15">
                          <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                      </svg>
                  </span>
                  Show
                </button>
                @auth
                @if (Auth::user()->id  == $plan->user_id)
                <button wire:click="getDeviceSuggestions({{ $room->id }},'gen')" 
                  style="--clr: #423f44" class="button" href="#" >
                  <span class="button__icon-wrapper">
                      <svg wire:loading.remove width="10" class="button__icon-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 15">
                          <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                      </svg>
                      <svg class="button__icon-svg  button__icon-svg--copy" wire:loading xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle fill="#443842" stroke="#443842" stroke-width="15" r="15" cx="40" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate></circle><circle fill="#443842" stroke="#443842" stroke-width="15" r="15" cx="100" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate></circle><circle fill="#443842" stroke="#443842" stroke-width="15" r="15" cx="160" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate></circle></svg>
                    
                      <svg class="button__icon-svg  button__icon-svg--copy" wire:loading.remove xmlns="http://www.w3.org/2000/svg" width="10" fill="none" viewBox="0 0 14 15">
                          <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                      </svg>
                  </span>
                  @if ($room->generated  == 0 ) 
                  Generate
                  @else
                  Regenerate
                   @endif
                  
                </button>
                @endif
              @endauth
               
              </div>
          </div>
          <div class="p-6 pt-0">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="h-4 w-4 text-gray-500 dark:text-gray-400"
                >
                  <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                  <line x1="16" x2="16" y1="2" y2="6"></line>
                  <line x1="8" x2="8" y1="2" y2="6"></line>
                  <line x1="3" x2="21" y1="10" y2="10"></line>
                </svg>
                <span class="text-sm text-gray-500 dark:text-gray-400"> {{ $room->created_at->diffForHumans() }}</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $room->generated }} Times Generated</span>
              </div>
            </div>
          </div>
        </div>
           
         @endforeach
        
        </div>
      </div>
    </div>
    <div class="flex h-full w-2/3 flex-col">
      <header class="flex items-center justify-between border-b px-4 py-3 dark:border-gray-800">
        {{-- <h2 class="text-lg font-semibold">{{ $plan->name }}</h2> --}}
        <div class="">
        <h2 class="text-lg font-semibold">{{ $plan->name }}</h2>
            <small> Area: {{ $plan->area }}</small>
            <small class="mx-2"> Min Budget: {{ $plan->min_budget }}</small>
            <small class="mx-2"> Max Budget: {{ $plan->max_budget }}</small>
        </div>
        <div class="flex items-center gap-2">
          {{-- <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="h-5 w-5"
            >
              <path d="M4 13.5V4a2 2 0 0 1 2-2h8.5L20 7.5V20a2 2 0 0 1-2 2h-5.5"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <path d="M10.42 12.61a2.1 2.1 0 1 1 2.97 2.97L7.95 21 4 22l.99-3.95 5.43-5.44Z"></path>
            </svg>
            <span class="sr-only">Edit</span>
          </button>
           --}}
           @auth
           @if (Auth::user()->id  == $plan->user_id)
           <button wire:click="deletePlan"
           wire:confirm="Are you sure you want to delete this Plan?"
           class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10">
             <svg
               xmlns="http://www.w3.org/2000/svg"
               width="24"
               height="24"
               viewBox="0 0 24 24"
               fill="none"
               stroke="currentColor"
               stroke-width="2"
               stroke-linecap="round"
               stroke-linejoin="round"
               class="h-5 w-5"
             >
               <path d="M3 6h18"></path>
               <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
               <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
             </svg>
             <span class="sr-only">Delete</span>
           </button>
           @endif
         @endauth
         
        </div>
      </header>
      <div class="flex-1 overflow-y-auto p-4">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">HomeTech</h3>
            <p class="text-sm text-muted-foreground" >Simplify Your Life with Smart Home Solutions</p>
          </div>
          <div class="p-3">
          <div wire:loading wire:target="getDeviceSuggestions" class="flex flex-col bg-neutral-800 w-full h-64 animate-pulse rounded-xl p-4 gap-4">
            <div class="bg-neutral-400/50 w-full h-32 animate-pulse rounded-md"></div>
            <div class="flex flex-col gap-2">
              <div class="bg-neutral-400/50 w-full h-4 animate-pulse rounded-md"></div>
              <div class="bg-neutral-400/50 w-4/5 h-4 animate-pulse rounded-md"></div>
              <div class="bg-neutral-400/50 w-full h-4 animate-pulse rounded-md"></div>
              <div class="bg-neutral-400/50 w-2/4 h-4 animate-pulse rounded-md"></div>
            </div>
          </div>
          <div class="content">
            @if(!empty($suggestions))
            {!! $suggestions !!}
            
            @else
                <p wire:model="error" wire:loading.remove wire:target="getDeviceSuggestions">No suggestions available. Please Select Room or try again later.</p>
            @endif
          </div>
           
        </div>
            
        
        </div>
      </div>
    </div>
  </div>