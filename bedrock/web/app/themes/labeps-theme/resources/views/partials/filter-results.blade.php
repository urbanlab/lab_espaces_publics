@if ($posts && count($posts) > 0)
    @foreach ($posts as $post)
        {{-- Vous pouvez utiliser des directives Blade pour traiter différemment chaque type de contenu --}}
        @if ($post_type === 'inspirations')
            {{-- Affichage spécifique pour les inspirations --}}
        @elseif ($post_type === 'projects')
            {{-- Affichage spécifique pour les projets --}}
        @elseif ($post_type === 'ressources')
            {{-- Affichage spécifique pour les ressources --}}
        @else
            {{-- Affichage par défaut --}}
        @endif
    @endforeach
@else
    <p>Aucun contenu trouvé.</p>
@endif
