@extends('layouts.app')

@section('content')
<div>
    <div class="container mx-auto">
      <div class="py-16 lg:py-20">
        <x-form-header>
            <x-slot:title>Register</x-slot>
            <x-slot:description>You can't afford to miss this, Lorem is your Ipsium</x-slot>
        </x-form-header>

        <x-validation-errors />

        <form action="{{ route('auth.register') }}" class="pt-16" method="POST">
            @csrf
          <div class="flex flex-col">
            <div class="w-full">
              <x-label>Username</x-label>
              <x-input type="test" name="name" value="{{ old('name') }}" placeholder="Enter your username here..."  />
            </div>

            <div class="w-full mt-5">
                <x-label>Email Address</x-label>
                <x-input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email here..."  />
            </div>

            <div class="w-full mt-5">
                <x-label>Password</x-label>
                <x-input type="password" name="password" placeholder="Enter your password here..."  />
            </div>

            <div class="w-full mt-5">
                <x-label>Repeat Password</x-label>
                <x-input type="password" name="password_confirmation" placeholder="Enter your password confirmation here..."  />
            </div>
          </div>
          <x-button type="submit" class="mt-10 mb-12">Register</x-button>
        </form>
      </div>
    </div>
  </div>
@endsection