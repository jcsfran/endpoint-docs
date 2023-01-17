<p class="patch-note-content">
    @if (!empty($tag))
        <label class="patch-note-label-tag">
            Tag:
            <span class="patch-note-tag">
                {{ $tag }}
            </span>
        </label>
    @endif

    @if (!empty($description))
        <label class="patch-note-description">
            {{ $description }}
        </label>
    @endif

    @if (!empty($routes))
        <x-patch-note.table :routes="$routes" />
    @endif
</p>
