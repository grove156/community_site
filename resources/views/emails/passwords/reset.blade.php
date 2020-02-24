Hello {{$user->name}}. For reset your passwords, open the links below:
{{route('users.confirm', $user->confirm_code)}}
