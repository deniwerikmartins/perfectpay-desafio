<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentCreditCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'invoiceUrl' => $this->invoiceUrl,
            'invoiceNumber' => $this->invoiceNumber,
            'transactionReceiptUrl' => $this->transactionReceiptUrl,
            'billingType' => $this->billingType
        ];
    }
}
