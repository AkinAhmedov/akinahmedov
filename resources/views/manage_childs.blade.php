<ul class="overflow-scroll">
    @foreach($childs->sortBy('category') as $child)
        <li><a href="/search/category/{{$child->id}}"> {{$child->category}}</a>
            @if(count($child->childs))
                @include('manage_childs',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
