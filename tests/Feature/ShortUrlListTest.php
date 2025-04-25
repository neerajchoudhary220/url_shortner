<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortUrlListTest extends TestCase
{
    use RefreshDatabase;
    public function test_member_can_see_the_short_url_list()
    {
        $member = User::factory()->withRole('Member')->withShortUrls(10)->create();
        $this->actingAs($member);
        $response_for_short_url_list = $this->get(route('shortUrl.list', $member->company_id));
        $response_for_short_url_list->assertStatus(200);
    }

    public function test_admin_can_see_the_short_url_list()
    {
        $member = User::factory()->withRole('Member')->withShortUrls(10)->create();
        $admin = User::factory()->withRole('Admin')->create();
        $this->actingAs($admin);
        $this->assertAuthenticatedAs($admin); //check admin is authenticated

        $response_for_short_url_list = $this->get(route('shortUrl.list', $member->company_id));
        $response_for_short_url_list->assertStatus(200);
    }


    public function test_super_admin_can_see_all_short_url_list()
    {
        $admin = User::factory()->withRole('admin')->withShortUrls(10)->create();//creating short urls by admin
        $superAdmin = User::factory()->withRole('SuperAdmin')->create();
        $this->actingAs($superAdmin);
        $this->assertAuthenticatedAs($superAdmin); //check super admin is authenticated
        $response_for_short_url_list = $this->get(route('shortUrl.list', $admin->company_id));
        $response_for_short_url_list->assertStatus(200);
    }
}
