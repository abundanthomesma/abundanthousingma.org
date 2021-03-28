<h1 class="page-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h1>
@php the_content() @endphp
{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
