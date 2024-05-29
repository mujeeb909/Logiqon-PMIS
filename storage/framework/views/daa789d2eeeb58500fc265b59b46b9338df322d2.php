<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Ledger Summary')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Ledger Summary')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
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
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('report.ledger'),'method' => 'GET','id'=>'report_ledger'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::date('start_date',$filter['startDateRange'], array('class' => 'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::date('end_date',$filter['endDateRange'], array('class' => 'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('account', __('Account'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('account',$accounts,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select'))); ?>                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_ledger').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('report.ledger')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
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
        <div class="row mt-2">
            <div class="col">
                <input type="hidden" value="<?php echo e(__('Ledger').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h6 class="mb-0"><?php echo e(__('Report')); ?> :</h6>
                    <h7 class="text-sm mb-0"><?php echo e(__('Ledger Summary')); ?></h7>
                </div>
            </div>

            <div class="col">
                <div class="card p-4 mb-4">
                    <h6 class="mb-0"><?php echo e(__('Duration')); ?> :</h6>
                    <h7 class="text-sm mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h7>
                </div>
            </div>
        </div>
        <?php if(!empty($account)): ?>
            <div class="row mt-2">
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class="mb-0"><?php echo e(__('Account Name')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e($account->name); ?></h7>
                    </div>
                </div>

                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class="mb-0"><?php echo e(__('Account Code')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e($account->code); ?></h7>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class="mb-0"><?php echo e(__('Total Debit')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e(\Auth::user()->priceFormat($filter['debit'])); ?></h7>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class="mb-0"><?php echo e(__('Total Credit')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e(\Auth::user()->priceFormat($filter['credit'])); ?></h7>
                    </div>
                </div>

                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class="mb-0"><?php echo e(__('Balance')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e(($filter['balance']>0)?__('Cr').'. '.\Auth::user()->priceFormat(abs($filter['balance'])):__('Dr').'. '.\Auth::user()->priceFormat(abs($filter['balance']))); ?></h7>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row mb-4">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> #</th>
                                    <th> <?php echo e(__('Transaction Date')); ?></th>
                                    <th> <?php echo e(__('Create At')); ?></th>
                                    <th> <?php echo e(__('Description')); ?></th>
                                    <th> <?php echo e(__('Debit')); ?></th>
                                    <th> <?php echo e(__('Credit')); ?></th>
                                    <th> <?php echo e(__('Balance')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $balance=0;$debit=0;$credit=0; ?>
                                <?php $__currentLoopData = $journalItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="Id">
                                            <a href="<?php echo e(route('journal-entry.show',$item->journal)); ?>" class="btn btn-outline-primary"><?php echo e(AUth::user()->journalNumberFormat($item->journal_id)); ?></a>
                                        </td>

                                        <td><?php echo e(\Auth::user()->dateFormat($item->transaction_date)); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($item->created_at)); ?></td>
                                        <td><?php echo e(!empty($item->description)?$item->description:'-'); ?></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($item->debit)); ?></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($item->credit)); ?></td>
                                        <td>
                                            <?php if($item->debit>0): ?>
                                                <?php $debit+=$item->debit ?>
                                            <?php else: ?>
                                                <?php $credit+=$item->credit ?>
                                            <?php endif; ?>

                                            <?php $balance= $credit-$debit ?>
                                            <?php if($balance>0): ?>
                                                <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($balance)); ?>


                                            <?php elseif($balance<0): ?>
                                                <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($balance))); ?>

                                            <?php else: ?>
                                                <?php echo e(\Auth::user()->priceFormat(0)); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/report/ledger_summary.blade.php ENDPATH**/ ?>