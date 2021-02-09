
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h6 class="alert-heading font-size-h6 font-w400">{{ session("title", false) ?: trans("messages.success.title") }}</h6>
        <p class="mb-0"> {{session('success')}}</p>
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h6 class="alert-heading font-size-h6 font-w400">@lang('messages.error.title')</h6>
        <p class="mb-0">
            @lang('messages.error.message')
        </p>
    </div>
@endif
