@props(['id' => null, 'maxWidth' => null,'eventCall'=>null,'leftFooter'=>false])
@php
$eventCallfixed = "'".$eventCall."'";
@endphp

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>


    <div class="bg-white rounded yo li ol ou" @click.outside="show = true; {{ $eventCall != null?'window.livewire.emit('.$eventCallfixed.')':'' }}" @keydown.escape.window="show = true; {{ $eventCall != null?'window.livewire.emit('.$eventCallfixed.')':'' }}">
         <!-- Modal header -->         
         <div class="px-5 py-3 border-b border-slate-200">
            <div class="flex justify-between items-center">
               <div class="font-semibold text-slate-800">{{ $title }}</div>
               <button class="text-slate-400 hover:text-slate-500" wire:click="{{ $eventCall != null?$eventCall:'' }}" @click="show = false">
                     <div class="sr-only">Close</div>
                     <svg class="w-4 h-4 fill-current">
                        <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                     </svg>
               </button>
            </div>
         </div>
         <!-- Modal content -->
         <div class="px-5 pt-4 pb-1">
             {{ $content }}
         </div>
         <!-- Modal footer -->
         @if($leftFooter == true)
         <div class="px-5 py-4 border-t border-slate-200">
            <div class="flex justify-between space-x-2">
               {{ $footer }}
            </div>
         </div>
         @else
         <div class="px-5 py-4 border-t border-slate-200">
            <div class="flex flex-wrap justify-end space-x-2">
               {{ $footer }}
            </div>
         </div>
         @endif
      </div>

      

</x-jet-modal>
