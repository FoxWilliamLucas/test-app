<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Helpers\ResponseStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceTest extends TestCase
{
    // use RefreshDatabase;

    public function setUp(): void{
        parent::setUp();
        // seed the database
        $this->artisan('migrate:refresh --seed');
    }


    public function testInvoiceIsCreatedSuccessfully() {

        $invoiceData = [
            'customer_id'   => '1',
            'start'         => '2021-01-01',
            'end'           => '2021-02-01',
        ];

        $this->json('post', 'api/invoices', $invoiceData)
             ->assertStatus(ResponseStatus::SUCCESS)
             ->assertJsonStructure([
                     'content' => [
                        'invoice_id',
                        'customer_id',
                        'start',
                        'end',
                     ]
            ]);

            $this->json('get', 'api/invoices/1')
            ->assertStatus(ResponseStatus::SUCCESS)
            ->assertJsonStructure([
                'content' => [
                    'id',
                    'start',
                    'end',
                    'invoiced_events',
                    'customer_id',
                    'registered_frequency',
                    'activated_frequency',
                    'appointment_frequency',
                    'total_price',
                    'registered_price',
                    'activated_price',
                    'appointment_price',
                    'users' => [ '*' => ['email', 'calculated_events', 'price']],
                    'created_at',
                    'updated_at',
                ]
            ]);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowReturnsDataValidFormat()
    {
        $invoiceData = [
            'customer_id'   => '1',
            'start'         => '2021-01-01',
            'end'           => '2021-02-01',
        ];

        $this->json('post', 'api/invoices', $invoiceData)
            ->assertStatus(ResponseStatus::SUCCESS)
            ->assertJsonStructure([
                    'content' => [
                    'invoice_id',
                    'customer_id',
                    'start',
                    'end',
                    ]
        ]);

        $this->json('get', 'api/invoices/1')
        ->assertStatus(ResponseStatus::SUCCESS)
        ->assertJsonStructure([
            'content' => [
                'id',
                'start',
                'end',
                'invoiced_events',
                'customer_id',
                'registered_frequency',
                'activated_frequency',
                'appointment_frequency',
                'total_price',
                'registered_price',
                'activated_price',
                'appointment_price',
                'users' => [ '*' => ['email', 'calculated_events', 'price']],
                'created_at',
                'updated_at',
            ]
        ]);
    }



    public function testInvoicePeriodsWillNeverOverlap() {

        $invoiceData = [
            'customer_id'   => '1',
            'start'         => '2021-01-01',
            'end'           => '2021-02-01',
        ];

        $this->json('post', 'api/invoices', $invoiceData)
             ->assertStatus(ResponseStatus::SUCCESS)
             ->assertJsonStructure([
                     'content' => [
                        'invoice_id',
                        'customer_id',
                        'start',
                        'end',
                     ]
            ]);

        $this->json('post', 'api/invoices', $invoiceData)
        ->assertStatus(ResponseStatus::VALIDATION_ERROR);
    }

}
