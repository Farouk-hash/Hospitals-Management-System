<?php 
namespace App\Repository\Repository_Doctors_Panel;

use App\Interface\Interface_Doctors_Panel\InvoicesRepositoryInterface;
use App\Models\Dashboard\SingleInvoice;
use Illuminate\Support\Facades\Auth;
class InvoicesRepository implements InvoicesRepositoryInterface {
    public function index(){
        $invoices = SingleInvoice::with(['invoiceStatus'])->where('doctor_id' , Auth::id())->get();
        return view('doctors_dashboard.invoices.index' , compact('invoices'));
    }
}