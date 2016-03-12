<?php

use App\Models\InvoiceMember;
use App\Repositories\InvoiceMemberRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoiceMemberRepositoryTest extends TestCase
{
    use MakeInvoiceMemberTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InvoiceMemberRepository
     */
    protected $invoiceMemberRepo;

    public function setUp()
    {
        parent::setUp();
        $this->invoiceMemberRepo = App::make(InvoiceMemberRepository::class);
    }

    /**
     * @test create
     */
    function it_creates_invoice_member()
    {
        $invoiceMember = $this->fakeInvoiceMemberData();
        $createdInvoiceMember = $this->invoiceMemberRepo->create($invoiceMember);
        $createdInvoiceMember = $createdInvoiceMember->toArray();
        $this->assertArrayHasKey('id', $createdInvoiceMember);
        $this->assertNotNull($createdInvoiceMember['id'], 'Created InvoiceMember must have id specified');
        $this->assertNotNull(InvoiceMember::find($createdInvoiceMember['id']), 'InvoiceMember with given id must be in DB');
        $this->assertModelData($invoiceMember, $createdInvoiceMember);
    }

    /**
     * @test read
     */
    function it_reads_invoice_members()
    {
        $invoiceMember = $this->makeInvoiceMember();
        $dbInvoiceMember = $this->invoiceMemberRepo->find($invoiceMember->id);
        $dbInvoiceMember = $dbInvoiceMember->toArray();
        $this->assertModelData($invoiceMember->toArray(), $dbInvoiceMember);
    }

    /**
     * @test update
     */
    function it_updates_invoice_member()
    {
        $invoiceMember = $this->makeInvoiceMember();
        $fakeInvoiceMember = $this->fakeInvoiceMemberData();
        $updatedInvoiceMember = $this->invoiceMemberRepo->update($fakeInvoiceMember, $invoiceMember->id);
        $this->assertModelData($fakeInvoiceMember, $updatedInvoiceMember->toArray());
        $dbInvoiceMember = $this->invoiceMemberRepo->find($invoiceMember->id);
        $this->assertModelData($fakeInvoiceMember, $dbInvoiceMember->toArray());
    }

    /**
     * @test delete
     */
    function it_deletes_invoice_member()
    {
        $invoiceMember = $this->makeInvoiceMember();
        $resp = $this->invoiceMemberRepo->delete($invoiceMember->id);
        $this->assertTrue($resp);
        $this->assertNull(InvoiceMember::find($invoiceMember->id), 'InvoiceMember should not exist in DB');
    }
}