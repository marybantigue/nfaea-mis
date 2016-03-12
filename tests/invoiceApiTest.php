<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class invoiceApiTest extends TestCase
{
    use MakeinvoiceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    function it_can_create_invoices()
    {
        $invoice = $this->fakeinvoiceData();
        $this->json('POST', "/api/v1/invoices", $invoice);

        $this->assertApiResponse($invoice);
    }

    /**
     * @test
     */
    function it_can_read_invoice()
    {
        $invoice = $this->makeinvoice();
        $this->json("GET", "/api/v1/invoices/{$invoice->id}");

        $this->assertApiResponse($invoice->toArray());
    }

    /**
     * @test
     */
    function it_can_update_invoice()
    {
        $invoice = $this->makeinvoice();
        $editedinvoice = $this->fakeinvoiceData();

        $this->json('PUT', "/api/v1/invoices/{$invoice->id}", $editedinvoice);

        $this->assertApiResponse($editedinvoice);
    }

    /**
     * @test
     */
    function it_can_delete_invoices()
    {
        $invoice = $this->makeinvoice();
        $this->json("DELETE", "/api/v1/invoices/{$invoice->id}");

        $this->assertApiSuccess();
        $this->json("GET", "/api/v1/invoices/{$invoice->id}");

        $this->assertResponseStatus(404);
    }

}
