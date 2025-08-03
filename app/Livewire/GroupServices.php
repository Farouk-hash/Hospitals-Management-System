<?php
// app/Livewire/GroupServices.php
namespace App\Livewire;

use App\Models\Dashboard\Services;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Dashboard\groupServices as groupServicesModel;
class GroupServices extends Component 
{
    public $groupName;
    public $groupNotes;
    public $discount = 0;
    public $taxRate = 0;

    public $services = [];
    public $availableServices = [];
    public $removedServices = [];
    public $showAddService = false;

    public $selectedService = '';
    public $servicePrice = '';
    public $serviceQuantity = 1;

    public $addedServices = [];

    public $showTable = true ;
    public $update = false ; 
    public $service_id ; 

    public function edit($service_id=null){
        $this->showTable = false ;
        $this->update = true ; 
        $this->showAddService = true ; 
        $this->service_id = $service_id ; 

        if($service_id){
            $group_service = groupServicesModel::with(['service_group'])->findOrFail($service_id);
            $this->groupName = $group_service->name ?? $group_service->translations()->first()->name ?? 'No Name'; 
            $this->groupNotes = $group_service->notes ?? $group_service->translations()->first()->notes ?? 'No Notes';
            $this->discount = $group_service->discount ; 
            $this->taxRate = $group_service->taxes;

            foreach($group_service->service_group as $service){
                $this->addedServices[] = [
                    'id' => $service->id,
                    'name' => $service->name ?? $service->translations()->first()->name,
                    'price' => $service->price,
                    'quantity' => $this->serviceQuantity
                ];
    
            }
        }
    }
    public function destroy($service_id){
        groupServicesModel::destroy($service_id);
    }
    public function mount()
    {
        $this->services = Services::all();
        $this->availableServices = $this->services->toArray();
    }

    public function toggleAddService()
    {
        $this->showAddService = !$this->showAddService;
        
        if (!$this->showAddService) {
            $this->resetServiceInputs();
        }
    }

    public function selectService($serviceId)
    {
        $this->selectedService = $serviceId;
        
        if ($serviceId) {
            $service = collect($this->availableServices)->firstWhere('id', $serviceId);
            if ($service) {
                $this->servicePrice = $service['price'] ?? '';
            }
        } else {
            $this->servicePrice = '';
        }
    }

    public function addServiceToGroup()
    {
        // Simple validation first
        if (empty($this->selectedService) || empty($this->servicePrice) || empty($this->serviceQuantity)) {
            return;
        }

        $service = collect($this->availableServices)->firstWhere('id', $this->selectedService);
        
        if (!$service) {
            return;
        }

        // Get service name safely
        $serviceName = $service['name'];
        
        $this->addedServices[] = [
            'id' => $service['id'],
            'name' => $serviceName,
            'price' => $this->servicePrice,
            'quantity' => $this->serviceQuantity
        ];

        // Remove service from available services
        $this->availableServices = collect($this->availableServices)
            ->filter(function($s) {
                return $s['id'] != $this->selectedService;
            })
            ->values()
            ->toArray();

        $this->resetServiceInputs();
    }

    public function redoService($serviceId)
    {
        // Find the service in removed services
        $serviceToRestore = collect($this->removedServices)->firstWhere('id', $serviceId);
        
        if (!$serviceToRestore) {
            // If not in removed services, get from original services
            $serviceToRestore = $this->services->firstWhere('id', $serviceId);
        }
        
        if ($serviceToRestore) {
            // Add back to available services
            $this->availableServices[] = $serviceToRestore->toArray();
            
            // Remove from removed services
            $this->removedServices = collect($this->removedServices)
                ->filter(function($s) use ($serviceId) {
                    return $s['id'] != $serviceId;
                })
                ->values()
                ->toArray();
        }
    }

    public function removeService($index)
    {
        if (!isset($this->addedServices[$index])) {
            return;
        }

        $removedService = $this->addedServices[$index];
        
        // Find the original service data
        $originalService = $this->services->firstWhere('id', $removedService['id']);
        
        if ($originalService) {
            // Add to removed services for redo functionality
            $this->removedServices[] = $originalService->toArray();
        }

        // Remove from added services
        unset($this->addedServices[$index]);
        $this->addedServices = array_values($this->addedServices);
    }

    public function getSubtotalProperty()
    {
        return collect($this->addedServices)->sum(function($service) {
            return $service['price'] * $service['quantity'];
        });
    }

    public function getDiscountAmountProperty()
    {
        return ($this->subtotal * $this->discount) / 100;
    }

    public function getTaxAmountProperty()
    {
        $afterDiscount = $this->subtotal - $this->discountAmount;
        return ($afterDiscount * $this->taxRate) / 100;
    }

    public function getFinalTotalProperty()
    {
        return $this->subtotal - $this->discountAmount + $this->taxAmount;
    }

    private function resetServiceInputs()
    {
        $this->selectedService = '';
        $this->servicePrice = '';
        $this->serviceQuantity = 1;
    }

    public function confirm()
{
    DB::beginTransaction();

    try {
        $data = [
           
            'discount'             => $this->discount,
            'taxes'                => $this->taxRate,
            'total_price'          => $this->finalTotal,
            'price_before_discount'=> $this->subtotal,
        ];

        $groupService = $this->service_id
        ? tap(groupServicesModel::findOrFail($this->service_id), fn($g) => $g->update($data))
            : groupServicesModel::create($data);
        $groupService->name = $this->groupName ;
        $groupService->notes = $this->groupNotes;
        $groupService->save();
        // Sync or attach related services
        $serviceIds = array_column($this->addedServices, 'id');

        if ($this->service_id) {
            $groupService->service_group()->sync($serviceIds);
        } else {
            $groupService->service_group()->attach($serviceIds);
        }

        DB::commit();

        // Reset state
        $this->update     = false;
        $this->showTable  = true;

        return redirect()->route('dashboard.group-services.index', ['lang' => app()->getLocale()]);

    } catch (Exception $e) {
        DB::rollBack();
        report($e); // optional: log error
        dd($e);     // for debugging only – remove in production
    }
}

    public function render()
    {
        $groupservices = groupServicesModel::all();
        return view('livewire.group-services' , compact('groupservices'));
    }
}