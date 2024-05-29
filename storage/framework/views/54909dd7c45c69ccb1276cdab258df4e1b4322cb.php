<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Profit & Loss Summary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Profit & Loss Summary')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var year = '<?php echo e($currentYear); ?>';
        var filename = $('#filename').val();

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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">




        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                    <?php echo e(Form::open(array('route' => array('report.profit.loss.summary'),'method' => 'GET','id'=>'report_profit_loss_summary'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('year', __('Year'),['class'=>'form-label'])); ?>


                                            <?php echo e(Form::select('year',$yearList,isset($_GET['year'])?$_GET['year']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_profit_loss_summary').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('report.profit.loss.summary')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div id="printableArea">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="<?php echo e(__('Profit & Loss Summary').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Report')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e(__('Profit & Loss Summary')); ?></h6>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="pb-3"><?php echo e(__('Income')); ?></h5>
                                <div class="table-responsive mt-3 mb-3">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="25%"><?php echo e(__('Category')); ?></th>
                                            <?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th width="15%"><?php echo e($m); ?></th>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="13" class="text-dark"><span><?php echo e(__('Revenue : ')); ?></span></td>
                                            </tr>
                                            <?php if(!empty($revenueIncomeArray)): ?>
                                                <?php $__currentLoopData = $revenueIncomeArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$revenue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($revenue['category']); ?></td>
                                                        <?php $__currentLoopData = $revenue['amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <td width="15%"><?php echo e(\Auth::user()->priceFormat($amount)); ?></td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                            <tr>
                                                <td colspan="13" class="text-dark"><span><?php echo e(__('Invoice : ')); ?></span></td>
                                            </tr>

                                            <?php if(!empty($invoiceIncomeArray)): ?>
                                                <?php $__currentLoopData = $invoiceIncomeArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($invoice['category']); ?></td>
                                                        <?php $__currentLoopData = $invoice['amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <td width="15%"><?php echo e(\Auth::user()->priceFormat($amount)); ?></td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table table-flush border">
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="13" class="text-dark"><span><?php echo e(__('Total Income =  Revenue + Invoice ')); ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%" class="text-dark"><?php echo e(__('Total Income')); ?></td>
                                                            <?php $__currentLoopData = $totalIncome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <td width="15%"><?php echo e(\Auth::user()->priceFormat($income)); ?></td>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </tbody>
                                    </table>
                                </div>


                            <div class="col-sm-12">
                                <h5><?php echo e(__('Expense')); ?></h5>
                                <div class="table-responsive mt-4">
                                    <table class="table mb-0" id="dataTable-manual">
                                        <thead>
                                        <tr>
                                            <th width="25%"><?php echo e(__('Category')); ?></th>
                                            <?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th width="15%"><?php echo e($m); ?></th>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="13" class="text-dark"><span><?php echo e(__('Payment : ')); ?></span></td>
                                        </tr>
                                        <?php if(!empty($expenseArray)): ?>
                                            <?php $__currentLoopData = $expenseArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($expense['category']); ?></td>
                                                    <?php $__currentLoopData = $expense['amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td width="15%"><?php echo e(\Auth::user()->priceFormat($amount)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="13" class="text-dark"><span><?php echo e(__('Bill : ')); ?></span></td>
                                        </tr>
                                        <?php if(!empty($billExpenseArray)): ?>
                                            <?php $__currentLoopData = $billExpenseArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($bill['category']); ?></td>
                                                    <?php $__currentLoopData = $bill['amount']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td width="15%"><?php echo e(\Auth::user()->priceFormat($amount)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-flush border" id="dataTable-manual">
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="13" class="text-dark"><span><?php echo e(__('Total Expense =  Payment + Bill ')); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-dark"><?php echo e(__('Total Expenses')); ?></td>
                                                        <?php $__currentLoopData = $totalExpense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <td width="15%"><?php echo e(\Auth::user()->priceFormat($expense)); ?></td>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-flush border" id="dataTable-manual">
                                            <tbody>
                                            <tr>
                                                <td colspan="13" class="text-dark"><span><?php echo e(__('Net Profit = Total Income - Total Expense ')); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-dark"><?php echo e(__('Net Profit')); ?></td>
                                                <?php $__currentLoopData = $netProfitArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$profit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td width="15%"> <?php echo e(\Auth::user()->priceFormat($profit)); ?></td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/report/profit_loss_summary.blade.php ENDPATH**/ ?>