<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('app.main') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('app.main') }}">{{ __('app.menu.home') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('Категории товаров') }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route("app.catalog-by-category", $category) }}">
                                        {{ __($category->name) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.orders') }}">
                            {{ __('Заказы') }}
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav  mb-2 mb-lg-0 d-flex justify-content-end align-items-center">
                    @if ($currentUser)
                        <li class="nav-item text-light mx-3">
                            @if ($currentUser->cart)
                                <a href="{{ route('cart') }}"
                                    class="text-decoration-none header-cart">Корзина({{ $currentUser->cart->getTotalItems() }})</a>
                            @else
                                <a href="{{ route('cart') }}" class="header-cart">Корзина{{ $currentUser->cart }}</a>
                            @endif
                        </li>
                    @endif
                    @hasanyrole('super-admin|admin|moderator')
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ __('app.menu.dashboard') }}
                                </a>
                                <ul class="dropdown-menu">
                                    @hasanyrole('super-admin|admin|moderator')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('categoriesList') }}">
                                                {{ __('app.menu.categories') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('products.index') }}">
                                                {{ __('app.menu.products') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('conditions.index') }}">
                                                {{ __('Сonditions') }}
                                            </a>
                                        </li>
                                    @endhasanyrole
                                    @hasanyrole('super-admin|admin')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('users.index') }}">
                                                {{ __('Пользователи') }}
                                            </a>
                                        </li>
                                    @endhasanyrole
                                    @hasrole('super-admin')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('roles.index') }}">
                                                {{ __('Роли') }}
                                            </a>
                                        </li>
                                    @endhasrole
                                    @hasrole('super-admin')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('permissions.index') }}">
                                                {{ __('Права') }}
                                            </a>
                                        </li>
                                    @endhasrole
                                    @hasanyrole('super-admin|admin')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('orders.index') }}">
                                                {{ __('Управление заказами') }}
                                            </a>
                                        </li>
                                    @endhasanyrole
                                </ul>
                            </li>
                        </ul>
                    @endhasanyrole
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('language') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('app.change-lang', 'en') }}">
                                    English
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('app.change-lang', 'ru') }}">
                                    Русский
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if (auth()->user())
                        <li class="nav-item text-light mx-3">
                            {{ auth()->user()->name }}
                        </li>
                        <li class="nav-item text-light mx-3">
                            <form class="form-contol my-2" action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-danger">{{ __('app.menu.logout') }}</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('auth.register') }}">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('auth.loginPage') }}">Вход</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
