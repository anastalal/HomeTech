@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container  w-full max-w-md mx-auto mt-1">
        <form  action="{{ route('register') }}" method="POST" class=" p-4 bg-form">
            @csrf
            <h2 class="text-2xl font-bold mb-4">Sign Up</h2>
            <div class="form-groupd">
                <div class="grid gap-2">
                    <label
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="device1"
                  >
                    First Name
                  </label>
                    <input id="name" placeholder="First Name" type="text"  class="@error('first_name') is-invalid @enderror  flex peer text-gray-700 h-10 w-full rounded-md border border-input 
                    bg-background px-3 py-2 text-sm ring-offset-background file:border-0
                    file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground
                    focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring
                    focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="grid gap-2 mt-3">
                    <label
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="device1"
                  >
                    Last Name
                  </label>
                    <input id="names" placeholder="Last Name" type="text" class=" @error('last_name') is-invalid @enderror flex peer text-gray-700 h-10 w-full rounded-md border border-input 
                    bg-background px-3 py-2 text-sm ring-offset-background file:border-0
                    file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground
                    focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring
                    focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="grid gap-2 mt-3">
                    <label
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="device1"
                  >
                    Last Name
                  </label>
                    <input id="names" placeholder="Email" type="email" class=" @error('email') is-invalid @enderror flex peer text-gray-700 h-10 w-full rounded-md border border-input 
                    bg-background px-3 py-2 text-sm ring-offset-background file:border-0
                    file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground
                    focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring
                    focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" name="last_name" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="grid gap-2 mt-3">
                    <label
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="device1"
                  >
                    Password
                  </label>
                    <input id="pass" placeholder="password" type="password" class=" @error('password') is-invalid @enderror flex peer text-gray-700 h-10 w-full rounded-md border border-input 
                    bg-background px-3 py-2 text-sm ring-offset-background file:border-0
                    file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground
                    focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring
                    focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" name="password"  required autofocus>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="grid gap-2 mt-3">
                    <label
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="device1"
                  >
                  password confirmation
                  </label>
                    <input id="pass" placeholder="password" type="password" class=" @error('password_confirmation') is-invalid @enderror flex peer text-gray-700 h-10 w-full rounded-md border border-input 
                    bg-background px-3 py-2 text-sm ring-offset-background file:border-0
                    file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground
                    focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring
                    focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" name="password_confirmation"  required autocomplete="name" autofocus>
                              
                </div>
                <button type="submit" class="mybtn mt-4">Sign up
                    <div class="icon">
                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                        </svg>
                      </div>
                   </button>
        </form>
    </div>
</div>
@endsection
