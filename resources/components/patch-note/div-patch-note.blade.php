<div class="patch-note-div">
    <x-patch-note.header :version="$info['version']" :title="$info['title']" :date="$info['date']" />

    @if (isset($info['content']))
        @foreach ($info['content'] as $content)
            <x-patch-note.content :content="$content" />
        @endforeach
    @else
        <span>Sem informações</span>
    @endif

</div>
