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
        $count=10;
        $member = User::factory()->withRole('Member')->withShortUrls($count)->create();
        $this->assertDatabaseCount('short_urls',$count); //Verify number of short urls records
        $this->actingAs($member);
        $response_for_short_url_list = $this->get(route('shortUrl.list', $member->company_id));
        $response_for_short_url_list->assertStatus(200);
    }

    public function test_admin_can_see_the_short_url_list()
    {
        $count=10;
        $member = User::factory()->withRole('Member')->withShortUrls($count)->create();
        $this->assertDatabaseCount('short_urls',$count); //Verify number of short urls records
        $admin = User::factory()->withRole('Admin')->create();
        $this->actingAs($admin);
        $this->assertAuthenticatedAs($admin); //Check admin is authenticated

        $response_for_short_url_list = $this->get(route('shortUrl.list', $member->company_id));
        $response_for_short_url_list->assertStatus(200);
    }


    public function test_super_admin_can_see_all_short_url_list()
    {
        $count=10;
        $admin = User::factory()->withRole('admin')->withShortUrls($count)->create();//creating short urls by admin
        $this->assertDatabaseCount('short_urls',$count); //Verify number of short urls records
        $superAdmin = User::factory()->withRole('SuperAdmin')->create();
        $this->actingAs($superAdmin);
        $this->assertAuthenticatedAs($superAdmin); //Check super admin is authenticated
        $response_for_short_url_list = $this->get(route('shortUrl.list', $admin->company_id));
        $response_for_short_url_list->assertStatus(200);
    }
}
