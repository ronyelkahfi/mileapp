<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
class PackageController extends Controller
{
    //
    private $packageValidation = [
        'transaction_id' => 'required|max:255',
        'customer_name' => 'required|max:255',
        'customer_code' => 'required|max:255',
        'transaction_amount' => 'required|max:7',
        'transaction_discount' => 'max:7',
        'transaction_additional_field' => 'max:255',
        'transaction_payment_type' => 'required|max:50',
        'transaction_state' => 'required|max:50',
        'transaction_code' => 'required|max:50',
        'transaction_order' => 'required',
        'location_id' => 'required|max:255',
        'transaction_payment_type_name' => 'required|max:255',
        'transaction_cash_amount' => 'max:10',
        'transaction_cash_change' => 'max:10',
        'connote_id' => 'max:255'
    ];
    public function create(Request $request){
        
        $data = $request->getContent();
        $decoded = json_decode($data);
        $packageCheck = Package::where('transaction_id',$decoded->transaction_id)->get();
        if(count($packageCheck)>0){
            return response(json_encode([
                "status" => 400,
                "message" => 'Bad Request',
                'constraint' => ['duplicate transaction_id']
            ]), 400)
            ->header('Content-Type', 'text/json'); 
        }
        $validator = Validator::make((array) $decoded, $this->packageValidation);
        if($validator->fails()){
            $messages = $validator->errors();
            return response(json_encode([
                "status" => 400,
                "message" => 'Bad Request',
                'constraint' => $messages
            ]), 400)
            ->header('Content-Type', 'text/json'); 

        }
        $packageData = [
            'transaction_id' => $decoded->transaction_id,
            'customer_name' => $decoded->customer_name,
            'customer_code' => $decoded->customer_code,
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
        $dataCreated = Package::create($packageData);
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

    public function getList(){
        $list = Package::all();
        if(!$list){
            return response(json_encode([
                "status" => 400,
                "message" => 'Data Not Found'
            ]), 200)
            ->header('Content-Type', 'text/json');
        }
        return response(json_encode([
            "status" => 200,
            "message" => "success",
            "data" => $list
        ]), 200)
        ->header('Content-Type', 'text/json');
    }

    public function getDetail($id){
        $data = Package::where('transaction_id',$id)->get();
        if(count($data)==0){
            return response(json_encode([
                "status" => 400,
                "message" => 'Data Not Found'
            ]), 200)
            ->header('Content-Type', 'text/json');
        }

        return response(json_encode([
            "status" => 200,
            "message" => "success",
            "data" => $data
        ]), 200)
        ->header('Content-Type', 'text/json');
    }
    public function update(Request $request, $id){
        $check = Package::where('transaction_id',$id)->get();
        if(count($check)==0){
            return response(json_encode([
                "status" => 400,
                "message" => 'Data Not Found'
            ]), 200)
            ->header('Content-Type', 'text/json');
        }
        $data = $request->getContent();
        $decoded = json_decode($data);
        $packagevalidation = $this->packageValidation;
        unset($packagevalidation['transaction_id']);
        $validator = Validator::make((array) $decoded, $packagevalidation);
        if($validator->fails()){
            $messages = $validator->errors();
            return response(json_encode([
                "status" => 400,
                "message" => 'Bad Request',
                'constraint' => $messages
            ]), 400)
            ->header('Content-Type', 'text/json'); 

        }
        $packageData = [
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
        $updatedData = Package::where('transaction_id', $id)
        ->update($packageData);
        if(!$updatedData){
            return response(json_encode([
                "status" => 500,
                "message" => 'Internal Server Error'
            ]), 500)
            ->header('Content-Type', 'text/json'); 
        }
        return response(json_encode([
            "status" => 201,
            "message" => "updated",
            "data" => $packageData
        ]), 201)
        ->header('Content-Type', 'text/json');
    }
    public function updatePatch(Request $request, $id){
        $check = Package::where('transaction_id',$id)->get();
        if(count($check)==0){
            return response(json_encode([
                "status" => 400,
                "message" => 'Data Not Found'
            ]), 200)
            ->header('Content-Type', 'text/json');
        }
        $data = $request->getContent();
        $decoded = json_decode($data);
        $packageData = [];
        $packageValidation = $this->packageValidation;
        $packageValidationSelected = [];
        if(!empty($decoded->customer_name)){
            $packageData['customer_name'] = $decoded->customer_name;
            if(!empty($packageValidation['customer_name'])){
                $packageValidationSelected['customer_name'] = $packageValidation['customer_name'];
            }
        }
        if(!empty($decoded->customer_code)){
            $packageData['customer_code'] = $decoded->customer_code;
            if(!empty($packageValidation['customer_code'])){
                $packageValidationSelected['customer_code'] = $packageValidation['customer_code'];
            }
        }
        if(!empty($decoded->transaction_amount)){
            $packageData['transaction_amount'] = $decoded->transaction_amount;
            if(!empty($packageValidation['transaction_amount'])){
                $packageValidationSelected['transaction_amount'] = $packageValidation['transaction_amount'];
            }
        }
        if(!empty($decoded->transaction_discount)){
            $packageData['transaction_discount'] = $decoded->transaction_discount;
            if(!empty($packageValidation['transaction_discount'])){
                $packageValidationSelected['transaction_discount'] = $packageValidation['transaction_discount'];
            }
        }
        if(!empty($decoded->transaction_additional_field)){
            $packageData['transaction_additional_field'] = $decoded->transaction_additional_field;
            if(!empty($packageValidation['transaction_additional_field'])){
                $packageValidationSelected['transaction_additional_field'] = $packageValidation['transaction_additional_field'];
            }
        }
        if(!empty($decoded->transaction_payment_type)){
            $packageData['transaction_payment_type'] = $decoded->transaction_payment_type;
            if(!empty($packageValidation['transaction_payment_type'])){
                $packageValidationSelected['transaction_payment_type'] = $packageValidation['transaction_payment_type'];
            }
        }
        if(!empty($decoded->transaction_state)){
            $packageData['transaction_state'] = $decoded->transaction_state;
            if(!empty($packageValidation['transaction_state'])){
                $packageValidationSelected['transaction_state'] = $packageValidation['transaction_state'];
            }
        }
        if(!empty($decoded->transaction_code)){ 
            $packageData['transaction_code'] = $decoded->transaction_code;
            if(!empty($packageValidation['transaction_code'])){
                $packageValidationSelected['transaction_code'] = $packageValidation['transaction_code'];
            }
        }
        if(!empty($decoded->transaction_order)){ 
            $packageData['transaction_order'] = $decoded->transaction_order;
            if(!empty($packageValidation['transaction_order'])){
                $packageValidationSelected['transaction_order'] = $packageValidation['transaction_order'];
            }
        }
        if(!empty($decoded->location_id)){ 
            $packageData['location_id'] = $decoded->location_id;
            if(!empty($packageValidation['location_id'])){
                $packageValidationSelected['location_id'] = $packageValidation['location_id'];
            }
        }
        if(!empty($decoded->organization_id)){ 
            $packageData['organization_id'] = $decoded->organization_id;
            if(!empty($packageValidation['organization_id'])){
                $packageValidationSelected['organization_id'] = $packageValidation['organization_id'];
            }
        }
        if(!empty($decoded->transaction_payment_type_name)){ 
            $packageData['transaction_payment_type_name'] = $decoded->transaction_payment_type_name;
            if(!empty($packageValidation['transaction_payment_type_name'])){
                $packageValidationSelected['transaction_payment_type_name'] = $packageValidation['transaction_payment_type_name'];
            }
        }
        if(!empty($decoded->transaction_cash_amount)){ 
            $packageData['transaction_cash_amount'] = $decoded->transaction_cash_amount;
            if(!empty($packageValidation['transaction_cash_amount'])){
                $packageValidationSelected['transaction_cash_amount'] = $packageValidation['transaction_cash_amount'];
            }
        }
        if(!empty($decoded->transaction_cash_change)){ 
            $packageData['transaction_cash_change'] = $decoded->transaction_cash_change;
            if(!empty($packageValidation['transaction_cash_change'])){
                $packageValidationSelected['transaction_cash_change'] = $packageValidation['transaction_cash_change'];
            }
        }
        if(!empty($decoded->customer_attribute)){ 
            $packageData['customer_attribute'] = $decoded->customer_attribute;
            if(!empty($packageValidation['customer_attribute'])){
                $packageValidationSelected['customer_attribute'] = $packageValidation['customer_attribute'];
            }
        }
        if(!empty($decoded->connote)){ 
            $packageData['connote'] = $decoded->connote;
        }
        if(!empty($decoded->connote_id)){ 
            $packageData['connote_id'] = $decoded->connote_id;
            $packagevalidationSelected['customer_name'] = $packagevalidation['customer_name'];
        }
        if(!empty($decoded->origin_data)){ 
            $packageData['origin_data'] = $decoded->origin_data;
        }
        if(!empty($decoded->destination_data)){ 
            $packageData['destination_data'] = $decoded->destination_data;
        }
        if(!empty($decoded->koli_data)){ 
            $packageData['koli_data'] = $decoded->koli_data;
        }
        if(!empty($decoded->custom_field)){ 
            $packageData['custom_field'] = $decoded->custom_field;
        }
        if(!empty($decoded->currentLocation)){ 
            $packageData['currentLocation'] = $decoded->currentLocation;
        }
        $validator = Validator::make((array) $decoded, $packageValidationSelected);
        if($validator->fails()){
            $messages = $validator->errors();
            return response(json_encode([
                "status" => 400,
                "message" => 'Bad Request',
                'constraint' => $messages
            ]), 400)
            ->header('Content-Type', 'text/json'); 
        }
        if(count($packageData)==0){
            return response(json_encode([
                "status" => 200,
                "message" => 'No Data Updated'
            ]), 200)
            ->header('Content-Type', 'text/json'); 
        }
        
        $updatedData = Package::where('transaction_id', $id)
        ->update($packageData);
        if(!$updatedData){
            return response(json_encode([
                "status" => 500,
                "message" => 'Internal Server Error'
            ]), 500)
            ->header('Content-Type', 'text/json'); 
        }
        return response(json_encode([
            "status" => 201,
            "message" => "updated",
            "data" => $packageData
        ]), 201)
        ->header('Content-Type', 'text/json');
    }
    public function delete($id){
        $deleted = Package::where('transaction_id', $id)->get();
        if(count($deleted)==0){
            return response(json_encode([
                "status" => 400,
                "message" => 'Data Not Found'
            ]), 200)
            ->header('Content-Type', 'text/json');
        }
        $deleted = Package::where('transaction_id', $id)->delete();
        return response(json_encode([
            "status" => 200,
            "message" => "deleted",
            "data" => $deleted
        ]), 200)
        ->header('Content-Type', 'text/json');
    }
}
