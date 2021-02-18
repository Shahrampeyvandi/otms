<?php

namespace App\Imports;

use App\RoadData;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RoadImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // foreach ($rows as $row) {

        // dump($row);
        // dd($row->toArray());
        // dump($row['client_id']);
        if ($data = RoadData::where(['invoice_client' => $row['invoice_client']])->first()) {
        } else {

            $data = new RoadData;
            $data->invoice_client = $row['invoice_client'];
            // if($user = User::where(['client_en_name'=>$row['invoice_client']])->first()){
            //     User::create(['client_en_name'=>$row['invoice_client']]);
            // }
       
        }
        $data->truck = $row['truck'];
        $data->invoice_client = $row['invoice_client'];
        $data->file_no = $row['file_no'];
        $data->hbl = is_numeric($row['hbl_issue_date']) ? date('d/m/Y', ($row['hbl_issue_date']- 25569) * 86400) : null;
        $data->hs_code = $row['hs_code'];
        $data->goods_description = $row['goods_description'];
        $data->package_type = $row['package_type'];
        $data->bl_g_w = $row['bl_gw'];
        $data->package = $row['package'];
        $data->por_text = $row['por_text'];
        $data->pol_text = $row['pol_text'];
        $data->pod_text = $row['pod_text'];
        $data->final_dest_text = $row['final_des_text'];
        $data->shipper = $row['shipper'];
        $data->consignee = $row['consignee'];
        $data->notify = $row['notify'];
        $data->dispatch_date = is_numeric($row['dispatch_date'])  ? date('d/m/Y', ($row['dispatch_date'] - 25569) * 86400) : null;
        $data->eta = is_numeric($row['eta']) ? date('d/m/Y', ($row['eta'] - 25569) * 86400) : null ;
        $data->border_cross_date =is_numeric($row['border_cross_date']) ? date('d/m/Y', ($row['border_cross_date'] - 25569) * 86400) : null ;
        $data->discharge_date = is_numeric($row['discharge_date'])  ? date('d/m/Y', ($row['discharge_date'] - 25569) * 86400) : null;
        return $data;
    }
}
