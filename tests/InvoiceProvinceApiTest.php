<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoiceProvinceApiTest extends TestCase
{
    use MakeInvoiceProvinceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    function it_can_create_invoice_provinces()
    {
        $invoiceProvince = $this->fakeInvoiceProvinceData();
        $this->json('POST', "/api/v1/invoiceProvinces", $invoiceProvince);

        $this->assertApiResponse($invoiceProvince);
    }

    /**
     * @test
     */
    function it_can_read_invoice_province()
    {
        $invoiceProvince = $this->makeInvoiceProvince();
        $this->json("GET", "/api/v1/invoiceProvinces/{$invoiceProvince->id}");

        $this->assertApiResponse($invoiceProvince->toArray());
    }

    /**
     * @test
     */
    function it_can_update_invoice_province()
    {
        $invoiceProvince = $this->makeInvoiceProvince();
        $editedInvoiceProvince = $this->fakeInvoiceProvinceData();

        $this->json('PUT', "/api/v1/invoiceProvinces/{$invoiceProvince->id}", $editedInvoiceProvince);

        $this->assertApiResponse($editedInvoiceProvince);
    }

    /**
     * @test
     */
    function it_can_delete_invoice_provinces()
    {
        $invoiceProvince = $this->makeInvoiceProvince();
        $this->json("DELETE", "/api/v1/invoiceProvinces/{$invoiceProvince->id}");

        $this->assertApiSuccess();
        $this->json("GET", "/api/v1/invoiceProvinces/{$invoiceProvince->id}");

        $this->assertResponseStatus(404);
    }

}
