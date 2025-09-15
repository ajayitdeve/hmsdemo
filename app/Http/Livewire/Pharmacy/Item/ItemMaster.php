<?php

namespace App\Http\Livewire\Pharmacy\Item;

use App\Models\Category;
use App\Models\Form;
use App\Models\Generic;
use App\Models\Item;
use App\Models\ItemGroup;
use App\Models\ItemSpecialization;
use App\Models\Manufacturer;
use App\Models\Type;
use App\Models\Uom;
use Livewire\Component;

class ItemMaster extends Component
{
    public $description, $code, $hsn, $igst, $cgst, $sgst, $type_id = 1, $item_group_id, $generic_id, $form_id;
    public $category_id, $item_specialization_id, $manufacturer_id, $purchase_uom_id, $issue_uom_id;
    public $item_id;

    public $alert_days_before_expiry = 0;
    public $sale_rate_for_billing_amount = 0, $sale_rate_for_billing_percentage = 0, $sale_rate_for_billing_used_for = 'both';
    public $is_asset = 0, $batch_no_required = 0, $is_narcotic = 0, $is_high_risk = 0, $is_non_returnable_item = 0;

    public $types = [], $itemgroups = [], $generics = [], $forms = [], $categories = [], $itemspecializations = [], $manufacturers = [], $uoms = [];
    public $items = [];

    public function mount()
    {
        $this->types = Type::get();
        $this->itemgroups = ItemGroup::get();
        $this->generics = Generic::get();
        $this->forms = Form::get();
        $this->categories = Category::get();
        $this->itemspecializations = ItemSpecialization::get();
        $this->manufacturers = Manufacturer::get();
        $this->uoms = Uom::get();
        $this->fetchItems();
        $this->uoms = Uom::get();
    }

    protected function rules()
    {
        return [
            'description' => 'required',
            'code' => 'required',
            'hsn' => 'required',
            'igst' => 'required|numeric',
            'cgst' => 'required|numeric',
            'sgst' => 'required|numeric',
            'type_id' => 'required',
            'item_group_id' => 'required',
            'generic_id' => 'required',
            'form_id' => 'required',
            // 'category_id' => 'required',
            // 'item_specialization_id'=>'required',
            // 'manufacturer_id' => 'required',
            'purchase_uom_id' => 'required',
            'issue_uom_id' => 'required',

            'sale_rate_for_billing_amount' => 'nullable|numeric',
            'sale_rate_for_billing_percentage' => 'nullable|numeric',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        $item = new Item();

        $item->description = $this->description;
        $item->code = $this->code;
        $item->hsn = $this->hsn;
        $item->igst = $this->igst;
        $item->cgst = $this->cgst;
        $item->sgst = $this->sgst;
        $item->type_id = $this->type_id;
        $item->item_group_id = $this->item_group_id;
        $item->generic_id = $this->generic_id;
        $item->form_id = $this->form_id;
        $item->category_id = $this->category_id ?: null;
        $item->item_specialization_id = $this->item_specialization_id ?: null;
        $item->manufacturer_id = $this->manufacturer_id ?: null;
        $item->purchase_uom_id = $this->purchase_uom_id;
        $item->issue_uom_id = $this->issue_uom_id;

        $item->alert_days_before_expiry = $this->alert_days_before_expiry;
        $item->sale_rate_for_billing_amount = $this->sale_rate_for_billing_amount;
        $item->sale_rate_for_billing_percentage = $this->sale_rate_for_billing_percentage;
        $item->sale_rate_for_billing_used_for = $this->sale_rate_for_billing_used_for;
        $item->is_asset = $this->is_asset;
        $item->batch_no_required = $this->batch_no_required;
        $item->is_narcotic = $this->is_narcotic;
        $item->is_high_risk = $this->is_high_risk;
        $item->is_non_returnable_item = $this->is_non_returnable_item;
        $item->save();
        session()->flash('message', 'Item Group Added Successfully.');
        $this->resetInput();
        $this->fetchItems();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $item_id)
    {
        $this->item_id = $item_id;
        $item = Item::find($item_id);
        if ($item) {
            $this->item_id = $item->id;
            $this->description = $item->description;
            $this->code = $item->code;
            $this->hsn = $item->hsn;
            $this->igst = $item->igst;
            $this->cgst = $item->cgst;
            $this->sgst = $item->sgst;
            $this->type_id = $item->type_id;
            $this->item_group_id = $item->item_group_id;
            $this->generic_id = $item->generic_id;
            $this->form_id = $item->form_id;
            $this->category_id = $item->category_id;
            $this->item_specialization_id = $item->item_specialization_id ?: null;
            $this->manufacturer_id = $item->manufacturer_id ?: null;
            $this->purchase_uom_id = $item->purchase_uom_id;
            $this->issue_uom_id = $item->issue_uom_id;

            $this->alert_days_before_expiry = $item->alert_days_before_expiry;
            $this->sale_rate_for_billing_amount = $item->sale_rate_for_billing_amount;
            $this->sale_rate_for_billing_percentage = $item->sale_rate_for_billing_percentage;
            $this->sale_rate_for_billing_used_for = $item->sale_rate_for_billing_used_for;
            $this->is_asset = $item->is_asset;
            $this->batch_no_required = $item->batch_no_required;
            $this->is_narcotic = $item->is_narcotic;
            $this->is_high_risk = $item->is_high_risk;
            $this->is_non_returnable_item = $item->is_non_returnable_item;
        }
    }

    public function update()
    {
        $this->validate();

        Item::where('id', $this->item_id)->update([
            'description' => $this->description,
            'code' => $this->code,
            'hsn' => $this->hsn,
            'igst' => $this->igst,
            'cgst' => $this->cgst,
            'sgst' => $this->sgst,
            'type_id' => $this->type_id,
            'item_group_id' => $this->item_group_id,
            'generic_id' => $this->generic_id,
            'form_id' => $this->form_id,
            'category_id' => $this->category_id ?: null,
            'item_specialization_id' => $this->item_specialization_id ?: null,
            'manufacturer_id' => $this->manufacturer_id ?: null,
            'purchase_uom_id' => $this->purchase_uom_id,
            'issue_uom_id' => $this->issue_uom_id,

            'alert_days_before_expiry' => $this->alert_days_before_expiry,
            'sale_rate_for_billing_amount' => $this->sale_rate_for_billing_amount,
            'sale_rate_for_billing_percentage' => $this->sale_rate_for_billing_percentage,
            'sale_rate_for_billing_used_for' => $this->sale_rate_for_billing_used_for,
            'is_asset' => $this->is_asset,
            'batch_no_required' => $this->batch_no_required,
            'is_narcotic' => $this->is_narcotic,
            'is_high_risk' => $this->is_high_risk,
            'is_non_returnable_item' => $this->is_non_returnable_item,
        ]);

        session()->flash('message', 'Item Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->fetchItems();
    }

    public function fetchItems()
    {
        $this->items = Item::orderBy('id', 'DESC')->get();
    }

    public function delete(int $item_id)
    {
        $this->item_id = $item_id;
    }

    public function destroy()
    {

        Item::find($this->item_id)->delete();
        session()->flash(
            'message',
            'Item  delete Successfully.'
        );
        $this->resetInput();
        $this->fetchItems();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset([
            "description",
            "code",
            "hsn",
            "igst",
            "cgst",
            "sgst",
            "type_id",
            "item_group_id",
            "generic_id",
            "form_id",
            "category_id",
            "item_specialization_id",
            "manufacturer_id",
            "purchase_uom_id",
            "issue_uom_id",
            "item_id",
            "alert_days_before_expiry",
            "sale_rate_for_billing_amount",
            "sale_rate_for_billing_percentage",
            "sale_rate_for_billing_used_for",
            "is_asset",
            "batch_no_required",
            "is_narcotic",
            "is_high_risk",
            "is_non_returnable_item"
        ]);
    }

    public function itemDescriptionChanged()
    {

        $this->code = $this->getItemCode();
    }

    public function getItemCode()
    {
        $maxItemid = Item::max('id');
        $code = strtoupper(substr($this->description, 0, 3) . 'co' . $maxItemid + 1);

        return $code;
    }

    public function render()
    {
        return view('livewire.pharmacy.item.item-master')->extends('layouts.admin')->section('content');
    }
}
