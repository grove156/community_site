Welcome {{$user->name}}. For verifications, open the links below:
{{route('users.confirm', $user->confirm_code)}}
