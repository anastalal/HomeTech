<!--
// v0 by Vercel.
// https://v0.dev/t/jaizra12yRz
-->

<main class="container mx-auto my-12 px-4 md:px-6">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
      <div class="rounded-lg borderd bg-card text-card-foreground shadow-sm bg-form" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-6 ">
          <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Profile Information</h3>
          <p class="text-sm text-muted-foreground">Update your profile information here.</p>
          @if (session()->has('message'))
          <div class="bg-green-200 text-green-800 p-4 mb-4" role="alert">
              {{ session('message') }}
          </div>
      @endif
        </div>
        <form wire:submit.prevent="updateProfile" class="">
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                  <div class="space-y-2">
                    <label
                      class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                      for="name"
                    >
                      First Name
                    </label>
                    <input wire:model="profileInformation.first_name"
                      class="flex text-gray-600 peer h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                      id="name"
                      placeholder="Enter your name"
                    />
                    @error('profileInformation.first_name') <span class="peer-invalid:visible text-pink-600 text-sm">{{ $message }}</span> @enderror
                  </div>
                  <div class="space-y-2">
                    <label
                      class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                      for="email"
                    >
                      Last Name
                    </label>
                    <input wire:model="profileInformation.last_name"
                      class="flex peer text-gray-600  h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                      id="email"
                      placeholder="Enter your Last Name"
                      type="text"
                    />
                    @error('profileInformation.last_name') <span class="peer-invalid:visible text-pink-600 text-sm">{{ $message }}</span> @enderror
                  </div>
                </div>
                <div class="space-y-2">
                  <label 
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="email"
                  >
                    Email
                  </label>
                  <input wire:model="profileInformation.email"
                    class="flex peer text-gray-600 h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    id="current-password"
                    type="email"
                  />
                  @error('profileInformation.email') <span class="peer-invalid:visible text-pink-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
              </div>
              
              <div class="flex items-center p-6">
                <button class="inline-flex bg-gray-600 items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50  text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 ml-auto">
                  Save 
                </button>
              </div>
        </form>
       
      </div>
      <div class="rounded-lg borderd bg-card text-card-foreground bg-form shadow-sm" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-6">
          <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Update Password</h3>
          <p class="text-sm text-muted-foreground">Change your password here. After saving, you'll be logged out.</p>
          @if (session()->has('message2'))
          <div class="bg-green-200 text-green-800 p-4 mb-4" role="alert">
              {{ session('message2') }}
          </div>
         @endif
        </div>
        <form wire:submit.prevent="updatePassword">
            <div class="p-6 space-y-4">
                <div class="space-y-2">
                  <label
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="current-password"
                  >
                    Current Password
                  </label>
                  <input wire:model.defer="passwordUpdate.current_password"
                    class="flex text-gray-600 peer h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    id="current-password"
                    type="password"
                  />
                  @error('passwordUpdate.current_password') <span class="peer-invalid:visible text-pink-600 text-sm">{{ $message }}</span> @enderror

                </div>
                <div class="space-y-2">
                  <label
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="new-password"
                  >
                    New Password
                  </label>
                  <input wire:model.defer="passwordUpdate.new_password"
                    class="flex peer text-gray-600  h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    id="new-password"
                    type="password"
                  />
                  @error('passwordUpdate.new_password') <span class="peer-invalid:visible text-pink-600 text-sm">{{ $message }}</span> @enderror

                </div>
                <div class="space-y-2">
                  <label
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="confirm-password"
                  >
                    Confirm New Password
                  </label>
                  <input wire:model.defer="passwordUpdate.new_password_confirmation"
                    class="flex text-gray-600 h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    id="confirm-password"
                    type="password"
                  />
                </div>
              </div>
              <div class="flex items-center p-6">
                <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-gray-600 text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 ml-auto">
                  Save
                </button>
              </div>
        </form>
        
      </div>
    </div>
  </main>