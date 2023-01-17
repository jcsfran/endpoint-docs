<table class="patch-note-table">
    <tr>
        <th>
            Descrição
        </th>
        <th>
            Ação
        </th>
        <th>
            Método
        </th>
        <th>
            Endpoint
        </th>
    </tr>
    @foreach ($routes as $route)
        @if (!empty($route['description']))
            @php
                $description = $route['description'];
            @endphp
        @else
            @php
                $description = '';
            @endphp
        @endif

        @if (!empty($route['action']))
            @php
                $action = $route['action'];
            @endphp
        @else
            @php
                $action = '';
            @endphp
        @endif

        @if (!empty($route['method']))
            @php
                $method = $route['method'];
            @endphp
        @else
            @php
                $method = '';
            @endphp
        @endif

        @if (!empty($route['endpoint']))
            @php
                $endpoint = $route['endpoint'];
            @endphp
        @else
            @php
                $endpoint = '';
            @endphp
        @endif

        <x-patch-note.table-tr :description="$description" :action="$action" :method="$method" :endpoint="$endpoint" />
    @endforeach
</table>
