@if ($errors->any())
<div x-data="{isOpen: true}">
    <div x-show="isOpen" x-transition class="border border-1 p-5 text-xs text-red-500 rounded relative">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
      <a href="javascript:void(0)" class="font-bold text-lg absolute top-0 right-0 mr-2 mt-2" @click="isOpen = !isOpen">X</a>
    </div>
</div>
@endif
