<ul>
    @foreach ($childrens as $child)
        <li>
            {{ $child->name }}
            @if (count($child->childrens))
                @include('web.partials.recursive.category',['childrens' => $child->childrens])
            @endif
        </li>
    @endforeach
</ul>

{{-- <li>{{ $category->name }}</li>


@if (count($category->childrenCategories) > 0)
    <ul>
        @foreach ($category->allChildrenCategories as $category)
            @include('web.partials.recursive.category', $category)
        @endforeach
    </ul>
@endif --}}

{{-- @foreach ($subcategory as $sub)
    <ul>
        <li>
            <a>
                {{ $sub->name }}
            </a>

        </li>
        @if (count($sub->subCategories))
            @include('backend.pages.product.category.subcategories',['subcategories' => $item->subcategory])
            @include('web.partials.recursive.category', [
                'subcategories' => $sub->subcategory
                ])
        @endif
    </ul>
@endforeach --}}
