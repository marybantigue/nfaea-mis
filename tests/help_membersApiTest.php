<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class help_membersApiTest extends TestCase
{
    use Makehelp_membersTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    function it_can_create_help_members()
    {
        $helpMembers = $this->fakehelp_membersData();
        $this->json('POST', "/api/v1/helpMembers", $helpMembers);

        $this->assertApiResponse($helpMembers);
    }

    /**
     * @test
     */
    function it_can_read_help_members()
    {
        $helpMembers = $this->makehelp_members();
        $this->json("GET", "/api/v1/helpMembers/{$helpMembers->id}");

        $this->assertApiResponse($helpMembers->toArray());
    }

    /**
     * @test
     */
    function it_can_update_help_members()
    {
        $helpMembers = $this->makehelp_members();
        $editedhelp_members = $this->fakehelp_membersData();

        $this->json('PUT', "/api/v1/helpMembers/{$helpMembers->id}", $editedhelp_members);

        $this->assertApiResponse($editedhelp_members);
    }

    /**
     * @test
     */
    function it_can_delete_help_members()
    {
        $helpMembers = $this->makehelp_members();
        $this->json("DELETE", "/api/v1/helpMembers/{$helpMembers->id}");

        $this->assertApiSuccess();
        $this->json("GET", "/api/v1/helpMembers/{$helpMembers->id}");

        $this->assertResponseStatus(404);
    }

}
