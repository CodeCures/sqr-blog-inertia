@extends('layouts.app')

@section('content')
<div>
    <div class="container mx-auto">
        <x-form-header>
            <x-slot:title>Login</x-slot>
            <x-slot:description>Want to be heard? Login to create something Ipsium</x-slot>
        </x-form-header>
        <x-validation-errors />
        <form class="pt-8" method="POST" action="{{ route('auth.login') }}">
          @csrf
          <div class="flex flex-col">
            <div class="w-full sm:mr-3">
              <x-label>Email Address</x-label>
              <x-input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email here..." />
            </div>
            <div class="w-full pt-6 mt-4">
                <x-label>Password </x-label>
                <x-input type="password" name="password" placeholder="Enter your password here..." />
            </div>
          </div>
          <x-button type="submit" class="mt-10 mb-12">Login</x-button>
        </form>
      </div>
    </div>
  </div>
@endsection