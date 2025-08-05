<?php

namespace App\Livewire;

use App\Models\Dashboard\Doctor;
use App\Models\Dashboard\FundAccount;
use App\Models\Dashboard\Patient;
use App\Models\Dashboard\PatientAccount;
use App\Models\Dashboard\PaymentTypes;
use App\Models\Dashboard\Services;
use App\Models\Dashboard\SingleInvoice as SingleInvoiceModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SingleInvoices extends Component
{
    public $showTable = true;
    public $updated = false ; 

    public $patient_name, $doctor_id, $section_variable , $section_id ,$service_id , $invoice_id , $patient_id ,$payment_type_id;

    public $service_price = 0, $discount = 0, $tax_rate = 14, $tax_amount = 0, $total_price = 0;
    public $subtotal = 0; // Price after discount, before tax
    public function toggle_show_table()
    {
        $this->showTable = false;
    }

    public function doctorChanged()
    {
        if ($this->doctor_id) {
            $doctor = Doctor::with(['section'])->find($this->doctor_id);                    
            $this->section_variable = $doctor->section->name ?? $doctor->section->translations->first()->name;
            $this->section_id = $doctor->section->id;
            
        }
    }
    public function serviceSelected(){
        if($this->service_id){
            $this->service_price = Services::findOrFail($this->service_id)->price ;
            $this->calculateTotals();
        }else{
            $this->resetPrices();
        }
    }

    public function calculateTotals()
    {
        // Step 1: Calculate subtotal (service price - discount)
        $this->subtotal = max(0, $this->service_price - $this->discount);
        
        // Step 2: Calculate tax amount
        $this->tax_amount = ($this->subtotal * $this->tax_rate) / 100;
        
        // Step 3: Calculate final total (subtotal + tax)
        $this->total_price = $this->subtotal + $this->tax_amount;
        
        // Round to 2 decimal places
        $this->subtotal = round($this->subtotal, 2);
        $this->tax_amount = round($this->tax_amount, 2);
        $this->total_price = round($this->total_price, 2);
    }
    public function updatedDiscount(){
        $this->calculateTotals();
    }
    
    public function updatedTaxRate()
    {
        $this->calculateTotals();
    }
    private function resetPrices()
    {
        $this->service_price = 0;
        $this->subtotal = 0;
        $this->tax_amount = 0;
        $this->total_price = 0;
    }

    public function submit()
    {
        DB::beginTransaction();
        try{
            $result = [
                'doctor_id' => $this->doctor_id,
                'section_id'=>$this->section_id,
                'patient_id' => $this->patient_id,
                'service_id' => $this->service_id,
                'service_price' => $this->service_price,
                'discount' => $this->discount,
                'subtotal' => $this->subtotal,
                'tax_rate' => $this->tax_rate,
                'tax_amount' => $this->tax_amount,
                'total_price' => $this->total_price,
                'payment_type_id'=>$this->payment_type_id
            ];
            if($this->updated){
                $single_invoice = SingleInvoiceModel::findOrFail($this->invoice_id);
                $single_invoice->update($result);
            }
            else{
                $single_invoice = SingleInvoiceModel::create($result);
                $this->invoice_id = $single_invoice->id;
            }
            // cash ;
            if($this->payment_type_id == 1){
                $this->cashAccountMethod();
            }
            // promissory ;
            else{
                $this->patientAccountMethod();
            }

            DB::commit();
            $this->showTable = true ;
            $this->updated = false ; 

        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    protected function cashAccountMethod(){
        if($this->updated){
            FundAccount::where('single_invoice_id',$this->invoice_id)->update(['debit'=>$this->total_price,'credit'=>0]);
        }else{
            FundAccount::create(['single_invoice_id'=>$this->invoice_id,'debit'=>$this->total_price , 'credit'=>0]);
        }
    }
    protected function patientAccountMethod(){
        if($this->updated){
            PatientAccount::where('single_invoice_id',$this->invoice_id)->update(['debit'=>$this->total_price,'credit'=>0]);
        }else{
            PatientAccount::create(['single_invoice_id'=>$this->invoice_id,'debit'=>$this->total_price , 'credit'=>0]);
        }
    }

    public function edit($invoice_id){
        $this->showTable = false ; // show store , update form ;
        $this->updated = true ; // for submit button to dedict we store OR update ; 

        $this->invoice_id = $invoice_id ; 
        $invoice = SingleInvoiceModel::findOrFail($invoice_id);
        $this->doctor_id = $invoice->doctor_id ; 
        $this->section_id = $invoice->section_id ; 
        $this->section_variable = $invoice->section->name ?? $invoice->section->translations->first()->name;
        $this->payment_type_id = $invoice->payment_type_id ; 
        $this->service_id = $invoice->service_id ; 
        $this->service_price = $invoice->service_price ; 
        $this->discount = $invoice->discount ; 
        $this->subtotal = $invoice->subtotal ; 
        $this->tax_rate = $invoice->tax_rate ; 
        $this->tax_amount = $invoice->tax_amount ; 
        $this->total_price = $invoice->total_price ; 
    }
    public function destroy($invoice_id){
        SingleInvoiceModel::destroy($invoice_id);
        $this->showTable = true ; 
    }
    public function render()
    {
        $doctors = Doctor::all();
        $services = Services::all();
        $invoices = SingleInvoiceModel::all();
        $patients = Patient::all();
        $paymentsTypes = PaymentTypes::all();
        return 
        view('livewire.Single-Invoices.single-invoices',
        [
            'doctors'=>$doctors,
            'services'=>$services,
            'invoices'=>$invoices,
            'patients'=>$patients,
            'paymentsTypes'=>$paymentsTypes
        ]);
    }
}