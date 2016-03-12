<?php

use App\Models\help_members;
use App\Repositories\help_membersRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class help_membersRepositoryTest extends TestCase
{
    use Makehelp_membersTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var help_membersRepository
     */
    protected $helpMembersRepo;

    public function setUp()
    {
        parent::setUp();
        $this->helpMembersRepo = App::make(help_membersRepository::class);
    }

    /**
     * @test create
     */
    function it_creates_help_members()
    {
        $helpMembers = $this->fakehelp_membersData();
        $createdhelp_members = $this->helpMembersRepo->create($helpMembers);
        $createdhelp_members = $createdhelp_members->toArray();
        $this->assertArrayHasKey('id', $createdhelp_members);
        $this->assertNotNull($createdhelp_members['id'], 'Created help_members must have id specified');
        $this->assertNotNull(help_members::find($createdhelp_members['id']), 'help_members with given id must be in DB');
        $this->assertModelData($helpMembers, $createdhelp_members);
    }

    /**
     * @test read
     */
    function it_reads_help_members()
    {
        $helpMembers = $this->makehelp_members();
        $dbhelp_members = $this->helpMembersRepo->find($helpMembers->id);
        $dbhelp_members = $dbhelp_members->toArray();
        $this->assertModelData($helpMembers->toArray(), $dbhelp_members);
    }

    /**
     * @test update
     */
    function it_updates_help_members()
    {
        $helpMembers = $this->makehelp_members();
        $fakehelp_members = $this->fakehelp_membersData();
        $updatedhelp_members = $this->helpMembersRepo->update($fakehelp_members, $helpMembers->id);
        $this->assertModelData($fakehelp_members, $updatedhelp_members->toArray());
        $dbhelp_members = $this->helpMembersRepo->find($helpMembers->id);
        $this->assertModelData($fakehelp_members, $dbhelp_members->toArray());
    }

    /**
     * @test delete
     */
    function it_deletes_help_members()
    {
        $helpMembers = $this->makehelp_members();
        $resp = $this->helpMembersRepo->delete($helpMembers->id);
        $this->assertTrue($resp);
        $this->assertNull(help_members::find($helpMembers->id), 'help_members should not exist in DB');
    }
}