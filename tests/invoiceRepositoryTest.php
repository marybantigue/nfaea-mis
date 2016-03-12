<?php

use App\Models\invoice;
use App\Repositories\invoiceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class invoiceRepositoryTest extends TestCase
{
    use MakeinvoiceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var invoiceRepository
     */
    protected $invoiceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->invoiceRepo = App::make(invoiceRepository::class);
    }

    /**
     * @test create
     */
    function it_creates_invoice()
    {
        $invoice = $this->fakeinvoiceData();
        $createdinvoice = $this->invoiceRepo->create($invoice);
        $createdinvoice = $createdinvoice->toArray();
        $this->assertArrayHasKey('id', $createdinvoice);
        $this->assertNotNull($createdinvoice['id'], 'Created invoice must have id specified');
        $this->assertNotNull(invoice::find($createdinvoice['id']), 'invoice with given id must be in DB');
        $this->assertModelData($invoice, $createdinvoice);
    }

    /**
     * @test read
     */
    function it_reads_invoices()
    {
        $invoice = $this->makeinvoice();
        $dbinvoice = $this->invoiceRepo->find($invoice->id);
        $dbinvoice = $dbinvoice->toArray();
        $this->assertModelData($invoice->toArray(), $dbinvoice);
    }

    /**
     * @test update
     */
    function it_updates_invoice()
    {
        $invoice = $this->makeinvoice();
        $fakeinvoice = $this->fakeinvoiceData();
        $updatedinvoice = $this->invoiceRepo->update($fakeinvoice, $invoice->id);
        $this->assertModelData($fakeinvoice, $updatedinvoice->toArray());
        $dbinvoice = $this->invoiceRepo->find($invoice->id);
        $this->assertModelData($fakeinvoice, $dbinvoice->toArray());
    }

    /**
     * @test delete
     */
    function it_deletes_invoice()
    {
        $invoice = $this->makeinvoice();
        $resp = $this->invoiceRepo->delete($invoice->id);
        $this->assertTrue($resp);
        $this->assertNull(invoice::find($invoice->id), 'invoice should not exist in DB');
    }
}