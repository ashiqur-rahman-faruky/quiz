<ul class="sidenav-subnav collapse">
    @foreach($childs as $child)

        <li>

            <a href="{{URL::to($child->url)}}"><span><i class="fa fa-circle-thin" aria-hidden="true"></i></span> &nbsp; {{ $child->title }}</a>


            @if(count($child->childs))

                @include('backendlayout.manageChild',['childs' => $child->childs])

            @endif

        </li>

    @endforeach
</ul>