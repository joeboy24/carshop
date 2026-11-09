

<div class="col-md-2 by_model_left">
    <h6>Search By Make</h6>
    @foreach ($makes as $item)
      <a href="/cardash/{{$item->id}}"><p class="model_name"><img src="/storage/classified/makes/{{$item->logo}}" alt=""><span>{{$item->model_name}}</span></p></a>
    @endforeach
    <a href="/more_makes"><button class="show_more_gray"><i class="fa fa-folder-open">&nbsp;</i>&nbsp;View More</button></a>
</div>