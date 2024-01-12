@query($data)

@if(have_posts())
    <div class="custom-post-filter">
        <label for="cpt-category">Filtrer par catégorie :</label>
        <select id="cpt-category">
            <option value="all">Toutes les catégories</option>
            @foreach (get_terms(['taxonomy' => 'category', 'hide_empty' => false]) as $category)
                <option value="{{ $category->term_id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var select = document.getElementById('cpt-category');

            select.addEventListener('change', function () {
                var selectedCategory = this.value;
                var url = window.location.href.split('?')[0];

                if (selectedCategory !== 'all') {
                    url += '?category=' + selectedCategory;
                }

                window.location.href = url;
            });
        });
    </script>

    <div class="custom-post-block">
        <h2>Custom Posts</h2>
        <ul>
            @while(have_posts()) @php(the_post())
                <li><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></li>
            @endwhile
        </ul>
    </div>
@endif