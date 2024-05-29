<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Balance Sheet')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Balance Sheet')); ?></li>
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
        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()" data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row mb-5 gy-4">
                <div class="col-xl-6 col-lg-9 col-md-6">
                    <div class="welcome-card border bg-light-success p-3 border-success rounded text-dark h-100">
                        <h3 class="mb-3"><?php echo e(__('Select dates')); ?></h3>
                        <?php echo e(Form::open(array('route' => array('report.balance.sheet'),'method' => 'GET','id'=>'report_bill_summary'))); ?>

                        <div class="row gy-2 gx-2">
                            <div class="col-lg-4">
                                <div class="form-group mb-0">
                                    <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-label'])); ?>

                                    <div class="input-group date">
                                        <?php echo e(Form::date('start_date',$filter['startDateRange'], array('class' => 'month-btn form-control'))); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-0">
                                    <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

                                    <div class="input-group date">
                                        <?php echo e(Form::date('end_date',$filter['endDateRange'], array('class' => 'month-btn form-control'))); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex align-items-end">
                                <a href="#" class="btn btn-primary me-2" onclick="document.getElementById('report_bill_summary').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i data-feather="check-circle" class="me-1"></i></span>
                                </a>
                                <a href="<?php echo e(route('report.balance.sheet')); ?>" class="btn btn-danger" data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i data-feather="trash-2"></i></span>
                                </a>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6">
                    <div class="card h-100 shadow-none mb-0">
                        <div class="card-body border rounded p-3">
                            <input type="hidden" value="<?php echo e(__('Balance Sheet').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h6 class="mb-0"><?php echo e(__('Report')); ?>: <br>
                                    <small class="text-muted"><?php echo e(__('Balance Sheet')); ?></small>
                                </h6>
                                <span><i data-feather="arrow-up-right"></i></span>
                            </div>
                            <h6 class="mb-0"><?php echo e(__('Duration')); ?>:</h6>
                            <small class="text-muted"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></small>
                        </div>
                    </div>
                </div>
                <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $totalNetAmount=0; ?>
                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accountData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $accountData['account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $totalNetAmount+=$account['netAmount']; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-2 col-lg-3 col-md-6">
                        <div class="card shadow-none mb-0 h-100">
                            <div class="card-body border rounded p-3">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0"><?php echo e(__('Total'.' '.$type)); ?></h6>
                                    <span><i data-feather="arrow-up-right"></i></span>
                                </div>
                                <div class="mb-3 d-flex align-items-center justify-content-between">
                                    <span class="f-30 f-w-600"> <?php if($totalNetAmount<0): ?>
                                            <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($totalNetAmount))); ?>

                                        <?php elseif($totalNetAmount>0): ?>
                                            <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($totalNetAmount)); ?>

                                        <?php else: ?>
                                            <?php echo e(\Auth::user()->priceFormat(0)); ?>

                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="chart-wrapper">
                                    <div id="TotalProducts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>

    <div id="printableArea">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <h2><?php echo e(__('Select data sheet')); ?></h2>
            </div>
            <div class="col-lg-8 col-md-8 d-flex justify-content-end">
                <ul class="nav nav-pills cust-nav   rounded  mb-3" id="pills-tab" role="tablist">
                    <?php
                        $abc = 1;
                        $xyz = 1;
                    ?>
                    <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e($abc == 1 ? 'active' : ''); ?>" id="<?php echo e($type.'-tab'); ?>" data-bs-toggle="pill" href="<?php echo e('#'.$type); ?>" role="tab" aria-controls="asset" aria-selected="true"><?php echo e($type); ?></a>
                        </li>
                        <?php
                            $abc = 0;
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
            </div>
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane fade  <?php echo e($xyz == 1 ? 'active show' : ''); ?>" id="<?php echo e($type); ?>" role="tabpanel" aria-labelledby="<?php echo e($type.'-tab'); ?>">
                            <?php
                                $xyz = 0;
                            ?>
                            <div class="row gy-4">
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-xxl-3 col-lg-4 col-md-6">
                                        <div class="data-wrapper rounded">
                                            <h4><?php echo e($account['subType']); ?></h4>
                                            <div class="data-body bg-white list-group">
                                                <div class="list-group-item list-head d-flex justify-content-between p-b-0 ps-0 pe-0">
                                                    <span class="f-w-900 border-bottom border-dark ps-3 pe-3 pb-2"><?php echo e(__('Account')); ?> <i class="ti ti-arrows-up-down"></i></span>
                                                    <span class="text-muted  ps-3 pe-3 pb-2"><?php echo e(__('Amount')); ?></span>
                                                </div>
                                                <?php
                                                    $totalCredit=0;$totalDebit=0;
                                                ?>
                                                <?php $__currentLoopData = $account['account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $totalCredit+=$record['totalCredit'];
                                                        $totalDebit+=$record['totalDebit'];
                                                    ?>
                                                    <div class="list-group-item  d-flex justify-content-between ">
                                                        <span><?php echo e($record['account_name']); ?></span>
                                                        <span>
                                                            <?php if($record['netAmount']<0): ?>
                                                                <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($record['netAmount']))); ?>

                                                            <?php elseif($record['netAmount']>0): ?>
                                                                <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                            <?php else: ?>
                                                                <?php echo e(\Auth::user()->priceFormat(0)); ?>

                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between bg-success">
                                                <span><?php echo e(__('Total').' '.$account['subType']); ?></span>
                                                <span>
                                                    <?php $total= $totalCredit-$totalDebit; ?>
                                                    <?php if($total<0): ?>
                                                        <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($total))); ?>

                                                    <?php elseif($total>0): ?>
                                                        <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($total)); ?>

                                                    <?php else: ?>
                                                        <?php echo e(\Auth::user()->priceFormat(0)); ?>

                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/report/balance_sheet.blade.php ENDPATH**/ ?>