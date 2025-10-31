<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\CrewMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminSmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed rôles/permissions
        $this->seed(\Database\Seeders\RolesPermissionsSeeder::class);
    }

    private function adminUser(): User
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        return $user;
    }

    public function test_admin_can_list_and_create_crew(): void
    {
        Storage::fake('public');
        $admin = $this->adminUser();

        // LISTE
        $this->actingAs($admin)
            ->get('/admin/crew')
            ->assertOk();

        // CREATE (form)
        $this->get('/admin/crew/create')->assertOk();

        // STORE
        $resp = $this->post('/admin/crew', [
            'name'  => 'Jean Test',
            'role'  => 'Ingénieur',
            'bio'   => 'Bio courte',
            'image' => UploadedFile::fake()->image('p.jpg', 600, 600),
        ]);
        $resp->assertRedirect('/admin/crew');
        $this->assertDatabaseHas('crew_members', ['name' => 'Jean Test']);
    }

    public function test_admin_can_edit_and_delete_crew(): void
    {
        $admin = $this->adminUser();
        $member = CrewMember::factory()->create();

        // EDIT (form)
        $this->actingAs($admin)
            ->get("/admin/crew/{$member->id}/edit")
            ->assertOk();

        // UPDATE
        $this->put("/admin/crew/{$member->id}", [
            'name' => 'Nouveau Nom',
            'role' => 'Commandant',
            'bio'  => 'Maj',
        ])->assertRedirect('/admin/crew');

        $this->assertDatabaseHas('crew_members', ['id'=>$member->id, 'name'=>'Nouveau Nom']);

        // DELETE
        $this->delete("/admin/crew/{$member->id}")
             ->assertRedirect();
        $this->assertDatabaseMissing('crew_members', ['id'=>$member->id]);
    }

    public function test_non_admin_is_forbidden(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/admin/crew')->assertForbidden();
    }
}
