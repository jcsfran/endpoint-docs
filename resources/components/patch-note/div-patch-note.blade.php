<div class="patch-note-div">
    <x-patch-note.header :version="$info['version']" :title="$info['title']" :date="$info['date']" />

    @if (isset($info['content']))

        @foreach ($info['content'] as $content)
            @php
                if (empty($content['tag'])) {
                    $content['tag'] = '';
                }

                if (empty($content['description'])) {
                    $content['description'] = '';
                }

                if (empty($content['routes'])) {
                    $content['routes'] = [];
                }
            @endphp
            <x-patch-note.content :tag="$content['tag']" :description="$content['description']" :routes="$content['routes']" />
        @endforeach
    @else
        <span>Sem informações</span>
    @endif

</div>
