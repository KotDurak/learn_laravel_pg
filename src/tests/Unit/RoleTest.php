<?php

namespace Tests\Unit;

use App\Service\RoleService;
use PHPUnit\Framework\TestCase;

//docker-compose run --rm artisan test --filter RoleTest
class RoleTest extends TestCase
{
    protected RoleService $roleService;

    public function setUp(): void
    {
        parent::setUp();
        $this->roleService = resolve(RoleService::class);
    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_create_role()
    {
        $role = $this->roleService->createRole('test');
        $this->assertEquals($role->name, 'test');
    }
    public function test_has_default()
    {
        $role = $this->roleService->createRole('admin');
        $this->assertContains($role->name, $this->roleService->getDefaultRoles());
    }

    public function test_default_roles_count()
    {
        $this->assertCount(3, $this->roleService->getDefaultRoles());
    }

    public function test_for_empty()
    {
        $this->assertEmpty([]);
        $this->assertNotEmpty($this->roleService->getDefaultRoles());
    }
}
