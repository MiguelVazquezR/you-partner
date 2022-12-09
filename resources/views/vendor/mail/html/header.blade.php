<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'YouPartner')
<img src="{{asset('images/logo_claro.png')}}" class="logo" alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
