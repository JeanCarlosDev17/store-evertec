@props(['errors'])

@if ($errors->any())

    <script src="https://kit.fontawesome.com/2ccb5d9a99.js" crossorigin="anonymous"></script>
        <div class="alert alert-danger ml-4 ">
            <div class="alert-title font-semibold text-lg text-red-800">
{{--               <span class="text-red-500 bg-red-500">--}}
               <span class="">
                <i class="fas fa-exclamation-triangle" class="text-white"></i>

            </span> {{ __('Whoops, something went wrong') }}
            </div>
            <div class="alert-description text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>

@endif
