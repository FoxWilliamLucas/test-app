<?php

namespace App\Http\Controllers;

use App\Enums\Prices;
use App\Models\Invoice;
use App\Models\Customer;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Helpers\InvoiceHelper;
use App\Helpers\ResponseStatus;
use App\Http\Resources\InvoiceResource;
use App\Notifications\InvoiceNotification;
use Illuminate\Notifications\Notification;
use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Resources\InvoiceDetailsResource;

class InvoiceController extends Controller
{


    public function show(Invoice $invoice){
        try{
            $invoice->load('customer','customer.users', 'customer.users.sessions');
            return Response::respondSuccess(Response::SUCCESS, new InvoiceDetailsResource($invoice));
            // $invoicedEvents = $invoice->customer->users->map->getInvoicedEvents()->flatten();
            // return Response::respondSuccess(Response::SUCCESS, [
            //     'id'                        => $invoice->id,
            //     'start'                     => $invoice->start,
            //     'end'                       => $invoice->end,    
            //     'invoiced_events'           => $invoicedEvents,
            //     'customer_id'               => $invoice->customer_id,
            //     'registered_frequency'      => $invoice->customer->users->map(function($user)use($invoice){
            //                         return InvoiceHelper::dateBetween(
            //                             $user->registered, [$invoice->start, $invoice->end]
            //                         );
            //                     })->count(),
            //     'activated_frequency'       => $invoicedEvents->whereNotNull('activated')->unique('user_id')->count(),
            //     'appointment_frequency'     => $invoicedEvents->whereNotNull('appointment')->unique('user_id')->count(),
            //     'total_price'               => $invoice->getTotalPrice(),
            //     'registered_price'          => Prices::REGISTRATION,
            //     'activated_price'           => Prices::ACTIVATION,
            //     'appointment_price'         => Prices::APPOINTMENT,
            //     'users'                     => $invoice->customer->users->map(function($user, $key)use($invoice){
            //         $data = InvoiceHelper::getEventsPrice($invoice, $user);
            //         return [
            //             'email'             => $user->email,
            //             'calculated_events' => [
            //                 $user->only('created'),
            //                 $data['activatedEvent'],
            //                 $data['appointmentEvent']
            //             ],
            //             'price'             => $data['price'],
            //         ];
            //     }),
            // ]);
        } catch (\Exception $e) {
            return Response::respondError($e->getMessage());
        }
    }

    public function store(CreateInvoiceRequest $request){
        try{
            $data = $request->validated();
            $customer = Customer::with('users', 'users.sessions')->find($data['customer_id']);
            if(count($customer->users) > 0){
                $invoice = Invoice::create($data);
                Notification::create($customer, new InvoiceNotification($invoice));
                return Response::respondSuccess(Response::SUCCESS, new InvoiceResource($invoice));
            }
            return Response::respondError(Response::NOT_HAVE_USERS, ResponseStatus::VALIDATION_ERROR);
        } catch (\Exception $e) {
            return Response::respondError($e->getMessage());
        }
    }

}
