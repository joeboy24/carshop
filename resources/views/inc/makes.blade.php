

<div class="col-md-2 by_model_left">
    <h6>Search By Make</h6>
    @foreach ($makes as $item)
      <a href="/cardash/{{$item->id}}"><p class="model_name"><img src="{{ \App\Support\Media::url('classified/makes/'.$item->logo) }}" alt=""><span>{{$item->model_name}}</span></p></a>
    @endforeach
    <a class="show_more_gray" href="/more_makes">View more</a>
</div>