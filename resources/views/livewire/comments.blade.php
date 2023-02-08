<div class="md:container md:mx-auto px-4">
    <div class="bg-slate-50">
        <div class="mx-auto w-1/2 bg-slate-100">
            @if (session()->has('feedback'))
            <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                    {{ session('feedback') }}
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            @endif
            @error('comment')
            <div id="alert-2" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                    {{ $message }}
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            @enderror
            <section class="mb-2">
                @if ($image)
                <img src="{{ $image }}" alt="" class="w-42 h-36 img-thumbnail img-fluid border rounded-md hover:shadow-md cursor-pointer">
                    
                @endif
                <input type="file" wire:change="$emit('imageSelected')" id="image">
            </section>
            <div class="flex">

                <form wire:submit.prevent="{{$method}}(Object.fromEntries(new FormData($event.target)))" class="flex min-w-0 w-full">
                    <input type="text" name="comment" wire:model.debounce.500ms="comment" class="rounded-none rounded-l-lg bg-gray-50 border text-gray-900 focus:ring-blue-50 focus:border-blue-500 block flex-1 min-w-0 w-full  text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your comment..">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900  bg-blue-700 hover:bg-blue-800 rounded-r-md border border-r-0 h-full border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-md text-sm w-full h-full sm:w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+ {{ $action }}</button>
                    </span>
                </form>
            </div>
            @forelse ($comments as $cmt )
            <div class="pt-5">
                <div class="block p-6 md:w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <div class="flex-row md:flex-column">
                        <h5 class="w-5/6 mb-2 text-2xl font-normal tracking-tight text-gray-900 dark:text-white">{{ $cmt->comment }}</h6>
                            <div class="mr-1 w-1/6 space-x-5 float-right">
                                <div class="flex space-x-3 md:mt-1">
                                    <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="editComment({{$cmt->id}})">Edit</a>
                                    <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-red-700 rounded-lg border border-red-300 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-200 dark:bg-red-800 dark:text-white dark:border-red-600 dark:hover:bg-red-700 dark:hover:border-red-700 dark:focus:ring-red-700" wire:click="deleteComment({{$cmt->id}})">Delete</a>
                                </div>

                            </div>
                            @if ($cmt->image)
                                <img src="/storage/{{ $cmt->image }}" alt="" class="w-48 h-42 img-fluid py-1">
                            @endif
                    </div>
                    <p>{{ $cmt->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <div class="py-5">
                <p style="text-align: center;">No Comments yet!</p>
            </div>
            @endforelse
            <div class="py-3">
                {{ $comments->links() }}

            </div>
            <!-- {{ $comment }} -->
        </div>
    </div>

</div>
<script>
    window.livewire.on('imageSelected', () => {
        let fileInput = document.getElementById('image')
        let file = fileInput.files[0]
        
        let reader = new FileReader();

        reader.onloadend = () => {
            window.livewire.emit('uploadImage', reader.result)
        }
        reader.readAsDataURL(file)
    })
</script>
