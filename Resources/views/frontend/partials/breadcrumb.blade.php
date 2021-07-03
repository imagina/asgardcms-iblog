<x-isite::breadcrumb>
  <li class="breadcrumb-item text-capitalize store-index" aria-current="page">
    @if(isset($category->id) || isset($manufacturer->id))
      <a href="{{\URL::route(\LaravelLocalization::getCurrentLocale() . '.iblog.blog.index')}}">
        {{ trans('iblog::routes.blog.index.index') }}
      </a>
    @else
      {{ trans('iblog::routes.blog.index.index') }}
    @endif
  </li>
  
  @isset($categoryBreadcrumb)
    @foreach($categoryBreadcrumb as $key => $breadcrumb)
      <li class="breadcrumb-item category-index {{($key == count($categoryBreadcrumb)-1) ? 'category-index-selected' : ''}}" aria-current="page">
        @if($key == count($categoryBreadcrumb)-1 && !isset($post->id))
            {{ $breadcrumb->title }}
        @else
          <a href="{{$breadcrumb->url}}">{{ $breadcrumb->title }}</a>
        @endif
      </li>
    @endforeach
  @endif
  
  @if(isset($post->id))
    <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
  @endif
  
  @if(isset($tag->id))
    <li class="breadcrumb-item active" aria-current="page">{{$tag->name}}</li>
  @endif
  

</x-isite::breadcrumb>
