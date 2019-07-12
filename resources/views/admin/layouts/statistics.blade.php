<div class="row">
    @foreach($items as $item)
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><i
                                    class="mdi {{ $item['icon'] }} display-4"></i></div>
                        <div class="align-self-center">
                            <h4 class="text-muted m-t-10 m-b-0">{{ $item['name'] }}</h4>
                            <h2 class="m-t-0">{{ $item['count'] }}</h2></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>