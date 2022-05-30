@extends('layouts.app')

@section('content')
<div>
    <div class="container mx-auto">
      <div class="pt-16 lg:pt-20">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                {{-- flash messages --}}

                @if (session()->has('msg'))
                    <div class="p-3 border border-1 border-green-500 text-green-500 rounded">
                        {{ session('msg') }}
                    </div>
                @endif
              <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="flex items-center justify-between mb-2">
                      <form>
                        <label for="">Sort By Date:</label>
                        <select name="order" id="" onchange="this.closest('form').submit()">
                          <option selected disabled>choose order</option>
                          <option value="ASC">Ascending order</option>
                          <option value="DESC">Descending order</option>
                        </select>
                      </form>
                    <a
                    href="{{ route('post.create') }}"
                    class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none  hover:bg-indigo-600 focus:outline-none focus:shadow-outline float-right"
                  >
                    Create Post
                  </a>
                  </div>
                <div class="overflow-hidden">
                  <table class="min-w-full text-center">
                    <thead class="border-b bg-gray-50">
                      <tr>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                          Title
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                          Date
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                          Action
                        </th>
                      </tr>
                    </thead class="border-b">
                    <tbody class="text-sm text-gray-900 font-light">
                        @forelse ($posts as $post)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 whitespace-nowrap">
                              {{ Str::words($post->title, 3, '...') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $post->publicationDate() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-1">
                                <x-link href="{{ route('posts.show', $post->slug) }}" class="hover:bg-blue-500 text-blue-700 border border-blue-500">
                                  view
                                </x-link>

                                @can('update-post')
                                  <x-link href="{{ route('post.edit', $post) }}" class="hover:bg-yellow-500 text-yellow-700 border border-yellow-500">
                                    edit
                                  </x-link>
                                @endcan

                                @can('delete-post', $post)
                                  <form method="POST" action="{{ route('post.destroy', $post) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-link onclick="this.closest('form').submit()" href="javascript:void(0)" class="hover:bg-red-500 text-red-700 border border-red-500">
                                      delete
                                    </x-link>
                                  </form>
                                @endcan
                            </td>
                          </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-sm font-medium text-gray-900 px-6 py-4">You have no posts yet!</td>
                            </tr>
                        @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          {{-- pagination links --}}
          <div class="flex items-center justify-between mt-5">
            <div></div>
            <div class="flex">
              <x-pagination-links :paginator="$posts" />
            </div>
          </div>
      </div>
    </div>
</div>
@endsection


