<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'vender_id',
        'warehouse_id',
        'purchase_date',
        'purchase_number',
        'discount_apply',
        'category_id',
        'created_by',
    ];
    public static $statues = [
        'Draft',
        'Sent',
        'Unpaid',
        'Partialy Paid',
        'Paid',
    ];
    public function vender()
    {
        return $this->hasOne('App\Models\Vender', 'id', 'vender_id');
    }

    public function tax()
    {
        return $this->hasOne('App\Models\Tax', 'id', 'tax_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\PurchaseProduct', 'purchase_id', 'id');
    }
    public function payments()
    {
        return $this->hasMany('App\Models\PurchasePayment', 'purchase_id', 'id');
    }
    public function category()
    {
        return $this->hasOne('App\Models\ProductServiceCategory', 'id', 'category_id');
    }
    public function getSubTotal()
    {

        $subTotal = 0;
        foreach($this->items as $product)
        {

            $subTotal += ($product->price * $product->quantity);
        }

        return $subTotal;
    }
    public function getTotal()
    {

        return ($this->getSubTotal() -$this->getTotalDiscount()) + $this->getTotalTax();
    }
    public function getTotalTax()
    {
        $totalTax = 0;
        foreach($this->items as $product)
        {
            $taxes = Utility::totalTaxRate($product->tax);

            $totalTax += ($taxes / 100) * ($product->price * $product->quantity - $product->discount) ;

        }

        return $totalTax;
    }
    public function getTotalDiscount()
    {
        $totalDiscount = 0;
        foreach($this->items as $product)
        {
            $totalDiscount += $product->discount;
        }

        return $totalDiscount;
    }
    public function getDue()
    {
        $due = 0;
        foreach($this->payments as $payment)
        {
            $due += $payment->amount;
        }

        return ($this->getTotal() - $due);
    }
    public function lastPayments()
    {
        return $this->hasOne('App\Models\PurchasePayment', 'id', 'purchase_id');
    }

    public function taxes()
    {
        return $this->hasOne('App\Models\Tax', 'id', 'tax');
    }

    public static function totalPurchaseAmount($month = false)
    {
        $purchased = new Purchase();
        $purchased = $purchased->where('created_by', '=', Auth::user()->creatorId());
        if ($month)
        {
            $purchased = $purchased->whereRaw('MONTH(created_at) = ?', [date('m')]);
        }
        $purchasedAmount = 0;
        foreach ($purchased->get() as $key => $purchase) {
            $purchasedAmount += $purchase->getTotal();
        }
        return Auth::user()->priceFormat($purchasedAmount);
    }

    public static function getPurchaseReportChart()
    {
        $purchases = Purchase::whereDate('created_at', '>', Carbon::now()->subDays(10))
                            ->where('created_by', '=', Auth::user()->creatorId())
                            ->orderBy('created_at')->get()->groupBy(
                                function ($val) {
                                    return Carbon::parse($val->created_at)->format('dm');
                                });

        $total = [];
        if (!empty($purchases) && count($purchases) > 0) {
            foreach ($purchases as $day => $onepurchase) {
                $totals = 0;
                foreach ($onepurchase as $purchase) {
                    $totals += $purchase->getTotal();
                }
                $total[$day] = $totals;
            }
        }
        $d = date("d");
        $m = date("m");
        $y = date("Y");

        for ($i = 0; $i <= 9; $i++) {
            $date                      = date('Y-m-d', mktime(0, 0, 0, $m, ($d - $i), $y));
            $purchasesArray['label'][] = $date;
            $date                      = date('dm', strtotime($date));
            $purchasesArray['value'][] = array_key_exists($date, $total) ? $total[$date] : 0;;
        }

        return $purchasesArray;
    }




}
