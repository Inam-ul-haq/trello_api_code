<header id="header" data-transparent="true" data-fullwidth="true" class="dark submenu-light">
    <div class="header-inner">
        <div class="container">
            <!--Logo-->
            <div id="logo">
                <a href="{{ url('/') }}">
                    <span class="logo-default"><img src="{!! asset('home/images/logo.png') !!}" alt="" width="75px" height="75px"></span>
                    <span class="logo-dark"><img src="{!! asset('home/images/logo.png') !!}" alt="" width="75px" height="75px"></span>
                    
                </a>
            </div>
            <!--End: Logo-->
            <!-- Search -->
            <div id="search"><a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i></a>
                <form class="search-form" action="search-results-page.html" method="get">
                    <input class="form-control" name="q" type="text" placeholder="Type & Search..." />
                    <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
                </form>
            </div>
            <!-- end: search -->
            <!--Navigation Resposnive Trigger-->
            <div id="mainMenu-trigger">
                <a class="lines-button x"><span class="lines"></span></a>
            </div>
            <!--end: Navigation Resposnive Trigger-->
            <!--Navigation-->
            <div id="mainMenu">
                <div class="container">
                    <nav>
                        <ul>
                            @foreach ($category as $index => $cat)
                                @if ($cat->children->isNotEmpty())
                                    <li class="dropdown"><a href="#">{{ $cat->title }}</a>
                                        <ul class="dropdown-menu text-right">
                                            @foreach ($cat->children as $child)
                                                @if ($child->children->isNotEmpty())
                                                    <li class="dropdown-submenu menu-invert">
                                                        <a href="#">{{ $child->title }}</a>
                                                        <ul class="dropdown-menu text-right menu-invert">
                                                            @foreach ($child->children as $subChild)
                                                                @if ($subChild->children->isNotEmpty())
                                                                    <li class="dropdown-submenu">
                                                                        <a href="#">{{ $subChild->title }}</a>
                                                                        <ul class="dropdown-menu menu-invert">
                                                                            @foreach ($subChild->children as $subSubChild)
                                                                                <li>
                                                                                    <a href="{{ url('/view-detail/'.$subSubChild->id) }}">{{ $subSubChild->title }}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <a href="{{ url('/view-detail/'.$subChild->id) }}">{{ $subChild->title }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ url('/view-detail/'.$child->id) }}">{{ $child->title }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                @else
                                    <li><a href="{{ url('/view-detail/'.$cat->id) }}">{{ $cat->title }}</a>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
            <!--end: Navigation-->
        </div>
    </div>
</header>