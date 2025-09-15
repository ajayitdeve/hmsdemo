<?php

namespace App\Http\Livewire\Nurse\ServiceLabIndent;

use App\Models\Ipd\Ipd;
use App\Models\IpLabIndent;
use App\Models\IpLabIndentItem;
use Carbon\Carbon;
use App\Models\User;
use App\Services\ServiceCart;
use App\Models\Service\Service;
use App\Traits\NurseDepartment;
use Livewire\Component;

class LabIndentCreate extends Component
{
    use NurseDepartment;

    public $counter = 0, $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $status, $patient_type, $age, $gender, $ward, $room, $bed, $admn_no, $admn_date, $consultant, $corporate_name;
    public $indent_no, $indent_date, $consultant_code, $consultant_name, $remarks, $instructions, $clinical_summary_diagnosis;

    public $service_id, $quantity = 1, $calculatedRate, $discount = 0, $discountAmount = 0, $total = 0;
    public $rate, $discount_approved_by_id = 1;
    public $payableAmount = 0, $payingAmount = 0, $dueAmount = 0, $prviousDuesAmount, $taxable_amount;
    public $service = null, $services = [], $users = [], $arrCart = [];

    protected $rules = [
        'umr' => 'required',
        'admn_no' => 'required',
        'indent_no' => 'required',
        'consultant_code' => 'required',
        'consultant_name' => 'required',
        'arrCart' => 'required|array',
    ];

    protected $messages = [
        'arrCart.required' => 'Please add at least one service.',
    ];

    public function generateIndentNo()
    {
        $count = IpLabIndent::max('id');
        return "IND" . date("y") . date("m") . date("d") . $count + 1;
    }

    public function mount($ipd_code)
    {
        $this->checkNurseStationSession();

        $this->ipd_code = $ipd_code;
        $this->indent_no = $this->generateIndentNo();
        $this->indent_date = date("Y-m-d");
        $this->services = Service::where('ispackage', 0)->get();
        $this->users = User::all();

        $ipd = Ipd::with(
            [
                "bed",
                "room" => function ($query) {
                    $query->where("nurse_station_id", session()->get("nurse_station_id"));
                },
                "patient_visit" => function ($query) {
                    $query->with(['doctor']);
                },
                "patient" => function ($query) {
                    $query->with(['gender']);
                }
            ]
        )
            ->whereHas("room", function ($query) {
                $query->where("nurse_station_id", session()->get("nurse_station_id"));
            })
            ->where("ipdcode", $this->ipd_code)
            ->first();

        if ($ipd) {
            $this->ipd = $ipd;

            $this->umr = $ipd?->patient?->registration_no;
            $this->patient_name = $ipd?->patient?->name;
            $this->status = "Not Approved";
            $this->patient_type = $ipd?->patient?->patienttype->name;
            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $ipd?->patient?->gender?->name;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->consultant = $ipd?->patient_visit?->doctor?->name;

            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;

            $this->consultant_code = $ipd?->patient_visit?->doctor?->code;
            $this->consultant_name = $ipd?->patient_visit?->doctor?->name;
        }
    }

    public function serviceChanged()
    {
        //reset quantity to 1 on service change
        $this->quantity = 1;
        $this->service = Service::find($this->service_id);

        if ($this->service) {
            $this->rate = number_format($this->service->charge, 2, '.', '');
            $this->calculatedRate = $this->rate;
            $this->total = $this->calculatedRate;
            //reset discount $ and Amount
            $this->discount = 0;
            $this->discountAmount = 0;
        }
    }

    public function quantityChanged()
    {
        $this->validate([
            "quantity" => "required|integer|min:1",
        ]);

        //reset discount $ and Amount
        $this->discount = 0;
        $this->discountAmount = 0;
        $this->calculatedRate = number_format($this->rate * $this->quantity, 2, '.', '');
        $this->calTotal();
    }

    public function calDiscount()
    {
        if ($this->discount != null) {
            return $this->calculatedRate * $this->discount / 100;
        } else {
            return 0;
        }
    }

    public function discountChanged()
    {
        $this->validate([
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $this->taxable_amount = $this->calculatedRate - $this->calDiscount();
        //setting $discountAmount
        if ($this->discount != null) {
            $this->discountAmount = $this->calculatedRate * $this->discount / 100;
        } else {
            $this->discountAmount = 0;
        }

        $this->calTotal();
    }

    public function discountAmountChanged()
    {

        //setting $discountAmount
        $tempDiscountPercent = ($this->discountAmount * 100) / $this->calculatedRate;
        $this->discount = $tempDiscountPercent;
        $this->taxable_amount = $this->calculatedRate - $this->calDiscount();
        $this->calTotal();
    }

    public function calTotal()
    {
        $this->total = number_format(($this->rate * $this->quantity) - $this->discountAmount, 2, '.', '');
    }

    public function addToCart()
    {
        $this->validate([
            "quantity" => "required|integer|min:1",
            'discount' => 'required|numeric|min:0|max:100',
            'payingAmount' => 'required|min:0',
        ]);

        $this->counter++;
        $cart = new ServiceCart($this->counter, $this->service_id, $this->service->code, $this->service->name, $this->quantity, $this->rate, $this->calculatedRate, $this->calDiscount(), $this->total, $this->discount_approved_by_id);
        $temp = [];
        $temp['id'] = $cart->id;
        $temp['service_id'] = $cart->service_id;
        $temp['service_name'] = $cart->service_name;
        $temp['service_code'] = $cart->service_code;
        $temp['service_date'] = date("Y-m-d");
        $temp['quantity'] = $cart->quantity;
        $temp['service_group_department'] = $this->service?->servicegroup?->name;
        $temp['unit_service_price'] = $cart->unit_service_price;
        $temp['amount'] = $cart->amount;
        $temp['discount'] = $cart->discount;
        $temp['total'] = $cart->total;
        $temp['discount_approved_by_id'] = $cart->discount_approved_by_id;



        array_push($this->arrCart, $temp);
        //save in session
        // session()->put('cart-data', $this->arrCart);
        $this->calculatePayble();
        //reseting form
        $this->reset('service_id', 'rate', 'quantity', 'calculatedRate', 'total');
        //reset discount $ and Amount
        $this->discount = 0;
        $this->discountAmount = 0;
    }

    public function calculatePayble()
    {
        $sum = 0;
        foreach ($this->arrCart as $item) {
            $sum = $sum + $item['total'];
        }
        $this->payableAmount = number_format($sum + $this->prviousDuesAmount, 2, '.', '');
        $this->payingAmount = number_format($sum + $this->prviousDuesAmount, 2, '.', '');
    }

    public function payingAmountChanged()
    {
        $this->validate([
            'payingAmount' => 'required|min:0',
        ]);

        $this->dueAmount = $this->payableAmount - $this->payingAmount;
    }

    public function serviceDateChanged($index, $date)
    {
        $this->arrCart[$index]['service_date'] = $date;
    }

    public function deleteCart($index)
    {
        unset($this->arrCart[$index]);
        $this->calculatePayble();
        // session()->forget('cart-data');
        // session()->put('cart-data', $this->arrCart);
        $this->render();
        session()->flash('message', 'Service Removed Successfully.');
    }

    public function save()
    {
        $this->validate();

        $lab_indent = IpLabIndent::create([
            "ipd_id" => $this->ipd?->id,
            "patient_id" => $this->ipd?->patient?->id,
            "code" => $this->generateIndentNo(),
            "remarks" => $this->remarks,
            "instructions" => $this->instructions,
            "clinical_summary_diagnosis" => $this->clinical_summary_diagnosis,
            "status" => $this->status,
            'nurse_station_id' => session()->get('nurse_station_id'),
            "created_by_id" => auth()->user()?->id,
        ]);

        $data = [];
        foreach ($this->arrCart as $item) {
            $temp = [];

            $temp['ip_lab_indent_id'] = $lab_indent->id;
            $temp['service_id'] = $item['service_id'];
            $temp['quantity'] = $item['quantity'];
            $temp['unit_service_price'] = $item['unit_service_price'];
            $temp['amount'] = $item['amount'];
            $temp['discount'] = $item['discount'];
            // $temp['taxable_amount'] = $item['taxable_amount'];
            // $temp['cgst'] = $item['cgst'];
            // $temp['sgst'] = $item['sgst'];
            $temp['total'] = $item['total'];
            $temp['service_date'] = $item['service_date'];
            $temp['discount_approved_by_id'] = $item['discount_approved_by_id'];
            $temp['created_at'] = date('Y-m-d H:i:s');
            $temp['updated_at'] = date('Y-m-d H:i:s');

            array_push($data, $temp);
        }

        IpLabIndentItem::insert($data);

        session()->flash("lab_indent_no", $lab_indent->code);
        $this->dispatchBrowserEvent('open-lab-indent-no-modal');

        session()->flash("success", "Lab Indent Created Successfully.");
    }

    public function render()
    {
        return view('livewire.nurse.service-lab-indent.lab-indent-create')->extends('layouts.admin')->section('content');
    }
}
