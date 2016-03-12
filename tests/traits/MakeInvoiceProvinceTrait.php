<?php

use Faker\Factory as Faker;
use App\Models\InvoiceProvince;
use App\Repositories\InvoiceProvinceRepository;

trait MakeInvoiceProvinceTrait
{
    /**
     * Create fake instance of InvoiceProvince and save it in database
     *
     * @param array $invoiceProvinceFields
     * @return InvoiceProvince
     */
    public function makeInvoiceProvince($invoiceProvinceFields = [])
    {
        /** @var InvoiceProvinceRepository $invoiceProvinceRepo */
        $invoiceProvinceRepo = App::make(InvoiceProvinceRepository::class);
        $theme = $this->fakeInvoiceProvinceData($invoiceProvinceFields);
        return $invoiceProvinceRepo->create($theme);
    }

    /**
     * Get fake instance of InvoiceProvince
     *
     * @param array $invoiceProvinceFields
     * @return InvoiceProvince
     */
    public function fakeInvoiceProvince($invoiceProvinceFields = [])
    {
        return new InvoiceProvince($this->fakeInvoiceProvinceData($invoiceProvinceFields));
    }

    /**
     * Get fake data of InvoiceProvince
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInvoiceProvinceData($invoiceProvinceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->randomDigitNotNull,
			'invoice_id' => $fake->randomDigitNotNull,
			'province_id' => $fake->randomDigitNotNull,
			'created_at' => $fake->word,
			'updated_at' => $fake->word
        ], $invoiceProvinceFields);
    }
}