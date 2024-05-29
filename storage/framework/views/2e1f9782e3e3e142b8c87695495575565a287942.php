<?php
    $settings_data = \App\Models\Utility::settingsById($invoice->created_by);

?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo e($settings_data['SITE_RTL'] == 'on'?'rtl':''); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <style type="text/css">
        :root {
            --theme-color: <?php echo e($color); ?>;
            --white: #ffffff;
            --black: #000000;
        }

        body {
            font-family: 'Lato', sans-serif;
        }

        p,
        li,
        ul,
        ol {
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 1.5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr th {
            padding: 0.75rem;
            text-align: left;
        }

        table tr td {
            padding: 0.75rem;
            text-align: left;
        }

        table th small {
            display: block;
            font-size: 12px;
        }

        .invoice-preview-main {
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            background: #ffff;
            box-shadow: 0 0 10px #ddd;
        }

        .invoice-logo {
            max-width: 200px;
            width: 100%;
        }

        .invoice-header table td {
            padding: 15px 30px;
        }

        .text-right {
            text-align: right;
        }

        .no-space tr td {
            padding: 0;
            white-space: nowrap;
        }

        .vertical-align-top td {
            vertical-align: top;
        }

        .view-qrcode {
            max-width: 139px;
            height: 139px;
            width: 100%;
            margin-left: auto;
            margin-top: 15px;
            background: var(--white);
            padding: 13px;
            border-radius: 10px;
        }

        .view-qrcode img {
            width: 100%;
            height: 100%;
        }

        .invoice-body {
            padding: 30px 25px 0;
        }



        table.add-border tr {
            border-top: 1px solid var(--theme-color);
        }

        tfoot tr:first-of-type {
            border-bottom: 1px solid var(--theme-color);
        }

        .total-table tr:first-of-type td {
            padding-top: 0;
        }

        .total-table tr:first-of-type {
            border-top: 0;
        }

        .sub-total {
            padding-right: 0;
            padding-left: 0;
        }

        .border-0 {
            border: none !important;
        }

        .invoice-summary td,
        .invoice-summary th {
            font-size: 13px;
            font-weight: 600;
        }

        .total-table td:last-of-type {
            width: 146px;
        }

        .invoice-footer {
            padding: 15px 20px;
        }

        .itm-description td {
            padding-top: 0;
        }
        html[dir="rtl"] table tr td,
        html[dir="rtl"] table tr th{
            text-align: right;
        }
        html[dir="rtl"]  .text-right{
            text-align: left;
        }
        html[dir="rtl"] .view-qrcode{
            margin-left: 0;
            margin-right: auto;
        }
    </style>

    <?php if($settings_data['SITE_RTL']=='on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-rtl.css')); ?>">
    <?php endif; ?>
</head>

<body class="">
<div class="invoice-preview-main"  id="boxes">
    <div class="invoice-header" style="background: <?php echo e($color); ?>;color:<?php echo e($font_color); ?>">
        <table>
            <tbody>
            <tr>
                <td>
                    <img class="invoice-logo" src="<?php echo e($img); ?>" alt="">
                </td>
                <td class="text-right">
                    <h3 style="text-transform: uppercase; font-size: 40px; font-weight: bold;"><?php echo e(__('INVOICE')); ?></h3>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="vertical-align-top">
            <tbody>
            <tr>
                <td>
                    <p>
                        <?php if($settings['company_name']): ?><?php echo e($settings['company_name']); ?><?php endif; ?><br>
                        <?php if($settings['company_email']): ?><?php echo e($settings['company_email']); ?><?php endif; ?><br><br>
                        <?php if($settings['company_address']): ?><?php echo e($settings['company_address']); ?><?php endif; ?>
                        <?php if($settings['company_city']): ?> <br> <?php echo e($settings['company_city']); ?>, <?php endif; ?>
                        <?php if($settings['company_state']): ?><?php echo e($settings['company_state']); ?><?php endif; ?>
                        <?php if($settings['company_zipcode']): ?> - <?php echo e($settings['company_zipcode']); ?><?php endif; ?>
                        <?php if($settings['company_country']): ?> <br><?php echo e($settings['company_country']); ?><?php endif; ?>
                        <?php if($settings['company_telephone']): ?><?php echo e($settings['company_telephone']); ?><?php endif; ?><br>
                        <?php if(!empty($settings['registration_number'])): ?><?php echo e(__('Registration Number')); ?> : <?php echo e($settings['registration_number']); ?> <?php endif; ?><br>
                        <?php if($settings['vat_gst_number_switch'] == 'on'): ?>
                            <?php if(!empty($settings['tax_type']) && !empty($settings['vat_number'])): ?><?php echo e($settings['tax_type'].' '. __('Number')); ?> : <?php echo e($settings['vat_number']); ?> <br><?php endif; ?>
                        <?php endif; ?>
                    </p>
                </td>
                <td>
                    <table class="no-space" style="width: 45%;margin-left: auto;">
                        <tbody>
                        <tr>
                            <td><?php echo e(__('Number')); ?>:</td>
                            <td class="text-right"><?php echo e(Utility::invoiceNumberFormat($settings,$invoice->invoice_id)); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(__('Issue Date')); ?>:</td>
                            <td class="text-right"><?php echo e(Utility::dateFormat($settings,$invoice->issue_date)); ?></td>
                        </tr>

                        <tr>
                            <td><b><?php echo e(__('Due Date:')); ?></b></td>
                            <td class="text-right"><?php echo e(Utility::dateFormat($settings,$invoice->due_date)); ?></td>
                        </tr>
                        <?php if(!empty($customFields) && count($invoice->customField)>0): ?>
                            <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($field->name); ?> :</td>
                                    <td> <?php echo e(!empty($invoice->customField)?$invoice->customField[$field->id]:'-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="2">
                                <div class="view-qrcode">
                                    <?php echo DNS2D::getBarcodeHTML(route('invoice.link.copy',\Crypt::encrypt($invoice->invoice_id)), "QRCODE",2,2); ?>

                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="invoice-body">
        <table>
            <tbody>
            <tr>
                <td>
                    <strong style="margin-bottom: 10px; display:block;"><?php echo e(__('Bill To')); ?>:</strong>
                    <p>
                        <?php echo e(!empty($customer->billing_name)?$customer->billing_name:''); ?><br>
                        <?php echo e(!empty($customer->billing_address)?$customer->billing_address:''); ?><br>
                        <?php echo e(!empty($customer->billing_city)?$customer->billing_city:'' .', '); ?><br>
                        <?php echo e(!empty($customer->billing_state)?$customer->billing_state:'',', '); ?>,
                        <?php echo e(!empty($customer->billing_zip)?$customer->billing_zip:''); ?><br>
                        <?php echo e(!empty($customer->billing_country)?$customer->billing_country:''); ?><br>
                        <?php echo e(!empty($customer->billing_phone)?$customer->billing_phone:''); ?><br>

                    </p>
                </td>
                <?php if($settings['shipping_display']=='on'): ?>
                    <td class="text-right">
                        <strong style="margin-bottom: 10px; display:block;"><?php echo e(__('Ship To')); ?>:</strong>
                        <p>
                            <?php echo e(!empty($customer->shipping_name)?$customer->shipping_name:''); ?><br>
                            <?php echo e(!empty($customer->shipping_address)?$customer->shipping_address:''); ?><br>
                            <?php echo e(!empty($customer->shipping_city)?$customer->shipping_city:'' . ', '); ?><br>
                            <?php echo e(!empty($customer->shipping_state)?$customer->shipping_state:'' .', '); ?>,
                            <?php echo e(!empty($customer->shipping_zip)?$customer->shipping_zip:''); ?><br>
                            <?php echo e(!empty($customer->shipping_country)?$customer->shipping_country:''); ?><br>
                            <?php echo e(!empty($customer->shipping_phone)?$customer->shipping_phone:''); ?><br>
                        </p>
                    </td>
                <?php endif; ?>
            </tr>
            </tbody>
        </table>
        <table class="add-border invoice-summary" style="margin-top: 30px;">
            <thead style="background: <?php echo e($color); ?>;color:<?php echo e($font_color); ?>">
            <tr>
                <th><?php echo e(__('Item')); ?></th>
                <th><?php echo e(__('Quantity')); ?></th>
                <th><?php echo e(__('Rate')); ?></th>
                <th><?php echo e(__('Discount')); ?></th>
                <th><?php echo e(__('Tax')); ?> (%)</th>
                <th><?php echo e(__('Price')); ?> <small>after tax & discount</small></th>
            </tr>
            </thead>
            <tbody>
            <?php if(isset($invoice->itemData) && count($invoice->itemData) > 0): ?>
                <?php $__currentLoopData = $invoice->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td><?php echo e(Utility::priceFormat($settings,$item->price)); ?></td>
                    <td><?php echo e(($item->discount!=0)?Utility::priceFormat($settings,$item->discount):'-'); ?></td>
                    <?php
                        $itemtax = 0;
                    ?>
                    <td>
                        <?php if(!empty($item->itemTax)): ?>

                            <?php $__currentLoopData = $item->itemTax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $itemtax += $taxes['tax_price'];
                                ?>
                                <p><?php echo e($taxes['name']); ?> (<?php echo e($taxes['rate']); ?>) <?php echo e($taxes['price']); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <span>-</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e(Utility::priceFormat($settings,$item->price * $item->quantity -  $item->discount + $itemtax)); ?></td>
                    <?php if(!empty($item->description)): ?>
                        <tr class="border-0 itm-description">
                            <td colspan="6"><?php echo e($item->description); ?></td>
                        </tr>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <?php endif; ?>

            </tbody>
            <tfoot>
            <tr>
                <td><?php echo e(__('Total')); ?></td>
                <td><?php echo e($invoice->totalQuantity); ?></td>
                <td><?php echo e(Utility::priceFormat($settings,$invoice->totalRate)); ?></td>
                <td><?php echo e(Utility::priceFormat($settings,$invoice->totalDiscount)); ?></td>
                <td><?php echo e(Utility::priceFormat($settings,$invoice->totalTaxPrice)); ?></td>
                <td><?php echo e(Utility::priceFormat($settings,$invoice->getSubTotal())); ?></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td colspan="2" class="sub-total">
                    <table class="total-table">
                        <tr>
                            <td><?php echo e(__('Subtotal')); ?>:</td>
                            <td><?php echo e(Utility::priceFormat($settings,$invoice->getSubTotal())); ?></td>
                        </tr>
                        <?php if($invoice->getTotalDiscount()): ?>
                        <tr>
                            <td><?php echo e(__('Discount')); ?>:</td>
                            <td><?php echo e(Utility::priceFormat($settings,$invoice->getTotalDiscount())); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($invoice->taxesData)): ?>
                            <?php $__currentLoopData = $invoice->taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($taxName); ?> :</td>
                                <td><?php echo e(Utility::priceFormat($settings,$taxPrice)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <tr>
                            <td><?php echo e(__('Total')); ?>:</td>
                            <td><?php echo e(Utility::priceFormat($settings,$invoice->getSubTotal()-$invoice->getTotalDiscount()+$invoice->getTotalTax())); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(__('Paid')); ?>:</td>
                            <td><?php echo e(Utility::priceFormat($settings,($invoice->getTotal()-$invoice->getDue())-($invoice->invoiceTotalCreditNote()))); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(__('Credit Note')); ?>:</td>
                            <td><?php echo e(Utility::priceFormat($settings,($invoice->invoiceTotalCreditNote()))); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(__('Due Amount')); ?>:</td>
                            <td><?php echo e(Utility::priceFormat($settings,$invoice->getDue())); ?></td>
                        </tr>

                    </table>
                </td>
            </tr>
            </tfoot>
        </table>
        <div class="invoice-footer">
            <p>
                <?php echo e($settings['footer_title']); ?> <br>
                <?php echo e($settings['footer_notes']); ?>

            </p>
        </div>
    </div>

</div>
<?php if(!isset($preview)): ?>
    <?php echo $__env->make('invoice.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php endif; ?>

</body>

</html>
<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/invoice/templates/template1.blade.php ENDPATH**/ ?>