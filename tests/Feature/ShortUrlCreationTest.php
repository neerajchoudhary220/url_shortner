<?php

namespace Tests\Feature;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortUrlCreationTest extends TestCase
{
    use RefreshDatabase;
    protected function createShortUrl(User $user, string $url = 'https://www.xyz.com/')
    {
        $this->actingAs($user);
        return $this->post(route('shortUrl.generate'), [
            'original_url' => $url,
        ]);
    }


    public function test_admin_can_create_short_url_and_see_the_list()
    {
        $admin = User::factory()->withRole('Admin')->create();
        $response = $this->createShortUrl($admin);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $company_id = $admin->company_id;
        //Verify data in short_urls table
        $this->assertDatabaseHas('short_urls', [
            'original_url' => 'https://www.xyz.com/',
            'user_id' => $admin->id,
            'company_id' => $company_id
        ]);

        //check admin short url list
        $response_for_short_url_list = $this->get(route('shortUrl.list', $company_id));
        $response_for_short_url_list->assertStatus(200);
    }

    public function test_member_can_create_short_url_and_see_list()
    {
        $member = User::factory()->withRole('Member')->create();
        $response = $this->createShortUrl($member);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors(); //for check validation faild session
        $company_id = $member->company_id;
        $this->assertDatabaseHas('short_urls', [
            'user_id' => $member->id,
            'company_id' => $company_id
        ]);

        //check member short url list
        $response_for_short_url_list = $this->get(route('shortUrl.list', $company_id));
        $response_for_short_url_list->assertStatus(200);
    }

    public function test_super_admin_cannot_create_short_url()
    {
        $superAdmin = User::factory()->withRole('SuperAdmin')->create();
        $response = $this->createShortUrl($superAdmin);
        $response->assertForbidden(403);
        $this->assertDatabaseMissing('short_urls', [
            'user_id' => $superAdmin->id
        ]);
    }

    public function test_short_url_publicly_resolvable_and_redirect_to_the_original_url(){
        $user = User::factory()->withRole('Admin')->create();
        $company = $user->company;
        $short_url = ShortUrl::factory()->for($user)->for($company)->create();
        $short_code = $short_url->short_code;

        //verify short url data
        $this->assertDatabaseHas('short_urls',[
            'id'=>$short_url->id,
            'company_id'=>$short_url->company_id,
            'original_url'=>$short_url->original_url,
            'short_code'=>$short_code,
        ]);

        $response_original_url = $this->get(route('shortUrl.redirect',$short_code));
        $response_original_url->assertRedirect();

    }
}
