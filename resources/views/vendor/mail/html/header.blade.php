<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@elseif (trim($slot) === 'brefnew')
<img src="https://gplmschool.co.in/assets/images/gpl_logo.png" class="logo" alt="GPLM Schhol">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
