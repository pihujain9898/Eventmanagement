<?php
declare(strict_types=1);

namespace App\Test\TestCase\Middleware;

use App\Middleware\UsersMiddleware;
use Cake\TestSuite\TestCase;

/**
 * App\Middleware\UsersMiddleware Test Case
 */
class UsersMiddlewareTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Middleware\UsersMiddleware
     */
    protected $Users;

    /**
     * Test process method
     *
     * @return void
     * @uses \App\Middleware\UsersMiddleware::process()
     */
    public function testProcess(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
