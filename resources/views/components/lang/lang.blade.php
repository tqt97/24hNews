<div class="callout callout-danger">
    {{ __('Language current :') }}
    @foreach (LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
        @if (get_current_edit_locale() == $localeCode)
            <strong>
                [{{ $properties['name'] }}]
            </strong>
            {{ __('editting') }}
        @endif
    @endforeach
    <br>
    {{ __('Other language :') }}

    @foreach (LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
        @if (get_current_edit_locale() != $localeCode)
            <a href="{{ Request::fullUrlWithQuery(['edit_locale' => $localeCode]) }}">
                <strong>
                    [{{ $properties['name'] }}]
                </strong>
            </a>
        @endif
    @endforeach
</div>
