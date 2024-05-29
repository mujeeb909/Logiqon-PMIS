<?php
    $logo=\App\Models\Utility::get_file('uploads/logo');
    $company_logo = \App\Models\Utility::GetLogo();
?>



<div class="card bg-none card-box">
    <div class="card-body">
        <div class="invoice-number">
            <img src="<?php echo e($logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo-dark.png')); ?>" width="120px;">
        </div>
        <div class="text-end">
            <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"><span class="ti ti-download"></span></a>
            <a title="Mail Send" href="<?php echo e(route('payslip.send',[$employee->id,$payslip->salary_month])); ?>" class="btn btn-sm btn-warning"><span class="ti ti-send"></span></a>
        </div>
        <div class="invoice" id="printableArea">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            

                        </div>
                        <hr>
                        <div class="row text-sm">
                            <div class="col-md-6">
                                <address>
                                    <strong><?php echo e(__('Name')); ?> :</strong> <?php echo e($employee->name); ?><br>
                                    <strong><?php echo e(__('Position')); ?> :</strong> <?php echo e(__('Employee')); ?><br>
                                    <strong><?php echo e(__('Salary Date')); ?> :</strong> <?php echo e(\Auth::user()->dateFormat( $payslip->created_at)); ?><br>
                                </address>
                            </div>
                            <div class="col-md-6 text-end">
                                <address>
                                    <strong><?php echo e(\Utility::getValByName('company_name')); ?> </strong><br>
                                    <?php echo e(\Utility::getValByName('company_address')); ?> , <?php echo e(\Utility::getValByName('company_city')); ?>,<br>
                                    <?php echo e(\Utility::getValByName('company_state')); ?>-<?php echo e(\Utility::getValByName('company_zipcode')); ?><br>
                                    <strong><?php echo e(__('Salary Slip')); ?> :</strong> <?php echo e($payslip->salary_month); ?><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card-body table-border-style">

                            <div class="table-responsive">
                                <table class="table table-md">
                                    <tbody>
                                    <tr class="font-weight-bold">
                                        <th><?php echo e(__('Earning')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Type')); ?></th>
                                        <th class="text-end"><?php echo e(__('Amount')); ?></th>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('Basic Salary')); ?></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class="text-end"><?php echo e(\Auth::user()->priceFormat( $payslip->basic_salary)); ?></td>
                                    </tr>
                                    <?php $__currentLoopData = $payslipDetail['earning']['allowance']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $employess = \App\Models\Employee::find($allowance->employee_id);
                                            $allowance = json_decode($allowance->allowance);
                                        ?>
                                        <?php $__currentLoopData = $allowance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(__('Allowance')); ?></td>
                                                <td><?php echo e($all->title); ?></td>
                                                <td><?php echo e(ucfirst($all->type)); ?></td>
                                                <?php if($all->type != 'percentage'): ?>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($all->amount)); ?></td>
                                                <?php else: ?>
                                                    <td class="text-end"><?php echo e($all->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat(($all->amount * $payslip->basic_salary) / 100)); ?>)
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $payslipDetail['earning']['commission']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $employess = \App\Models\Employee::find($commission->employee_id);
                                            $commissions = json_decode($commission->commission);
                                        ?>
                                        <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empcom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(__('Commission')); ?></td>
                                                <td><?php echo e($empcom->title); ?></td>
                                                <td><?php echo e(ucfirst($empcom->type)); ?></td>
                                                <?php if($empcom->type != 'percentage'): ?>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($empcom->amount)); ?></td>
                                                <?php else: ?>
                                                    <td class="text-end"><?php echo e($empcom->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat(($empcom->amount * $payslip->basic_salary) / 100)); ?>)
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $payslipDetail['earning']['otherPayment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherPayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $employess = \App\Models\Employee::find($otherPayment->employee_id);
                                            $otherpay = json_decode($otherPayment->other_payment);
                                        ?>
                                        <?php $__currentLoopData = $otherpay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $op): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(__('Other Payment')); ?></td>
                                                <td><?php echo e($op->title); ?></td>
                                                <td><?php echo e(ucfirst($op->type)); ?></td>
                                                <?php if($op->type != 'percentage'): ?>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($op->amount)); ?></td>
                                                <?php else: ?>
                                                    <td class="text-end"><?php echo e($op->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat(($op->amount * $payslip->basic_salary) / 100)); ?>)
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $payslipDetail['earning']['overTime']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overTime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $arrayJson = json_decode($overTime->overtime);
                                            foreach ($arrayJson as $key => $overtime) {
                                                foreach ($arrayJson as $key => $overtimes) {
                                                    $overtitle = $overtimes->title;
                                                    $OverTime = $overtimes->number_of_days * $overtimes->hours * $overtimes->rate;
                                                }
                                            }
                                        ?>
                                        <?php $__currentLoopData = $arrayJson; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(__('OverTime')); ?></td>
                                                <td><?php echo e($overtime->title); ?></td>
                                                <td>-</td>
                                                <td class="text-end">
                                                    <?php echo e(\Auth::user()->priceFormat($overtime->number_of_days * $overtime->hours * $overtime->rate)); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body table-border-style">

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tbody>
                                    <tr class="font-weight-bold">
                                        <th><?php echo e(__('Deduction')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('type')); ?></th>
                                        <th class="text-end"><?php echo e(__('Amount')); ?></th>
                                    </tr>



                                    <?php $__currentLoopData = $payslipDetail['deduction']['loan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $employess = \App\Models\Employee::find($loan->employee_id);
                                            $loans = json_decode($loan->loan);
                                        ?>
                                        <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emploanss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(__('Loan')); ?></td>
                                                <td><?php echo e($emploanss->title); ?></td>
                                                <td><?php echo e(ucfirst($emploanss->type)); ?></td>
                                                <?php if($emploanss->type != 'percentage'): ?>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($emploanss->amount)); ?></td>
                                                <?php else: ?>
                                                    <td class="text-end"><?php echo e($emploanss->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat(($emploanss->amount * $payslip->basic_salary) / 100)); ?>)
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $payslipDetail['deduction']['deduction']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $employess = \App\Models\Employee::find($deduction->employee_id);
                                            $deductions = json_decode($deduction->saturation_deduction);
                                        ?>
                                        <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $saturationdeduc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(__('Saturation Deduction')); ?></td>
                                                <td><?php echo e($saturationdeduc->title); ?></td>
                                                <td><?php echo e(ucfirst($saturationdeduc->type)); ?></td>
                                                <?php if($saturationdeduc->type != 'percentage'): ?>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($saturationdeduc->amount)); ?>

                                                    </td>
                                                <?php else: ?>
                                                    <td class="text-end"><?php echo e($saturationdeduc->amount); ?>%
                                                        (<?php echo e(\Auth::user()->priceFormat(($saturationdeduc->amount * $payslip->basic_salary) / 100)); ?>)
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-8">

                            </div>
                            <div class="col-lg-4 text-end text-sm">
                                <div class="invoice-detail-item pb-2">
                                    <div class="invoice-detail-name font-bold"><?php echo e(__('Total Earning')); ?></div>
                                    <div class="invoice-detail-value"><?php echo e(\Auth::user()->priceFormat($payslipDetail['totalEarning'])); ?></div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name font-bold"><?php echo e(__('Total Deduction')); ?></div>
                                    <div class="invoice-detail-value"><?php echo e(\Auth::user()->priceFormat($payslipDetail['totalDeduction'])); ?></div>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name font-bold"><?php echo e(__('Net Salary')); ?></div>
                                    <div class="invoice-detail-value invoice-detail-value-lg"><?php echo e(\Auth::user()->priceFormat($payslip->net_payble)); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-md-right pb-2 text-sm">
                <div class="float-lg-left mb-lg-0 mb-3 ">
                    <p class="mt-2"><?php echo e(__('Employee Signature')); ?></p>
                </div>
                <p class="mt-2 "> <?php echo e(__('Paid By')); ?></p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
<script>

    var filename = $('#filename').val()

    function saveAsPDF() {
        var element = document.getElementById('printableArea');
        var opt = {
            margin: 0.3,
            filename: filename,
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A2'}
        };
        html2pdf().set(opt).from(element).save();
    }
</script>
<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/payslip/pdf.blade.php ENDPATH**/ ?>