
  

<div class="w-full max-w-md mx-auto mt-12">
    <div class="rounded-lgs w-96 bg-form bordesr bg-card text-card-foreground shadow-sm" data-v0-t="card">
      <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Compare Devices</h3>
        <p class="text-sm text-muted-foreground">Enter the names of two devices to compare.</p>
      </div>
      <div class="p-6 ">
        <form class="grid gap-4 " wire:submit="save">
          <div class="grid gap-2 ">
            <label
              class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
              for="device1"
            >
              Device 1
            </label>
            <input wire:model="device1"
              class="flex peer text-gray-700 h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
              id="device1"
              placeholder="Enter device name"
            />
            @error('device1')
            <span class="mt-2s invisiblse peer-invalid:visible text-pink-600 text-sm" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
          </div>
          <div class="grid gap-2">
            <label
              class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
              for="device2"
            >
              Device 2
            </label>
            <input wire:model="device2"
              class="flex peer  peer-invalid:border-pink-600 text-gray-700 h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
              id="device2"
              placeholder="Enter device name"
            />
            @error('device2')
            <span class="mt-2s invisiblse peer-invalid:visible text-pink-600 text-sm" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
          </div>
          <button 
            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full"
            type="submit"
          >
            Create
          </button>
        </form>
      </div>
    </div>
  </div>
 

  