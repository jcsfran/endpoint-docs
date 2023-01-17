<tr>
    @if (!empty($description))
        <td>
            {{ $description }}
        </td>
    @endif

    @if (!empty($action))
        <td>
            {{ $action }}
        </td>
    @endif

    @if (!empty($method))
        <td>
            {{ $method }}
        </td>
    @endif

    @if (!empty($endpoint))
        <td>
            {{ $endpoint }}
        </td>
    @endif
</tr>
