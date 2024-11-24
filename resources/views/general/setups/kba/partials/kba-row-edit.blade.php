<tr>
    <td>
        @if ($level == 0)
            {{ $index + 1 }}
        @endif
    </td>
    <td>
        <input 
                type="hidden" 
                name="kbas[{{ $index }}][id]" 
                value="{{ old('kbas.' . $index . '.id', $kba['id'] ?? '') }}" 
            >
        <input type="text" 
               name="kbas[{{ $index }}][name]" 
               value="{{ $kba['name'] }}" 
               class="form-control" 
               placeholder="Enter KBA name" 
               required>
    </td>
    <td>
        @if (isset($kba['children']) && count($kba['children']) > 0)
            <span>-</span>
        @else
            <input type="number" 
                   name="kbas[{{ $index }}][weight]" 
                   value="{{ $kba['weightage'] ?? 0 }}" 
                   class="form-control weight-input" 
                   min="0" 
                   max="100" 
                   required>
        @endif
    </td>
</tr>
@if (isset($kba['children']))
    @foreach ($kba['children'] as $childIndex => $child)
        @include('general.setups.kba.partials.kba-row-edit', ['kba' => $child, 'level' => $level + 1, 'index' => "{$index}.children.{$childIndex}"])
    @endforeach
@endif
