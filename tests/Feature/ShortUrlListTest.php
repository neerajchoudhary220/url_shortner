<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortUrlListTest extends TestCase
{

    use RefreshDatabase;
    protected function createTestUser(string $role):User{
            return User::factory()->withRole($role)->create();
    }
    public function test_member_can_see_their_own_short_url_list_but_cannot_see_another_member_short_urls()
    {
        $member1 = $this->createTestUser('Member');
        $member2 = $this->createTestUser('Member');
        $this->actingAs($member1);
        // Authorized member can access their own urls
        $res1 = $this->get(route(
            'shortUrl.list',
            [
                'company_id' => $member1->company->id,
                'user_id' => $member1->id
            ]
        ));

        $res1->assertStatus(200);

        //Authorized member cannot access to another member's url's
        $res2 = $this->get(route(
            'shortUrl.list',
            [
                'company_id' => $member2->company->id,
                'user_id' => $member2->id
            ]
        ));
        $res2->assertStatus(403);
    }

    public function test_admin_can_see_their_own_short_url_list_but_cannot_set_another_member_short_urls()
    {
        $admin1 = $this->createTestUser('Admin');
        $admin2 = $this->createTestUser('Admin');
        $this->actingAs($admin1);
        //Authorized member access their own compnay urls
        $res1 = $this->get(route(
            'shortUrl.list',
            [
                'company_id' => $admin1->company->id,
            ]
        ));
        $res1->assertStatus(200);

        //Authorized member cannot access other admin's company
        $res2=$this->get(route( 'shortUrl.list',
        [
            'company_id' => $admin2->company->id,
        ]));
        $res2->assertStatus(403);


    }


    public function test_super_admin_can_see_all_the_short_url_list()
    {
        $admin = $this->createTestUser('Admin'); //creating short urls by admin
        $superAdmin =$this->createTestUser('SuperAdmin');
        $this->actingAs($superAdmin);
        $this->assertAuthenticatedAs($superAdmin); //Check super admin is authenticated
        $response_for_short_url_list = $this->get(route('shortUrl.list', $admin->company_id));
        $response_for_short_url_list->assertStatus(200);
    }
}
