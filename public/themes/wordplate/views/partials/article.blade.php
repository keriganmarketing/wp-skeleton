{{ the_post() }}

<article>
    @if(has_post_thumbnail())
    <figure class="figure float-md-left mr-md-4">
        <a href="{{ the_permalink() }}" title="{{ the_title_attribute() }}">
        {{ the_post_thumbnail('post-thumbnail', ['class' => 'figure-img img-fluid rounded']) }}
        </a>
    </figure>
    @endif
    <header>
        {{ get_the_date() }}
        <h2>{{ the_title() }}</h2>
    </header>

    {{ the_excerpt() }}
    <a href="{{ the_permalink() }}" >Read more</a>
    <hr>
</article>