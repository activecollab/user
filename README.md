# User

User interface describes a single user:

1. ID (if available),
2. First name,
3. Last name,
4. Email address.

First and last name can be parsed from full name, or full name can be assembled from first and last name, depending on
strategy that you select for implementation.

Only solid class that this library offers is `ActiveCollab\User\AnonymousUser` which describe a single user who
announces their identity by providing their email address and optionally full name.

```php
$user = new ActiveCollab\User\AnonymousUser('Ilija Studen', 'ilija@example.com');

print $user->getFirstName() . "\n";
print $user->getLastName() . "\n";
print $user->formatName(ActiveCollab\User\UserInterface::NAME_INITIALS) . "\n";
```

All instances that implement `ActiveCollab\User\UserInterface` can be serialized to JSON:

```php
$user = new ActiveCollab\User\AnonymousUser('Ilija Studen', 'ilija@example.com');
print_r(json_decode(json_encode($user), true));
```

will output:

```
(
    [id] => 0
    [class] => ActiveCollab\User\AnonymousUser
    [first_name] => Ilija
    [last_name] => Studen
    [full_name] => Ilija Studen
    [email] => ilija@example.com
)
```