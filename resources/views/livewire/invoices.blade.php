<div>

   <div class="sm:flex sm:justify-between sm:items-center mb-8">

      <!-- Left: Title -->
      <div class="mb-4 sm:mb-0">
         <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">{{__($pageTitle) }} ✨</h1>
      </div>

      <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

         <!-- Filter button -->
         <div class="relative inline-flex">
         <!-- Start -->
               <form>                        
                  <div class="relative">
                  <input id="form-search" class="form-input w-full pl-9" type="search" wire:model="filter" placeholder="{{__('Search') }}" />
                  <button class="absolute inset-0 right-auto group" type="submit" aria-label="Search">
                        <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 group-hover:text-slate-500 ml-3 mr-2" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                           <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                           <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                        </svg>
                  </button>
               </div>
            </form>
            <!-- End -->
         </div>

         <!-- Add customer button -->
         <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" wire:click="generate_invoices">
            <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                  <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
            </svg>
            <span class="hidden xs:block ml-2">Generate invoices</span>
         </button>                            
         
      </div>

   </div>

      <div class="bg-white shadow-lg rounded-sm border border-slate-200">
         <header class="px-5 py-4">
            <h2 class="font-semibold text-slate-800">Total <span class="text-slate-400 font-medium">{{$rows->total()}}</span></h2>
         </header>
         <div x-data="">

            <!-- Table -->
            <div class="overflow-x-auto">
                  <table class="table-auto w-full">
                     <!-- Table header -->
                     <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">                                   
                              
                     
                           <tr>                        
                              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                 <div class="font-semibold text-left">{{__('Actions') }}</div>
                              </th>
                              @foreach ($fieldsOptions as $key=>$fieldOptions)
                                 @php ($fieldOptions = (object) $fieldOptions)
                                 @if($fieldOptions->show)
                                 <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    @if($fieldOptions->locale_label)
                                    <div class="font-semibold text-left">{{__($fieldOptions->label)}}</div>
                                    @else
                                    <div class="font-semibold text-left">{{$fieldOptions->label}}</div>
                                    @endif
                                 </th>
                                 @endif
                              @endforeach  
                  
                              
                              <th>
                                Client
</th>

                              <th>
                                 Products
</th>
                        </tr>
                     </thead>
                     <!-- Table body -->
                     <tbody class="text-sm divide-y divide-slate-200">
                        @foreach ($rows as $key=>$row)
                        @php ($rowAttr = $row->toArray())
                           <!-- Row -->
                           <tr>                             
                                 <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                    <!-- Start -->
                                    <div class="relative inline-flex" x-data="{ open: false }">
                                          <button
                                             class="text-slate-400 hover:text-slate-500 rounded-full"
                                             :class="{ 'bg-slate-100 text-slate-500': open }"
                                             aria-haspopup="true"
                                             @click.prevent="open = !open"
                                             :aria-expanded="open"
                                          >
                                             <span class="sr-only">Menu</span>
                                             <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                <circle cx="16" cy="16" r="2" />
                                                <circle cx="10" cy="16" r="2" />
                                                <circle cx="22" cy="16" r="2" />
                                             </svg>
                                          </button>
                                          <div
                                             class="origin-top-right z-10 absolute top-full left-0 min-w-36 bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1"                
                                             @click.outside="open = false"
                                             @keydown.escape.window="open = false"
                                             x-show="open"
                                             x-transition:enter="transition ease-out duration-200 transform"
                                             x-transition:enter-start="opacity-0 -translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             x-transition:leave="transition ease-out duration-200"
                                             x-transition:leave-start="opacity-100"
                                             x-transition:leave-end="opacity-0"
                                             x-cloak                
                                          >
                                             <ul>
                                                <li>
                                                      <a wire:click="openEditModal({{$key}})" class="font-medium text-sm text-slate-600 hover:text-slate-800 flex py-1 px-3" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">{{__('Edit')}}</a>
                                                </li>
                                                <li>
                                                      <a wire:click="openDeleteModal({{$key}})" class="font-medium text-sm text-slate-600 hover:text-slate-800 flex py-1 px-3" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">{{__('Delete')}}</a>
                                                </li>                                                
                                             </ul>
                                          </div>
                                    </div>
                                    <!-- End -->                                    
                                 </td>

                                 @foreach ($fieldsOptions as $key_=>$fieldOptions)
                                    @php ($fieldOptions = (object) $fieldOptions)
                                    @if($fieldOptions->show)
                                       
                                       <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap {{$fieldOptions->thClass}}">
                                          @if(isset($fieldOptions->sub_field))
                                             <div class="font-semibold text-left">
                                                @if(isset($rowAttr[$fieldOptions->field][$fieldOptions->sub_field]))
                                                {{ $rowAttr[$fieldOptions->field][$fieldOptions->sub_field] }}                                         
                                                @endif                                       
                                             </div>
                                          @else
                                             <div class="font-semibold text-left">{{$rowAttr[$fieldOptions->field]}}
                                             </div>
                                          @endif
                                       </td>
                                    
                                    @endif
                                 @endforeach


                                 <td>

{{$row->user()->name}}

</td>


                                 <td>

                                 @foreach($row->purchases()->get() as $purchase)

                                 {{$purchase->product_name}},

                                 @endforeach
</td>
                           </tr>
                        
                        @endforeach
                     </tbody>
                  </table>

            </div>
         </div>        

      </div>

      <!-- Pagination -->      
      <div class="ij">
            <div class="text-sm text-slate-500 text-center sm:text-left">
            <p id="pagination"><span class="text-slate-600">{{ __('Showing') }}</span> <span class="font-medium text-slate-600">{{$rows->firstItem()}}</span> <span class="text-slate-600">{{ __('to') }}</span> <span class="font-medium text-slate-600">{{$rows->lastItem()}}</span> <span class="text-slate-600">{{ __('of') }}</span> <span class="font-medium text-slate-600">{{$rows->total()}}</span> <span class="text-slate-600">{{ __('results') }}</span></p>
            </div>         
            <div>
            {{ $rows->links() }}
            </div>
      </div>
      

   <x-jet-dialog-modal wire:model="addRowModal" maxWidth="lg">
      <x-slot name="title">
         {{ __('Add') }}
      </x-slot>
      <x-slot name="content">

         @foreach ($fieldsOptions as $key=>$fieldOptions)
           @php ($fieldOptions = (object) $fieldOptions)
           @if($fieldOptions->creatable)

               <div class="col-span-6 sm:col-span-4 mt-4">
                  <x-jet-label for="{{$fieldOptions->field}}_{{$key}}_{{$key}}" value="{{__($fieldOptions->label) }}" />
                  <x-jet-input id="{{$fieldOptions->field}}_{{$key}}_{{$key}}" type="text" class="tr ol" wire:model.defer="creatableFields.{{$fieldOptions->field}}" />
               </div>
       

          @endif
      @endforeach

      </x-slot>
      <x-slot name="footer">
         <button wire:click="createCancel" class="btn border-slate-200 hover:border-slate-300 text-slate-600" wire:loading.attr="disabled">
         {{ __('Cancel') }}
         </button>
         <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" wire:click="createOk" wire:loading.attr="disabled">
            {{ __('Save') }}
         </button>
      </x-slot>

   </x-jet-dialog-modal>

   @if(isset($selectedIndex))
   @php ($row = $rows[$selectedIndex])
   @php ($rowAttr = $row->getAttributes())
      <x-jet-dialog-modal wire:model="deleteRowModal">
         <x-slot name="title">
            <h2 class="vk text-gray-800 font-bold im">{{ __('Delete row') }}</h2>
         </x-slot>
         <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 mt-4">
               <div>
                  <div class="flex flex-wrap items-center rj">
                  {{ __('Are you sure you want to remove this row?') }} 
                  </div>
               </div>
            </div>
         </x-slot>
         <x-slot name="footer">
            <button wire:click="deleteCancel" class="btn border-slate-200 hover:border-slate-300 text-slate-600" wire:loading.attr="disabled">
            {{ __('Cancel') }}
            </button>
            <button class="btn bg-rose-500 hover:bg-rose-600 text-white" wire:click="deleteOk({{ $row->id}})" wire:loading.attr="disabled">
               {{ __('Delete') }}
            </button>
         </x-slot>
      </x-jet-dialog-modal>

      <x-jet-dialog-modal wire:model="editRowModal">
         <x-slot name="title">
            <h2 class="vk text-gray-800 font-bold im">{{__('Edit') }}</h2>
         </x-slot>
         <x-slot name="content">
            @foreach ($fieldsOptions as $key=>$fieldOptions)
            @php ($fieldOptions = (object) $fieldOptions)
            @if($fieldOptions->editable)
            <div class="col-span-6 sm:col-span-4 mt-4">
               @if($fieldOptions->locale_label)
               <x-jet-label for="{{$fieldOptions->field}}_{{$row->id}}" value="{{__($fieldOptions->label)}}" />
               @else
               <x-jet-label for="{{$fieldOptions->field}}_{{$row->id}}" value="{{$fieldOptions->label}}" />
               @endif            
               <x-jet-input  id="{{$fieldOptions->field}}_{{$row->id}}" type="text" class="tr ol" wire:model.defer="editableFields.{{$fieldOptions->field}}" placeholder="{{$rowAttr[$fieldOptions->field]}}" />
            </div>
            @endif
            @endforeach
         </x-slot>
         <x-slot name="footer">
            <button wire:click="editCancel" class="btn border-slate-200 hover:border-slate-300 text-slate-600" wire:loading.attr="disabled">
            {{ __('Cancel') }}
            </button>
            <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" wire:click="editOk({{$row->id}})" wire:loading.attr="disabled">
            {{ __('Save') }}
            </button>
         </x-slot>
      </x-jet-dialog-modal>
   @endif

</div>
