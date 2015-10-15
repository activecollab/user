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