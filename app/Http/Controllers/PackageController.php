<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
class PackageController extends Controller
{
    //
    public function create(Request $request){
        
        $data = $request->getContent();
        $decoded = json_decode($data);
        $packageDate = [
            'transaction_id' => $decoded->transaction_id,
            'customer_name' => $decoded->customer_name,
            'customer_code' => $decoded->customer_code,
            'transaction_amount' => $decoded->transaction_amount,
            'transaction_amount' => $decoded->transaction_amount,
            'transaction_discount' => $decoded->transaction_discount,
            'transaction_additional_field' => $decoded->transaction_additional_field,
            'transaction_payment_type' => $decoded->transaction_payment_type,
            'transaction_state' => $decoded->transaction_state,
            'transaction_code' => $decoded->transaction_code,
            'transaction_order' => $decoded->transaction_order,
            'location_id' => $decoded->location_id,
            'organization_id' => $decoded->organization_id,
            'created_at' => $decoded->created_at,
            'updated_at' => $decoded->updated_at,
            'transaction_payment_type_name' => $decoded->transaction_payment_type_name,
            'transaction_cash_amount' => $decoded->transaction_cash_amount,
            'transaction_cash_change' => $decoded->transaction_cash_change,
            'customer_attribute' => $decoded->customer_attribute,
            'connote' => $decoded->connote,
            'connote_id' => $decoded->connote_id,
            'origin_data' => $decoded->origin_data,
            'destination_data' => $decoded->destination_data,
            'koli_data' => $decoded->koli_data,
            'custom_field' => $decoded->custom_field,
            'currentLocation' => $decoded->currentLocation
        ];
        // $customerAttribute = [
        //     'Nama_Sales' => $decoded->customer_attribute->Nama_Sales,
        //     'TOP' =>$decoded->customer_attribute->TOP,
        //     'Jenis_Pelanggan' => $decoded->customer_attribute->Jenis_Pelanggan
        // ];
        // $connote = [

        // ]
        $dataCreated = Package::create($packageDate);
        if(!$dataCreated){
            return response(json_encode([
                "status" => 500,
                "message" => 'Internal Server Error'
            ]), 500)
            ->header('Content-Type', 'text/json'); 
        }
        return response(json_encode([
            "status" => 201,
            "message" => "created",
            "data" => $dataCreated
        ]), 201)
        ->header('Content-Type', 'text/json');
    }
}
