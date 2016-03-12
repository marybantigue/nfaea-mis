<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoiceMemberApiTest extends TestCase
{
    use MakeInvoiceMemberTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    function it_can_create_invoice_members()
    {
        $invoiceMember = $this->fakeInvoiceMemberData();
        $this->json('POST', "/api/v1/invoiceMembers", $invoiceMember);

        $this->assertApiResponse($invoiceMember);
    }

    /**
     * @test
     */
    function it_can_read_invoice_member()
    {
        $invoiceMember = $this->makeInvoiceMember();
        $this->json("GET", "/api/v1/invoiceMembers/{$invoiceMember->id}");

        $this->assertApiResponse($invoiceMember->toArray());
    }

    /**
     * @test
     */
    function it_can_update_invoice_member()
    {
        $invoiceMember = $this->makeInvoiceMember();
        $editedInvoiceMember = $this->fakeInvoiceMemberData();

        $this->json('PUT', "/api/v1/invoiceMembers/{$invoiceMember->id}", $editedInvoiceMember);

        $this->assertApiResponse($editedInvoiceMember);
    }

    /**
     * @test
     */
    function it_can_delete_invoice_members()
    {
        $invoiceMember = $this->makeInvoiceMember();
        $this->json("DELETE", "/api/v1/invoiceMembers/{$invoiceMember->id}");

        $this->assertApiSuccess();
        $this->json("GET", "/api/v1/invoiceMembers/{$invoiceMember->id}");

        $this->assertResponseStatus(404);
    }

}
