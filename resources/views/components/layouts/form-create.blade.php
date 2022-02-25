<div class="row">
    <div class="col-sm-12">
        <x-lang.lang />
        <x-form.warning />
    </div>
    <div class="col-sm-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="create" data-toggle="pill" href="#create-tab" role="tab"
                            aria-controls="create-tab" aria-selected="true">{{ __('General') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="seo" data-toggle="pill" href="#seo-tab" role="tab"
                            aria-controls="seo-tab" aria-selected="false">{{ __('SEO') }}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <x-layouts.general>
                        {{ $slot }}
                    </x-layouts.general>
                    <x-layouts.seo>
                        <div class="col-sm-12">
                            <x-form.input label="{{ __('Title SEO') }}" name="title-seo"  />
                        </div>
                    </x-layouts.seo>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 fixed">
        <x-form.submit submit="{{ __('Add new') }}" reset="{{ __('Refresh') }}" />
    </div>
</div>
