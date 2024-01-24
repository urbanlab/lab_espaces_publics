<div class="wp-block-accordion {{ $data->className ?? '' }}">
    @isset ($data->title)
      <h2>{!! $data->title !!}</h2>
    @endisset
  
    <div>
      {!! $content ?? 'Please feed me InnerBlocks.' !!}
    </div>
  </div>