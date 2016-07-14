<?php

/*
 * This file is part of the Active Collab User project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\User\Test;

use ActiveCollab\User\IdentifiedVisitor;
use ActiveCollab\User\Test\Fixtures\UserWithAccount;
use ActiveCollab\User\UnidentifiedVisitor;

/**
 * @package ActiveCollab\User\Test
 */
class UserIsTest extends TestCase
{
    public function testUnidentifiedUsersCantBeCompared()
    {
        $this->assertFalse((new UnidentifiedVisitor())->is(new UnidentifiedVisitor()));
    }

    public function testMismatchBetweenUserWithAccountAndIdentifiedVisitor()
    {
        $user_with_account = new UserWithAccount(12, 'John Doe', 'john.doe@example.com');
        $identified_visitor = new IdentifiedVisitor('John Doe', 'john.doe@example.com');

        $this->assertFalse($user_with_account->is($identified_visitor));
        $this->assertFalse($identified_visitor->is($user_with_account));
    }

    public function testIdentifiedVisitorsAreComparedByEmail()
    {
        $identified_visitor_1 = new IdentifiedVisitor('John Doe', 'john.doe@example.com');
        $identified_visitor_2 = new IdentifiedVisitor('', 'john.doe@example.com');

        $this->assertTrue($identified_visitor_1->is($identified_visitor_2));
        $this->assertTrue($identified_visitor_2->is($identified_visitor_1));
    }

    public function testUsersWithAccountsAreComparedById()
    {
        $user_with_account_1 = new UserWithAccount(12, 'John Doe', 'john.doe@example.com');
        $user_with_account_2 = new UserWithAccount(12, 'Jane Doe', 'jane.doe@example.com');
        $user_with_account_3 = new UserWithAccount(15, 'John Smit', 'john.smith@example.com');

        $this->assertTrue($user_with_account_1->is($user_with_account_2));
        $this->assertTrue($user_with_account_2->is($user_with_account_1));

        $this->assertFalse($user_with_account_3->is($user_with_account_1));
        $this->assertFalse($user_with_account_3->is($user_with_account_2));
    }
}
