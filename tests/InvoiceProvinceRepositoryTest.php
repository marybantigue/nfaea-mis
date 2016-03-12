<?php

use App\Models\InvoiceProvince;
use App\Repositories\InvoiceProvinceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoiceProvinceRepositoryTest extends TestCase
{
    use MakeInvoiceProvinceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InvoiceProvinceRepository
     */
    protected $invoiceProvinceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->invoiceProvinceRepo = App::make(InvoiceProvinceRepository::class);
    }

    /**
     * @test create
     */
    function it_creates_invoice_province()
    {
        $invoiceProvince = $this->fakeInvoiceProvinceData();
        $createdInvoiceProvince = $this->invoiceProvinceRepo->create($invoiceProvince);
        $createdInvoiceProvince = $createdInvoiceProvince->toArray();
        $this->assertArrayHasKey('id', $createdInvoiceProvince);
        $this->assertNotNull($createdInvoiceProvince['id'], 'Created InvoiceProvince must have id specified');
        $this->assertNotNull(InvoiceProvince::find($createdInvoiceProvince['id']), 'InvoiceProvince with given id must be in DB');
        $this->assertModelData($invoiceProvince, $createdInvoiceProvince);
    }

    /**
     * @test read
     */
    function it_reads_invoice_provinces()
    {
        $invoiceProvince = $this->makeInvoiceProvince();
        $dbInvoiceProvince = $this->invoiceProvinceRepo->find($invoiceProvince->id);
        $dbInvoiceProvince = $dbInvoiceProvince->toArray();
        $this->assertModelData($invoiceProvince->toArray(), $dbInvoiceProvince);
    }

    /**
     * @test update
     */
    function it_updates_invoice_province()
    {
        $invoiceProvince = $this->makeInvoiceProvince();
        $fakeInvoiceProvince = $this->fakeInvoiceProvinceData();
        $updatedInvoiceProvince = $this->invoiceProvinceRepo->update($fakeInvoiceProvince, $invoiceProvince->id);
        $this->assertModelData($fakeInvoiceProvince, $updatedInvoiceProvince->toArray());
        $dbInvoiceProvince = $this->invoiceProvinceRepo->find($invoiceProvince->id);
        $this->assertModelData($fakeInvoiceProvince, $dbInvoiceProvince->toArray());
    }

    /**
     * @test delete
     */
    function it_deletes_invoice_province()
    {
        $invoiceProvince = $this->makeInvoiceProvince();
        $resp = $this->invoiceProvinceRepo->delete($invoiceProvince->id);
        $this->assertTrue($resp);
        $this->assertNull(InvoiceProvince::find($invoiceProvince->id), 'InvoiceProvince should not exist in DB');
    }
}