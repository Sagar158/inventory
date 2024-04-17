<tr>
    <td>{{ $permit['label'] }}</td>
    <td><input type="radio" name="permission[{{ $permit['permission'] }}]" value="1" {{ $userPermissions[$permit['permission']] == '1' ? 'checked' : '' }}></td>
    <td><input type="radio" name="permission[{{ $permit['permission'] }}]" value="0" {{ $userPermissions[$permit['permission']] == '0' ? 'checked' : '' }}></td>
</tr>
