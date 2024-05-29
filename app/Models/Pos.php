<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Pos extends Model
{
    protected $fillable = [
        'pos_id',
        'customer_id',
        'warehouse_id',
        'pos_date',
        'category_id',
        'status',
        'shipping_display',
        'created_by',
    ];

    public function customer()
    {

        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }
    public function warehouse()
    {
        return $this->hasOne('App\Models\warehouse', 'id', 'warehouse_id');
    }

    public function posPayment()
    {
        return $this->hasOne('App\Models\PosPayment','pos_id','id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\PosProduct', 'pos_id', 'id');
    }
    public function taxes()
    {
        return $this->hasOne('App\Models\Tax', 'id', 'tax');
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

    public function getTotalDiscount()
    {
        $totalDiscount = 0;
        foreach($this->items as $product)
        {

            $totalDiscount += $product->discount;
        }

        return $totalDiscount;
    }

    public function getTotalTax()
    {

        $totalTax = 0;
        foreach($this->items as $product)
        {

            $taxes = Utility::totalTaxRate($product->tax);


            $totalTax += ($taxes / 100) * ($product->price * $product->quantity) ;

        }

        return $totalTax;
    }

    //pos dashboard

    public function getTotal()
    {
        return ($this->getSubTotal() -$this->getTotalDiscount()) + $this->getTotalTax();
    }

    public static function totalPosAmount($month = false)
    {

        $poses = new Pos();
        $poses = $poses->where('created_by', '=', Auth::user()->creatorId());
        if($month)
        {
            $poses = $poses->whereRaw('MONTH(created_at) = ?', [date('m')]);
        }

        $posAmount = 0;

        foreach($poses->get() as $key => $pos)
        {
            $posAmount += $pos->getTotal();
        }

        return Auth::user()->priceFormat($posAmount);
    }

    public static function getPosReportChart()
    {
        $poses = Pos::whereDate('created_at', '>', Carbon::now()->subDays(10))->where('created_by', '=', Auth::user()->creatorId())->orderBy('created_at')->get()->groupBy(
            function ($val){
                return Carbon::parse($val->created_at)->format('dm');
            }
        );
        $total = [];
        if(!empty($poses) && count($poses) > 0)
        {
            foreach($poses as $day => $onesale)
            {
                $totals = 0;
                foreach($onesale as $pos)
                {
                    $totals += $pos->getTotal();
                }
                $total[$day] = $totals;
            }
        }
        $m = date("m");
        $d = date("d");
        $y = date("Y");
        for($i = 0; $i <= 9; $i++)
        {
            $date                  = date('Y-m-d', mktime(0, 0, 0, $m, ($d - $i), $y));
            $posesArray['label'][] = $date;
            $date                  = date('dm', strtotime($date));
            $posesArray['value'][] = array_key_exists($date, $total) ? $total[$date] : 0;;
        }

        return $posesArray;
    }




}



