<div class="container mx-auto header-background pt-20 md:pt-56">
    @php(the_content())
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'labeps-theme'), 'after' => '</p></nav>']) !!}    
</div>
