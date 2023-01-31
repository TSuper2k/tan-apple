<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{ route('home') }}" class="active">Trang chủ</a></li>

        @foreach ($categoriesLimit as $categoryParent)
            <li class="dropdown"><a href="#">
                    {{ $categoryParent->name }}
                    <i class="fa fa-angle-down"></i></a>
                @include('client.components.child_menu', ['categoryParent' => $categoryParent])
            </li>
        @endforeach
    </ul>
</div>
