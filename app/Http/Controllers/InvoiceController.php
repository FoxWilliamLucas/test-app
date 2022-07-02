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
use App\Http\Requests\CreateInvoiceRequest;
use Illuminate\Support\Facades\Notification;
use App\Http\Resources\InvoiceDetailsResource;

class InvoiceController extends Controller
{


    public function show(Invoice $invoice){
        try{
            $invoice->load('customer','customer.users', 'customer.users.sessions');
            return Response::respondSuccess(Response::SUCCESS, new InvoiceDetailsResource($invoice));
        } catch (\Exception $e) {
            return Response::respondError($e->getMessage());
        }
    }

    public function store(CreateInvoiceRequest $request){
        try{
            $data = $request->validated();
            $customer = Customer::find($data['customer_id']);
            if(count($customer->users) > 0){
                $invoice = Invoice::create($data);
                Notification::send($customer, new InvoiceNotification($invoice));
                return Response::respondSuccess(Response::SUCCESS, new InvoiceResource($invoice));
            }
            return Response::respondError(Response::NOT_HAVE_USERS, ResponseStatus::VALIDATION_ERROR);
        } catch (\Exception $e) {
            return Response::respondError($e->getMessage());
        }
    }

}
