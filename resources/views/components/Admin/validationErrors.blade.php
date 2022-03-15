@props(['errors'])

@if ($errors->any())


        <div class="alert alert-danger ml-4 ">
            <div class="alert-title font-semibold text-lg text-red-800">
               <span class="text-red-500 bg-red-500">
                <i class="fas fa-exclamation-triangle"></i>
            </span> {{ __('Whoops, something went wrong') }}
            </div>
            <div class="alert-description text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>

@endif
