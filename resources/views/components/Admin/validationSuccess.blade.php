@if (session('result'))
        <div>
            <div class="alert alert-success h3" role="alert">
                <span><i class="fas fa-check-circle text-white font"></i></span>  {{ session('result') }}
            </div>
        </div>
@endif
