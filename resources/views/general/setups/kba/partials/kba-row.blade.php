<tr>
    @if($level == 0)
   <td style="padding-bottom: 25px; padding-top: 25px;">{{$i}}</td>
   @else
   <td></td>
   @endif
    <td class="text-center" style="padding-bottom: 25px; padding-top: 25px;">
        {!! str_repeat('&nbsp;', $level * 4) !!}
        {{ $kba['name'] }}
    </td>
    <td class="text-center" style="padding-bottom: 25px; padding-top: 25px;">
        @if (isset($kba['children']) && count($kba['children']) > 0)
            -
        @else
            {{ $kba['weightage'] }}%
        @endif
    </td>
</tr>

@if (isset($kba['children']))
    @foreach ($kba['children'] as $child)
        @include('general.setups.kba.partials.kba-row', ['kba' => $child, 'level' => $level + 1])
    @endforeach
@endif
