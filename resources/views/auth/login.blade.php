@extends('layouts.app')

@section('content')
<div class="container  w-full max-w-md mx-auto mt-1">
    <form method="POST" action="{{ route('login') }}" class="bg-form p-4">
        @csrf
        <h2 class="text-2xl font-bold mb-4">Login</h2>
        <div class="grid gap-2">
            <label
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
            for="device1"
          >
            Email
          </label>
            <input id="email" placeholder="Email" type="email" class="form-input @error('email') border-red-500 @enderror 
            flex peer text-gray-700 h-10 w-full rounded-md border border-input 
            bg-background px-3 py-2 text-sm ring-offset-background file:border-0
            file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground
            focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring
            focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="text-red-500 text-sm" role="alert">
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
            <input id="password" placeholder="Password" type="password" class="flex peer text-gray-700 h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 form-input @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="text-red-500 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="mybtn mt-4">Login
            <div class="icon">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                </svg>
              </div>
           </button>
           <a href="password/reset">Reset Password?</a>
    </form>
</div>

@endsection
