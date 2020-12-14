<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h1>
    @include('partials/entry-meta')
  </header>

  <div class="entry-content">
    @php the_content() @endphp
  </div>

  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>

  @php comments_template('/partials/comments.blade.php') @endphp
</article>
