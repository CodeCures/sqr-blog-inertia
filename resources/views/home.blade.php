@extends('layouts.app')

@section('content')
<div>
    <div class="container mx-auto">
      <div class="py-16 lg:py-20">
        <div>
          <img src="{{ asset('assets/img/icon-blog.png') }}" alt="icon envelope" />
        </div>

        <h1 class="pt-5 font-body text-4xl font-semibold text-primary dark:text-white md:text-5xl lg:text-6xl">
          Blog
        </h1>

        <div class="pt-3 sm:w-3/4">
          <p class="font-body text-xl font-light text-primary dark:text-white">
            Articles, tutorials, snippets, rants, and everything else. Subscribe for
            updates as they happen.
          </p>
        </div>

        <form class="flex flex-col py-12 sm:flex-row">
            <x-input type="text" name="search" placeholder="Search a post here…" value="{{ request('search') }}" />
            <x-button type="submit">Search</x-button>
        </form>

        <div class="pt-8 lg:pt-12">
          @forelse ($posts as $post)
              <x-post-item :post="$post" />
          @empty
              <div class="text-2xl text-center font-bold">No Record Found!</div>
          @endforelse
        </div>

        <div class="flex pt-8 lg:pt-16">
            <x-pagination-links :paginator="$posts" />
        </div>
      </div>
    </div>
  </div>
@endsection
