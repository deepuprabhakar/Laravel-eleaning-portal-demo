<div class="box box-primary side-news">
  <div class="box-header with-border">
    <h3 class="box-title">Latest Articles</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    @if(empty($latest))
      <div class="callout callout-warning">
        <h4>Oops!</h4>
        <p>No articles added yet.</p>
      </div>
    @endif
    <ul class="products-list product-list-in-box">
    @foreach ($latest as $articles)
      <li class="item">
        <div class="product-info">
          <a href="{{ route('articles.show', $articles->slug) }}" class="product-title">
            {{ str_limit($articles->title, 30) }} 
            <span class="label label-info pull-right">
              {{ $articles->created_at->diffForHumans() }}
            </span>
          </a>
        </div>
      </li><!-- /.item -->
    @endforeach
    </ul>
  </div><!-- /.box-body -->
  <div class="box-footer text-center">
    <a href="{{ route('articles.index') }}" class="uppercase">View More</a>
  </div><!-- /.box-footer -->
</div>