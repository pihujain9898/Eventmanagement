<?php
declare(strict_types=1);

namespace App\Test\TestCase\Middleware;

use App\Middleware\UserRoleMiddleware;
use Cake\TestSuite\TestCase;

/**
 * App\Middleware\UserRoleMiddleware Test Case
 */
class UserRoleMiddlewareTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Middleware\UserRoleMiddleware
     */
    protected $UserRole;

    /**
     * Test process method
     *
     * @return void
     * @uses \App\Middleware\UserRoleMiddleware::process()
     */
    public function testProcess(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
