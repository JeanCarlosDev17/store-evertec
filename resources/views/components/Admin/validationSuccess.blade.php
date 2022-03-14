{{--<div id="validationSuccess"></div>--}}
@if (session('result'))
        <div id="success-alert">
            <div class="alert alert-success h3" role="alert">
                <span><i class="fas fa-check-circle text-white font"></i></span> {{ session('result') }}
            </div>
        </div>
    @section('js')
        <script>

            $(document).ready(function() {
                $("#success-alert").fadeTo(6000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
            })
        </script>
    @stop
@endif
