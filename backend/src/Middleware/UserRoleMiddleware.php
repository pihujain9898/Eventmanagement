<?php
declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Cake\Http\Exception\ForbiddenException;

/**
 * UserRole middleware
 */
class UserRoleMiddleware implements MiddlewareInterface
{
    /**
     * Process method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The request handler.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    // public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    // {
    //     pr($request->getAttribute('identity')['user_role']); die;
    //     return $handler->handle($request);
    // }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $user = $request->getAttribute('identity');
        $prefix = $request->getParam('prefix');
        // pr($prefix. "   ".$user['user_role']); die;

        if(isset($user) && isset($user) && $user['user_role'] == 2){
            return $handler->handle($request);
        }

        if (($prefix === 'User') && isset($user) && $user['user_role'] != 0) {
            throw new ForbiddenException('Access Forbidden');
        }

        if (($prefix === 'Organiser') && isset($user) && $user['user_role'] != 1) {
            throw new ForbiddenException('Access Forbidden');
        }

        if ($prefix === 'Admin' && isset($user) && $user['user_role'] != 2) {
            throw new ForbiddenException('Access Forbidden');
        }
        
        // throw new ForbiddenException('Access Forbidden');
        return $handler->handle($request);
    }
}
