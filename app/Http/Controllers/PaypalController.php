<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\Order;
use App\Models\Plan;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
//    private   $_api_context;
    protected $invoiceData;


    public function paymentConfig()
    {
        if (\Auth::check()) {
            $payment_setting = Utility::getAdminPaymentSetting();
        } else {

            $payment_setting = Utility::getCompanyPaymentSetting(!empty($this->invoiceData)?$this->invoiceData->created_by:0);
        }

        if($payment_setting['paypal_mode'] == 'live'){
            config([
                'paypal.live.client_id' => isset($payment_setting['paypal_client_id']) ? $payment_setting['paypal_client_id'] : '',
                'paypal.live.client_secret' => isset($payment_setting['paypal_secret_key']) ? $payment_setting['paypal_secret_key'] : '',
                'paypal.mode' => isset($payment_setting['paypal_mode']) ? $payment_setting['paypal_mode'] : '',
            ]);
        }else{
            config([
                'paypal.sandbox.client_id' => isset($payment_setting['paypal_client_id']) ? $payment_setting['paypal_client_id'] : '',
                'paypal.sandbox.client_secret' => isset($payment_setting['paypal_secret_key']) ? $payment_setting['paypal_secret_key'] : '',
                'paypal.mode' => isset($payment_setting['paypal_mode']) ? $payment_setting['paypal_mode'] : '',
            ]);
        }

    }


    public function customerPayWithPaypal(Request $request, $invoice_id)
    {

        $invoice                 = Invoice::find($invoice_id);
        $this->invoiceData       = $invoice;

        $this->paymentConfig();
        $settings                = DB::table('settings')->where('created_by', '=', $invoice->created_by)->get()->pluck('value', 'name');
        $get_amount = $request->amount;
        $request->validate(['amount' => 'required|numeric|min:0']);


        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));


//        $invoice = Invoice::find($invoice_id);

        if($invoice)
        {
            if($get_amount > $invoice->getDue())
            {
                return redirect()->back()->with('error', __('Invalid amount.'));
            }
            else
            {

                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                $name = Utility::invoiceNumberFormat($settings, $invoice->invoice_id);

                $paypalToken = $provider->getAccessToken();
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('customer.get.payment.status',[$invoice->id,$get_amount]),
                        "cancel_url" =>  route('customer.get.payment.status',[$invoice->id,$get_amount]),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => Utility::getValByName('site_currency'),
                                "value" => $get_amount
                            ]
                        ]
                    ]
                ]);


                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()
                        ->route('invoice.show', \Crypt::encrypt($invoice->id))
                        ->with('error', 'Something went wrong.');
                } else {
                    return redirect()
                        ->route('invoice.show', \Crypt::encrypt($invoice->id))
                        ->with('error', $response['message'] ?? 'Something went wrong.');
                }



//                $payer = new Payer();
//                $payer->setPaymentMethod('paypal');
//
//                $item_1 = new Item();
//                $item_1->setName($name)->setCurrency(Utility::getValByName('site_currency'))->setQuantity(1)->setPrice($get_amount);
//
//                $item_list = new ItemList();
//                $item_list->setItems([$item_1]);
//
//                $amount = new Amount();
//                $amount->setCurrency(Utility::getValByName('site_currency'))->setTotal($get_amount);
//
//                $transaction = new Transaction();
//                $transaction->setAmount($amount)->setItemList($item_list)->setDescription($name)->setInvoiceNumber($orderID);
//
//                $redirect_urls = new RedirectUrls();
//                $redirect_urls->setReturnUrl(
//                    route(
//                        'customer.get.payment.status', $invoice->id
//                    )
//                )->setCancelUrl(
//                    route(
//                        'customer.get.payment.status', $invoice->id
//                    )
//                );
//
//                $payment = new Payment();
//                $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions([$transaction]);
//
//                try
//                {
//
//                    $payment->create($this->_api_context);
//                }
//                catch(\PayPal\Exception\PayPalConnectionException $ex) //PPConnectionException
//                {
//                    if(\Config::get('app.debug'))
//                    {
//                        return redirect()->back()->with('error', __('Connection timeout'));
//                    }
//                    else
//                    {
//                        return redirect()->back()->with('error', __('Some error occur, sorry for inconvenient'));
//                    }
//                }
//                foreach($payment->getLinks() as $link)
//                {
//                    if($link->getRel() == 'approval_url')
//                    {
//                        $redirect_url = $link->getHref();
//                        break;
//                    }
//                }
//                Session::put('paypal_payment_id', $payment->getId());
//                if(isset($redirect_url))
//                {
//                    return Redirect::away($redirect_url);
//                }

                return redirect()->back()->with('error', __('Unknown error occurred'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function customerGetPaymentStatus(Request $request, $invoice_id,$amount)
    {

        $invoice                 = Invoice::find($invoice_id);
        $this->invoiceData       = $invoice;
        $settings                = DB::table('settings')->where('created_by', '=', $invoice->created_by)->get()->pluck('value', 'name');
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');

        if(empty($request->PayerID || empty($request->token)))
        {
            return redirect()->back()->with('error', __('Payment failed'));
        }

//        $payment = Payment::get($payment_id, $this->_api_context);

//        $execution = new PaymentExecution();
//        $execution->setPayerId($request->PayerID);

        try
        {
//            $result   = $payment->execute($execution, $this->_api_context)->toArray();
            $order_id = strtoupper(str_replace('.', '', uniqid('', true)));
//            $status   = ucwords(str_replace('_', ' ', $result['state']));
//            if($result['state'] == 'approved')
//            {
//                $amount = $result['transactions'][0]['amount']['total'];
//            }
//            else
//            {
//                $amount = isset($result['transactions'][0]['amount']['total']) ? $result['transactions'][0]['amount']['total'] : '0.00';
//            }
//
//
//            if($result['state'] == 'approved')
//            {
                $payments = InvoicePayment::create(
                    [

                        'invoice_id' => $invoice->id,
                        'date' => date('Y-m-d'),
                        'amount' => $amount,
                        'account_id' => 0,
                        'payment_method' => 0,
                        'order_id' => $order_id,
                        'currency' => Utility::getValByName('site_currency'),
                        'txn_id' => $payment_id,
                        'payment_type' => __('PAYPAL'),
                        'receipt' => '',
                        'reference' => '',
                        'description' => 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id),
                    ]
                );

                if($invoice->getDue() <= 0)
                {
                    $invoice->status = 4;
                    $invoice->save();
                }
                elseif(($invoice->getDue() - $payments->amount) == 0)
                {
                    $invoice->status = 4;
                    $invoice->save();
                }
                else
                {
                    $invoice->status = 3;
                    $invoice->save();
                }

                $invoicePayment              = new \App\Models\Transaction();
                $invoicePayment->user_id     = $invoice->customer_id;
                $invoicePayment->user_type   = 'Customer';
                $invoicePayment->type        = 'PAYPAL';
                $invoicePayment->created_by  = $invoice->created_by;
                $invoicePayment->payment_id  = $invoicePayment->id;
                $invoicePayment->category    = 'Invoice';
                $invoicePayment->amount      = $amount;
                $invoicePayment->date        = date('Y-m-d');
                $invoicePayment->payment_id  = $payments->id;
                $invoicePayment->description = 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id);
                $invoicePayment->account     = 0;

//                \App\Models\Transaction::addTransaction($invoicePayment);

//                Utility::userBalance('customer', $invoice->customer_id, $request->amount, 'debit');
//
//                Utility::bankAccountBalance($request->account_id, $request->amount, 'credit');

                //Slack Notification
                $setting  = Utility::settings($invoice->created_by);
                $customer = Customer::find($invoice->customer_id);
                if(isset($setting['payment_notification']) && $setting['payment_notification'] == 1)
                {
                    $msg = __("New payment of").' ' . $amount . __("created for").' ' . $customer->name . __("by").' '. $invoicePayment->type . '.';
                    Utility::send_slack_msg($msg,$invoice->created_by);
                }

                //Telegram Notification
                $setting  = Utility::settings($invoice->created_by);
                $customer = Customer::find($invoice->customer_id);
                if(isset($setting['telegram_payment_notification']) && $setting['telegram_payment_notification'] == 1)
                {
                    $msg = __("New payment of").' ' . $amount . __("created for").' ' . $customer->name . __("by").' '. $invoicePayment->type . '.';
                    Utility::send_telegram_msg($msg,$invoice->created_by);
                }

                //Twilio Notification
                $setting  = Utility::settings($invoice->created_by);
                $customer = Customer::find($invoice->customer_id);
                if(isset($setting['twilio_payment_notification']) && $setting['twilio_payment_notification'] ==1)
                {
                    $msg = __("New payment of").' ' . $amount . __("created for").' ' . $customer->name . __("by").' '.  $invoicePayment->type . '.';
                    Utility::send_twilio_msg($customer->contact,$msg,$invoice->created_by);
                }

                return redirect()->back()->with('success', __('Payment successfully added'));
//            }
//            else
//            {
//                return redirect()->back()->with('error', __('Transaction has been ' . $status));
//            }

        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', __('Transaction has been failed.'));
        }

    }

    public function planPayWithPaypal(Request $request)
    {
        $planID = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan   = Plan::find($planID);
        $this->paymentConfig();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $get_amount = $plan->price;
        // dd($get_amount);
        if($plan){
            try
            {
                $coupon_id = null;
                $price     = $plan->price;
                if(!empty($request->coupon))
                {
                    $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                    if(!empty($coupons))
                    {
                        $usedCoupun     = $coupons->used_coupon();
                        $discount_value = ($plan->price / 100) * $coupons->discount;
                        $price          = $plan->price - $discount_value;
                        if($coupons->limit == $usedCoupun)
                        {
                            return redirect()->back()->with('error', __('This coupon code has expired.'));
                        }
                        $coupon_id = $coupons->id;
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                    }
                }
                $paypalToken = $provider->getAccessToken();
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('plan.get.payment.status',[$plan->id,$get_amount]),
                        "cancel_url" =>  route('plan.get.payment.status',[$plan->id,$get_amount]),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => Utility::getValByName('site_currency'),
                                "value" => $get_amount
                            ]
                        ]
                    ]
                ]);
                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()
                        ->route('plans.index')
                        ->with('error', 'Something went wrong.');
                } else {
                    return redirect()
                        ->route('plans.index')
                        ->with('error', $response['message'] ?? 'Something went wrong.');
                }
            }
            catch(\Exception $e)
            {
                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
            }
        }else{
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function planGetPaymentStatus(Request $request, $plan_id)
    {
        $this->paymentConfig();
        $user = Auth::user();
        $plan = Plan::find($plan_id);
        if($plan)
        {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            $payment_id = Session::get('paypal_payment_id');
            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $order                 = new Order();
                $order->order_id       = $orderID;

                $order->name           = $user->name;
                $order->card_number    = '';
                $order->card_exp_month = '';
                $order->card_exp_year  = '';
                $order->plan_name      = $plan->name;
                $order->plan_id        = $plan->id;
                // $order->price         = $result['transactions'][0]['amount']['total'];
                $order->price = $plan->price;
                $order->price_currency = env('CURRENCY');

                // $order->txn_id         = $payment_id;
                $order->txn_id ='';
                $order->payment_type   = __('PAYPAL');
                // $order->payment_status = $result['state'];
                $order->payment_status ='COMPLETED';
                $order->receipt        = '';
                $order->user_id        = $user->id;
                $order->save();
                $assignPlan = $user->assignPlan($plan->id);
                if($assignPlan['is_success'])
                {
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                }
                else
                {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }
                return redirect()
                    ->route('plans.index')
                    ->with('success', 'Transaction complete.');
            } else {
                return redirect()
                    ->route('plans.index')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }
        else
        {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }


//    public function planPayWithPaypal(Request $request)
//    {
//
//        $planID = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
//        $plan   = Plan::find($planID);
//
//        if($plan)
//        {
//
//            try
//            {
//                $coupon_id = null;
//                $price     = $plan->price;
//                if(!empty($request->coupon))
//                {
//                    $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
//                    if(!empty($coupons))
//                    {
//                        $usedCoupun     = $coupons->used_coupon();
//                        $discount_value = ($plan->price / 100) * $coupons->discount;
//                        $price          = $plan->price - $discount_value;
//                        if($coupons->limit == $usedCoupun)
//                        {
//                            return redirect()->back()->with('error', __('This coupon code has expired.'));
//                        }
//                        $coupon_id = $coupons->id;
//                    }
//                    else
//                    {
//                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
//                    }
//                }
//
////                $this->paymentConfig();
//                $name  = $plan->name;
//                $payer = new Payer();
//                $payer->setPaymentMethod('paypal');
//                $item_1 = new Item();
//                $item_1->setName($name)->setCurrency(env('CURRENCY'))->setQuantity(1)->setPrice($price);
//                $item_list = new ItemList();
//                $item_list->setItems([$item_1]);
//                $amount = new Amount();
//                $amount->setCurrency(env('CURRENCY'))->setTotal($price);
//                $transaction = new Transaction();
//                $transaction->setAmount($amount)->setItemList($item_list)->setDescription($name);
//                $redirect_urls = new RedirectUrls();
//                $redirect_urls->setReturnUrl(
//                    route(
//                        'plan.get.payment.status', [
//                            $plan->id,
//                            'coupon_id' => $coupon_id,
//                        ]
//                    )
//                )->setCancelUrl(
//                    route(
//                        'plan.get.payment.status', [
//                            $plan->id,
//                            'coupon_id' => $coupon_id,
//                        ]
//                    )
//                );
//                $payment = new Payment();
//                $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions([$transaction]);
//
//                try
//                {
//                    $payment->create($this->_api_context);
//                }
//                catch(\PayPal\Exception\PayPalConnectionException $ex) //PPConnectionException
//                {
//
//
//                    if(config('app.debug'))
//                    {
//                        return redirect()->route('stripe', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))->with('error', __('Connection timeout'));
//                    }
//                    else
//                    {
//                        return redirect()->route('stripe', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))->with('error', __('Some error occur, sorry for inconvenient'));
//                    }
//                }
//                foreach($payment->getLinks() as $link)
//                {
//                    if($link->getRel() == 'approval_url')
//                    {
//                        $redirect_url = $link->getHref();
//                        break;
//                    }
//                }
//                Session::put('paypal_payment_id', $payment->getId());
//                if(isset($redirect_url))
//                {
//                    return Redirect::away($redirect_url);
//                }
//
//                return redirect()->route('payment', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))->with('error', __('Unknown error occurred'));
//            }
//            catch(\Exception $e)
//            {
//
//                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
//            }
//        }
//        else
//        {
//            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
//        }
//    }

//    public function planGetPaymentStatus(Request $request, $plan_id)
//    {
//        $user = Auth::user();
//        $plan = Plan::find($plan_id);
//        if($plan)
//        {
////            $this->paymentConfig();
//            $payment_id = Session::get('paypal_payment_id');
//            Session::forget('paypal_payment_id');
//            if(empty($request->PayerID || empty($request->token)))
//            {
//                return redirect()->route('plans.index', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))->with('error', __('Payment failed'));
//            }
//            $payment   = Payment::get($payment_id, $this->_api_context);
//            $execution = new PaymentExecution();
//            $execution->setPayerId($request->PayerID);
//            try
//            {
//                $result  = $payment->execute($execution, $this->_api_context)->toArray();
//                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
//                $status  = ucwords(str_replace('_', ' ', $result['state']));
//                if($request->has('coupon_id') && $request->coupon_id != '')
//                {
//                    $coupons = Coupon::find($request->coupon_id);
//                    if(!empty($coupons))
//                    {
//                        $userCoupon         = new UserCoupon();
//                        $userCoupon->user   = $user->id;
//                        $userCoupon->coupon = $coupons->id;
//                        $userCoupon->order  = $orderID;
//                        $userCoupon->save();
//                        $usedCoupun = $coupons->used_coupon();
//                        if($coupons->limit <= $usedCoupun)
//                        {
//                            $coupons->is_active = 0;
//                            $coupons->save();
//                        }
//                    }
//                }
//                if($result['state'] == 'approved')
//                {
//
//                    $order                 = new Order();
//                    $order->order_id       = $orderID;
//                    $order->name           = $user->name;
//                    $order->card_number    = '';
//                    $order->card_exp_month = '';
//                    $order->card_exp_year  = '';
//                    $order->plan_name      = $plan->name;
//                    $order->plan_id        = $plan->id;
//                    $order->price          = $result['transactions'][0]['amount']['total'];
//                    $order->price_currency = env('CURRENCY');
//                    $order->txn_id         = $payment_id;
//                    $order->payment_type   = __('PAYPAL');
//                    $order->payment_status = $result['state'];
//                    $order->receipt        = '';
//                    $order->user_id        = $user->id;
//                    $order->save();
//                    $assignPlan = $user->assignPlan($plan->id);
//                    if($assignPlan['is_success'])
//                    {
//                        return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
//                    }
//                    else
//                    {
//                        return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
//                    }
//                }
//                else
//                {
//                    return redirect()->route('plans.index')->with('error', __('Transaction has been ' . __($status)));
//                }
//            }
//            catch(\Exception $e)
//            {
//                return redirect()->route('plans.index')->with('error', __('Transaction has been failed.'));
//            }
//        }
//        else
//        {
//            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
//        }
//    }
}
