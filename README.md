# User

[![Build Status](https://travis-ci.org/activecollab/user.svg?branch=master)](https://travis-ci.org/activecollab/user)

User interface describes a single user:

1. ID (if available),
2. First name,
3. Last name,
4. Email address.

First and last name can be parsed from full name, or full name can be assembled from first and last name, depending on
strategy that you select for implementation.

## Identified and Unidentified Visitors

This library offers two solid classes: `ActiveCollab\User\UnidentifiedVisitor` is a visitor that we know nothing about, and `ActiveCollab\User\IdentifiedVisitor` which describe a single user who announces their identity by providing their email address and optionally full name.

```php
$user = new ActiveCollab\User\IdentifiedVisitor('Ilija Studen', 'ilija@example.com');

print $user->getFirstName() . "\n";
print $user->getLastName() . "\n";
print $user->formatName(ActiveCollab\User\UserInterface::NAME_INITIALS) . "\n";
```

## Users with Accounts

If the app has a concept of users with accounts, these classes should implement `ActiveCollab\User\UserInterface` and provide access to required properties: 

1. User ID, 
2. User's email address,
3. User's first and last name or full name.

Depending on what you have stored for #3, you can use one of the two traits to get most of the UserInterface implementation pasted to your user classes:

1. `ActiveCollab\User\UserInterface\ImplementationUsingFirstAndLastName`
2. `ActiveCollab\User\UserInterface\ImplementationUsingFullName`

## Serialization

All instances that implement `ActiveCollab\User\UserInterface` can be serialized to JSON:

```php
$user = new ActiveCollab\User\IdentifiedVisitor('Ilija Studen', 'ilija@example.com');
print_r(json_decode(json_encode($user), true));
```

will output:

```
(
    [id] => 0
    [class] => ActiveCollab\User\IdentifiedVisitor
    [first_name] => Ilija
    [last_name] => Studen
    [full_name] => Ilija Studen
    [email] => ilija@example.com
)
```

## Comparing Users

`UserInterface::is()` method is handy when you need to check if a particular user instance is the same person as another instance:

```php
$user1 = new ActiveCollab\User\IdentifiedVisitor('John Doe', 'john@example.com');
$user2 = new ActiveCollab\User\IdentifiedVisitor('Jane Doe', 'jane@example.com');

if ($user1->is($user2)) {
    print "Same person\n";
} else {
    print "Not the same person\n";
}
```

Users with accounts (ID > 0) are compared by their ID, and visitors without an account are compared by their email address. Comparisons are not mixed, so user with account will never be identified as visitor, even when their email addresses match. 
