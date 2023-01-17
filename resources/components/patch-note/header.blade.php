<h3>
    @if (!empty($version))
        Versão: {{ $version }}
    @endif

    @if (!empty($title))
        > {{ $title }}
    @endif

    @if (!empty($date))
        <span class="patch-note-date">
            adicionado em {{ $date }}
        </span>
    @endif
</h3>
