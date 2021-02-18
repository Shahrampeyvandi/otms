<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'invoice_client' => $this->invoice_client,
            'truck' => $this->truck,
            'file_no' => $this->file_no,
            'hbl' => $this->hbl,
            'issue_date' => $this->issue_date,
            'hs_code' => $this->hs_code,
            'package_type' => $this->package_type,
            'bl_g_w' => $this->bl_g_w,
            'package' => $this->package,
            'por_text' => $this->por_text,
            'pol_text' => $this->pol_text,
            'pod_text' => $this->pod_text,
            'final_dest_text' => $this->final_dest_text,
            'shipper' => $this->shipper,
            'consignee' => $this->consignee,
            'notify' => $this->notify,
            'goods_description' => $this->goods_description,
            'dispatch_date' => $this->dispatch_date,
            'eta' => $this->eta,
            'border_cross_date' => $this->border_cross_date,
            'discharge_date' => $this->discharge_date
        ];
    }
}
