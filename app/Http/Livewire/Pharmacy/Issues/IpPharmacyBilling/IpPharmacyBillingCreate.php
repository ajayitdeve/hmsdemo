<?php

namespace App\Http\Livewire\Pharmacy\Issues\IpPharmacyBilling;

use App\Models\IpPharmacyIndent;
use App\Models\IpPharmacyIndentItem;
use App\Models\IpPharmacyIndentBilling;
use App\Models\IpPharmacyIndentBillingItem;
use App\Models\Inventory;
use App\Models\IpPharmacyBillingTransaction;
use App\Models\IpPharmacyDue;
use App\Models\Item;
use App\Models\SaleStore;
use App\Models\StockPoint;
use App\Models\User;
use App\Services\IpPharmacyIndentCart;
use App\Traits\ManageMedicineStock;
use App\Traits\PharmacyStockPoint;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IpPharmacyBillingCreate extends Component
{
    use ManageMedicineStock, PharmacyStockPoint;

    public $bg_color = "#ffff", $stock_point, $drug_indent_details;
    public $bill_no, $bill_date, $umr, $stock_point_id, $admn_no, $patient_name;
    public $nrq_no, $indent_by, $doctor_code, $doctor_name, $req_dept, $ward, $patient_type, $corporate_name, $drug_destination_name;

    public $stock_points = [], $arrCart = [], $drug_indent_list = [];

    public $batch_no, $quantity, $exd, $unit_sale_price, $discount = 0, $amount, $taxable_amount, $cgst, $sgst, $total;
    public $item_id, $item_name;
    public $items = [], $counter, $batch_nos = [], $users = [];
    public $discount_approved_by_id = 1, $payableAmount = 0, $dueAmount = 0, $payingAmount = 0, $discountAmount = 0, $prviousDuesAmount = 0;

    public $due_approved_by_id = null;
    public $ipPharmacyDue = null;

    public $payment_mode, $transaction_id;
    public $walletAmount = 0, $creditLimit = 0;

    public function generateBillNo()
    {
        $maxId = IpPharmacyIndentBilling::max('id');
        return 'OIP' . date('y') . date('m') . date('d') . $maxId + 1;
    }

    public function mount()
    {
        $this->checkStockPointSession();

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        $this->stock_point = $stockPoint;
        $this->stock_point_id = $stockPoint?->id;


        $this->bill_no = $this->generateBillNo();
        $this->bill_date = date("Y-m-d");
        $this->items = Item::get();
        $this->users = User::get();

        $this->drug_indent_list = IpPharmacyIndent::where("stock_point_id", $this->stock_point_id)
            ->where("is_cancelled", 0)
            ->doesntHave('indent_billing')
            ->latest()
            ->get();
    }

    public function nrqNoChanged()
    {
        $drug_indent = IpPharmacyIndent::with(["indent_items", "indent_items.item"])
            ->where("nrq_code", $this->nrq_no)
            ->where("stock_point_id", $this->stock_point_id)
            ->first();

        if ($drug_indent) {
            $this->drug_indent_details = $drug_indent;
            $this->umr = $drug_indent->patient?->registration_no;
            $this->admn_no = $drug_indent->ipd?->ipdcode;
            $this->patient_name = $drug_indent->patient?->name;
            $this->indent_by = $drug_indent->user?->name;
            $this->doctor_code = $drug_indent->ipd?->patient_visit?->doctor?->code;
            $this->doctor_name = $drug_indent->ipd?->patient_visit?->doctor?->name;
            $this->req_dept = $drug_indent->nurse_station?->name;
            $this->ward = $drug_indent->ipd?->ward?->name;
            $this->patient_type = $drug_indent->ipd?->patient?->patienttype->name;
            $this->drug_destination_name = $drug_indent->remarks;

            $this->corporate_name = $drug_indent->ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $drug_indent->ipd?->corporate_registration?->organization?->color;

            $this->walletAmount = $drug_indent?->ipd?->wallet?->amount;
            $this->creditLimit = $drug_indent?->ipd?->wallet?->credit_limit;

            $this->arrCart = $drug_indent->indent_items->map(function ($item) {
                $this->counter++;

                return [
                    "id" => $this->counter,
                    "item_id" => $item['item_id'],
                    "item_name" => $item['item']['description'],
                    "stock_point_id" => $item['stock_point_id'],
                    "batch_no" => $item['batch_no'],
                    "exd" => date('d-M-Y', strtotime($item['exd'])),
                    "quantity" => $item['quantity'],
                    "unit_sale_price" => $item['unit_sale_price'],
                    "amount" => $item['amount'],
                    "discount" => $item['discount'],
                    "taxable_amount" => $item['taxable_amount'],
                    "cgst" => $item['cgst'],
                    "sgst" => $item['sgst'],
                    "total" => $item['total'],
                    "discount_approved_by_id" => $item['discount_approved_by_id'],
                    "is_default_item" => $item['id'],
                ];
            })->toArray();

            $this->payableAmount = number_format(array_sum(array_column($this->arrCart, 'total')), 2, '.', '');
            $this->payingAmount = $this->payableAmount;

            //check for dues
            $this->ipPharmacyDue = IpPharmacyDue::where('patient_id', $this->drug_indent_details?->patient_id)
                ->where('ipd_id', $this->drug_indent_details?->ipd_id)
                ->where('is_due_cleared', 0)
                ->get();

            $this->prviousDuesAmount = $this->ipPharmacyDue->sum('due_amount');

            $this->calculatePayble();
        } else {
            $this->resetInput();
        }
    }

    public function resetInput()
    {
        $this->umr = null;
        $this->admn_no = null;
        $this->patient_name = null;
        $this->indent_by = null;
        $this->doctor_code = null;
        $this->doctor_name = null;
        $this->req_dept = null;
        $this->ward = null;
        $this->patient_type = null;
        $this->corporate_name = null;
        $this->drug_destination_name = null;
        $this->arrCart = [];
        $this->payableAmount = 0;
        $this->payingAmount = 0;
        $this->dueAmount = 0;
    }

    public function itemChanged()
    {
        $this->reset('item_name', 'batch_no', 'exd', 'batch_nos', 'quantity', 'unit_sale_price', 'amount', 'discount', 'discountAmount', 'taxable_amount', 'cgst', 'sgst', 'total');

        $item = Item::where('id', $this->item_id)->first();
        //first: check item is exist in SaleStores table for given stock_point id

        $isItemExist = SaleStore::where('stock_point_id', $this->stock_point_id)->where('item_id', $item->id)->where('received', 1)->count();
        if ($isItemExist) {
            $this->item_name = $item->description;

            $rate = $item->rates->where('status', 0)->first();
            $this->unit_sale_price = $rate->current_sale_rate;
            $avlQty = $this->availableQuantityByItem($this->item_id);
            $this->batch_nos = null;
            $this->batch_nos = collect($avlQty);
            $this->batch_no = $avlQty[0]['batch_no'];
            $this->cgst = $item->cgst;
            $this->sgst = $item->sgst;

            if ($item?->sale_rate_for_billing_used_for == 'ip' || $item?->sale_rate_for_billing_used_for == 'both') {
                $this->discount = $item?->sale_rate_for_billing_percentage;
                $this->discountAmount = $item?->sale_rate_for_billing_amount;
            }
        }
    }

    public function batchNoChanged($batch_no)
    {
        $this->batch_no = $batch_no;
    }

    public function quantityChanged()
    {
        // $this->discount = 0;
        // $this->discountAmount = 0;
        $this->amount = $this->quantity * $this->unit_sale_price;

        if ($this->discount != null && $this->discount > 0) {
            $this->discountChanged();
        } else if ($this->discountAmount != null && $this->discountAmount > 0) {
            $this->discountAmountChanged();
        } else {
            $this->taxable_amount = $this->amount - $this->calDiscount();
            $this->calTotal();
        }

        $this->exd = Inventory::where('batch_no', $this->batch_no)->first('exd')?->exd;
    }

    public function calDiscount()
    {
        if ($this->discount != null) {
            return $this->amount * $this->discount / 100;
        } else {
            return 0;
        }
    }

    public function discountChanged()
    {
        $this->taxable_amount = $this->amount - $this->calDiscount();
        if ($this->discount != null) {
            $this->discountAmount = $this->amount * $this->discount / 100;
        } else {
            $this->discountAmount = 0;
        }

        $this->calTotal();
    }

    public function discountAmountChanged()
    {
        $tempDiscountPercent = ($this->discountAmount * 100) / $this->amount;
        $this->discount = $tempDiscountPercent;
        $this->taxable_amount = $this->amount - $this->calDiscount();
        $this->calTotal();
    }

    public function calTotal()
    {
        $this->total = $this->taxable_amount + ($this->taxable_amount * ($this->cgst + $this->sgst) / 100);
    }

    public function addToCart()
    {
        $this->validate([
            'item_id' => 'required',
            'quantity' => 'required',
            'unit_sale_price' => 'required',
            'amount' => 'required',
            'exd' => 'required',
            'total' => 'required',
        ]);

        $is_stock = $this->check_available_stock();

        if ($is_stock) {
            session()->flash('error', 'Medicine stock not available.');
            return;
        }

        $this->counter++;
        $cart = new IpPharmacyIndentCart($this->counter, $this->item_id, $this->item_name, $this->stock_point_id, $this->batch_no, $this->exd, $this->quantity, $this->unit_sale_price, $this->amount, $this->discount, $this->taxable_amount, $this->cgst, $this->sgst, $this->total, $this->discount_approved_by_id);
        $temp = [];

        $temp['id'] = $cart->id;
        $temp['item_id'] = $cart->item_id;
        $temp['item_name'] = $cart->item_name;
        $temp['stock_point_id'] = $cart->stock_point_id;
        $temp['batch_no'] = $cart->batch_no;
        $temp['exd'] = $cart->exd;
        $temp['quantity'] = $cart->quantity;
        $temp['unit_sale_price'] = $cart->unit_sale_price;
        $temp['amount'] = $cart->amount;
        $temp['discount'] = $cart->discount;
        $temp['taxable_amount'] = $cart->taxable_amount;
        $temp['cgst'] = $cart->cgst;
        $temp['sgst'] = $cart->sgst;
        $temp['total'] = $cart->total;
        $temp['discount_approved_by_id'] = $cart->discount_approved_by_id;
        $temp['is_default_item'] = false;

        array_push($this->arrCart, $temp);

        $this->calculatePayble();
        //reseting form
        $this->reset('item_id', 'item_name', 'batch_no', 'exd', 'batch_nos', 'quantity', 'unit_sale_price', 'amount', 'discount', 'discountAmount',  'taxable_amount', 'cgst', 'sgst', 'total');
    }

    public function editCart($id)
    {
        $item = $this->arrCart[$id - 1];
        if ($item["is_default_item"]) {
            IpPharmacyIndentItem::where('id', $item["is_default_item"])->delete();
        }

        unset($this->arrCart[$id - 1]);

        $this->calculatePayble();
        $this->render();

        session()->flash('message', 'Item Removed Successfully.');
    }

    public function calculatePayble()
    {
        $sum = 0;
        foreach ($this->arrCart as $item) {
            $sum = $sum + $item['total'];
        }
        $this->payableAmount = $sum + $this->prviousDuesAmount;
        $this->payingAmount = $sum + $this->prviousDuesAmount;;
    }

    public function payingAmountChanged()
    {
        $this->dueAmount = $this->payableAmount - $this->payingAmount;
    }

    public function save()
    {
        $this->validate([
            'bill_no' => 'required',
            'bill_date' => 'required',
            'umr' => 'required',
            'stock_point_id' => 'required',
            'admn_no' => 'required',
            'patient_name' => 'required',
            'nrq_no' => 'required',
            'indent_by' => 'required',
            'doctor_code' => 'required',
            'doctor_name' => 'required',
            'req_dept' => 'required',
            // 'ward' => 'required',
            // 'patient_type' => 'required',
            // 'corporate_name' => 'required',
            'drug_destination_name' => '',
            'arrCart' => 'required',
            "payableAmount" => "required",
            "payment_mode" => "required",
            "transaction_id" => "required_if:payment_mode,online",
        ], [
            "arrCart.required" => "Please add at least one item.",
        ]);

        if (isset($this->drug_indent_details?->ipd?->wallet) && $this->drug_indent_details?->ipd?->wallet) {

            $bill = IpPharmacyIndentBilling::where('ip_pharmacy_indent_id', $this->drug_indent_details?->id)
                ->where("ipd_id", $this->drug_indent_details?->ipd_id)
                ->where("patient_id", $this->drug_indent_details?->patient_id)
                ->count();

            if ($bill) {
                session()->flash('error', 'Bill already generated for this indent');
                return;
            }

            $balance_check = wallet_check_amount_limit($this->drug_indent_details?->ipd_id, $this->drug_indent_details?->patient_id, $this->payment_mode, $this->payingAmount);
            if ($balance_check['error']) {
                session()->flash('error', $balance_check['msg']);
                return;
            }

            $gross_amount = 0;
            $discount_amount = 0;
            $other_amount = 0;


            DB::beginTransaction();
            try {
                $drug_indent_bill = IpPharmacyIndentBilling::create([
                    'ip_pharmacy_indent_id' => $this->drug_indent_details?->id,
                    'ipd_id' => $this->drug_indent_details?->ipd_id,
                    'patient_id' => $this->drug_indent_details?->patient_id,
                    'stock_point_id' => $this->drug_indent_details?->stock_point_id,
                    'code' => $this->generateBillNo(),
                    'total' => $this->payableAmount,
                    'drug_destination_name' => $this->drug_destination_name,
                    'gross_amount' => 0,
                    'discount_amount' => 0,
                    'due_amount' => $this->dueAmount,
                    'advance_amount' => $this->payingAmount > $this->payableAmount ? $this->payingAmount - $this->payableAmount : 0,
                    'other_amount' => 0,
                    'total_amount' => $this->payableAmount,
                    'paid_amount' => $this->payingAmount,
                    'payment_by' => $this->payment_mode,
                    'created_by_id' => auth()->user()?->id,
                ]);

                $data = [];
                foreach ($this->arrCart as $item) {
                    if (!$item["is_default_item"]) {
                        IpPharmacyIndentItem::create([
                            "ip_pharmacy_indent_id" => $this->drug_indent_details?->id,
                            "item_id" => $item['item_id'],
                            "stock_point_id" => $item['stock_point_id'],
                            "batch_no" => $item['batch_no'],
                            "exd" => date("Y-m-d", strtotime($item['exd'])),
                            "quantity" => $item['quantity'],
                            "unit_sale_price" => $item['unit_sale_price'],
                            "amount" => $item['amount'],
                            "discount" => ($item['amount'] * $item['discount']) / 100,
                            "taxable_amount" => $item['taxable_amount'],
                            "cgst" => $item['cgst'],
                            "sgst" => $item['sgst'],
                            "total" => $item['total'],
                            "discount_approved_by_id" => $item['discount_approved_by_id'],
                        ]);
                    }

                    $gross_amount += $item['amount'];
                    $discount_amount += ($item['amount'] * $item['discount']) / 100;
                    $other_amount += $item['amount'] * ($item['cgst'] + $item['sgst']) / 100;

                    $temp = [];
                    $temp['ip_pharmacy_indent_billing_id'] = $drug_indent_bill->id;
                    $temp['item_id'] = $item['item_id'];
                    $temp['stock_point_id'] = $item['stock_point_id'];
                    $temp['quantity'] = $item['quantity'];
                    $temp['unit_sale_price'] = $item['unit_sale_price'];
                    $temp['amount'] = $item['amount'];
                    $temp['discount'] = ($item['amount'] * $item['discount']) / 100;
                    $temp['taxable_amount'] = $item['taxable_amount'];
                    $temp['cgst'] = $item['cgst'];
                    $temp['sgst'] = $item['sgst'];
                    $temp['total'] = $item['total'];
                    $temp['created_at'] = date('Y-m-d H:i:s');
                    $temp['updated_at'] = date('Y-m-d H:i:s');

                    array_push($data, $temp);
                }

                IpPharmacyIndentBillingItem::insert($data);

                $wallet_transaction = wallet_transaction($this->drug_indent_details?->ipd_id, $this->drug_indent_details?->patient_id, $this->payingAmount, $this->payment_mode, $this->transaction_id, "success");

                $drug_indent_bill->update([
                    'gross_amount' => $gross_amount,
                    'discount_amount' => $discount_amount,
                    'other_amount' => $other_amount,
                ]);

                $this->drug_indent_details->status = "Approved";
                $this->drug_indent_details->save();

                if ($this->dueAmount) {
                    $pharmacyDueData = [
                        'stock_point_id' => $this->stock_point_id,
                        'patient_id' => $this->drug_indent_details?->patient_id,
                        'ipd_id' => $this->drug_indent_details?->ipd_id,
                        'ip_pharmacy_indent_billing_id' =>  $drug_indent_bill->id,
                        'total_amount' => $this->payableAmount,
                        'paid_amount' => $this->payingAmount,
                        'due_amount' => $this->dueAmount,
                        'is_due_cleared' => false,
                        'due_clrarance_date' => null,
                        'approved_by_id' => $this->dueAmount > 0 ? $this->due_approved_by_id : null,
                    ];

                    if ($this->ipPharmacyDue->sum('due_amount')) {
                        IpPharmacyDue::where('patient_id', $this->drug_indent_details?->patient_id)
                            ->where('ipd_id', $this->drug_indent_details?->ipd_id)
                            ->where('is_due_cleared', 0)
                            ->update([
                                'is_due_cleared' => 1,
                                'due_clrarance_date' => date('Y-m-d'),
                            ]);
                    }
                    IpPharmacyDue::create($pharmacyDueData);
                } else {
                    if ($this->ipPharmacyDue->sum('due_amount')) {
                        IpPharmacyDue::where('patient_id', $this->drug_indent_details?->patient_id)
                            ->where('ipd_id', $this->drug_indent_details?->ipd_id)
                            ->where('is_due_cleared', 0)
                            ->update([
                                'is_due_cleared' => 1,
                                'due_clrarance_date' => date('Y-m-d'),
                            ]);
                    }
                }

                IpPharmacyBillingTransaction::create([
                    'ip_pharmacy_indent_billing_id' => $drug_indent_bill->id,
                    'ip_pharmacy_indent_id' => $this->drug_indent_details?->id,
                    'ipd_id' => $this->drug_indent_details?->ipd_id,
                    'patient_id' => $this->drug_indent_details?->patient_id,
                    'stock_point_id' => $this->drug_indent_details?->stock_point_id,
                    'wallet_transaction_id' => $wallet_transaction->id,
                    'amount' => $this->payingAmount,
                    'received_by_id' => auth()->user()?->id,
                ]);

                DB::commit();
                return redirect()->route('admin.pharmacy.issues.ip-pharmacy-billing.print', $drug_indent_bill->id);
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Something went wrong ' . $e->getMessage());
                return;
            }
        }

        session()->flash('error', 'Wallet account not found...');
    }

    public function render()
    {
        return view('livewire.pharmacy.issues.ip-pharmacy-billing.ip-pharmacy-billing-create')->extends('layouts.admin')->section('content');
    }
}
