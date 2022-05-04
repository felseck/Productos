@props(['id', 'maxWidth','eventCall'])

@php
$id = $id ?? md5($attributes->wire('model'));

$maxWidth = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
    '2x1' => 'max-w-2x1',
    '2x1-5' => 'max-w-2x1-5',    
][$maxWidth ?? 'lg'];



@endphp

<div
    x-data="{
        show: @entangle($attributes->wire('model')).defer,
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'

            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
       
    }"  
    x-init="$watch('show', value => { 
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            
            
            document.body.classList.remove('overflow-y-hidden');

        }
    })"
    x-on:close.stop="show = false;"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    id="{{ $id }}"
    class=""
    style="display: none;"
>



    <!-- Modal backdrop -->
                                            <div
                                            class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="show"
                                            x-on:click="show = false" x-transition:enter="yh yx yy" x-transition:enter-start="opacity-0" x-transition:enter-end="yr" x-transition:leave="yh yx yg" x-transition:leave-start="yr" x-transition:leave-end="opacity-0" aria-hidden="true" style="display: none;"></div>

   
       <!-- Modal dialog -->
                                            <div 
                                            x-data="{ 
                                                scrollTop: () => { 
                                                    
                                                    //$el.scrollTo(0, $el.scrollHeight*-1); 
                                                    
                                                    /*$el.scrollTo({
                                                    top: 0,                                                    
                                                    left: $el.scrollHeight*-1,
                                                    behavior: 'smooth'
                                                    });*/
                                                     
                                                },                                               
                                                reactOnScroll() {
                                                    /*console.log('pepe',this.$el.getBoundingClientRect().top);
                                                    this.$el.getBoundingClientRect().scrollTop
                                                    console.log('pepe2',this.$el.getBoundingClientRect().top);*/

                                                    window.Livewire.on('scroll',()=>{
                                                        console.log('pepe scroll');
                                                        $el.scrollTo({
                                                        top: 0,                                                    
                                                        left: $el.scrollHeight*-1,
                                                        behavior: 'smooth'
                                                        });
                                                    })
                                                   
                                                } 
                                            }"                                       
                                            class="fixed overflow-auto inset-0 z-50 flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="show" x-transition:enter="yh yw yy" x-transition:enter-start="opacity-0 ao" x-transition:enter-end="yr ai" x-transition:leave="yh yw yy" x-transition:leave-start="yr ai" x-transition:leave-end="opacity-0 ao" style="display: none;">
                                              
                                            <div 
                                              
                                            class="bg-white rounded shadow-lg  {{ $maxWidth }} w-full max-h-full" @click.outside="show = false" @keydown.escape.window="show = false"
                                                   
                                            x-init="reactOnScroll()"
                                            x-on:scroll="reactOnScroll()"
                                            >                                            
                                            {{ $slot }}
                                            </div>
    </div>
</div>
