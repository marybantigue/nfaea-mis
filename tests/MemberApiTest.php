<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MemberApiTest extends TestCase
{
    use MakeMemberTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    function it_can_create_members()
    {
        $member = $this->fakeMemberData();
        $this->json('POST', "/api/v1/members", $member);

        $this->assertApiResponse($member);
    }

    /**
     * @test
     */
    function it_can_read_member()
    {
        $member = $this->makeMember();
        $this->json("GET", "/api/v1/members/{$member->id}");

        $this->assertApiResponse($member->toArray());
    }

    /**
     * @test
     */
    function it_can_update_member()
    {
        $member = $this->makeMember();
        $editedMember = $this->fakeMemberData();

        $this->json('PUT', "/api/v1/members/{$member->id}", $editedMember);

        $this->assertApiResponse($editedMember);
    }

    /**
     * @test
     */
    function it_can_delete_members()
    {
        $member = $this->makeMember();
        $this->json("DELETE", "/api/v1/members/{$member->id}");

        $this->assertApiSuccess();
        $this->json("GET", "/api/v1/members/{$member->id}");

        $this->assertResponseStatus(404);
    }

}
