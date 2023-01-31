@if ($categoryParent->categoryChildrent->count())
    <ul role="menu" class="sub-menu">
        @foreach ($categoryParent->categoryChildrent as $categoryChild)
            <li>
                <a href="{{ route('category.product', ['slug' => $categoryChild->slug, 'id' => $categoryChild->id]) }}">{{ $categoryChild->name }}</a>
                @if ($categoryChild->categoryChildrent->count())
                    @include('client.components.child_menu', [
                        'categoryParent' => $categoryChild,
                    ])
                @endif
            </li>
        @endforeach
    </ul>
@endif
