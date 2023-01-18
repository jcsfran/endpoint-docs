<h3>
    @if (!empty($version))
        Versão: {{ $version }}
    @endif

    @if (!empty($title))
        > {{ $title }}
    @endif

    @if (!empty($date))
        <span class="patch-note-date">
            adicionado em {{ \Carbon\Carbon::parse($date)->isoFormat('DD/MM/YY') }}
        </span>
    @endif
</h3>
