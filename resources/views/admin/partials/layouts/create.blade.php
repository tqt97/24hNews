@extends('layouts.admin')

@section('content')
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="create" data-toggle="pill" href="#create-tab" role="tab"
                        aria-controls="create-tab" aria-selected="true">{{ __('General') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="seo" data-toggle="pill" href="#seo-tab" role="tab" aria-controls="seo-tab"
                        aria-selected="false">{{ __('SEO') }}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade active show" id="create-tab" role="tabpanel" aria-labelledby="create">
                    General tab
                </div>
                <div class="tab-pane fade" id="seo-tab" role="tabpanel" aria-labelledby="seo">
                    SEO tab
                </div>
            </div>
        </div>
    </div>
@endsection
