<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        <?php if(\Auth::user()->can('show account dashboard')): ?>
        (function () {
            var chartBarOptions = {
                series: [
                    {
                        name: "<?php echo e(__('Income')); ?>",
                        data:<?php echo json_encode($incExpLineChartData['income']); ?>

                    },
                    {
                        name: "<?php echo e(__('Expense')); ?>",
                        data: <?php echo json_encode($incExpLineChartData['expense']); ?>

                    }
                ],

                chart: {
                    height: 250,
                    type: 'area',
                    // type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories:<?php echo json_encode($incExpLineChartData['day']); ?>,
                    title: {
                        text: '<?php echo e(__("Date")); ?>'
                    }
                },
                colors: ['#6fd944', '#ff3a6e'],


                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                // markers: {
                //     size: 4,
                //     colors: ['#6fd944', '#FF3A6E'],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // },
                yaxis: {
                    title: {
                        text: '<?php echo e(__("Amount")); ?>'
                    },

                }

            };
            var arChart = new ApexCharts(document.querySelector("#cash-flow"), chartBarOptions);
            arChart.render();
        })();
        (function () {
            var options = {
                chart: {
                    height: 180,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    name: "<?php echo e(__('Income')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['income']); ?>

                }, {
                    name: "<?php echo e(__('Expense')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['expense']); ?>

                }],
                xaxis: {
                    categories: <?php echo json_encode($incExpBarChartData['month']); ?>,
                },
                colors: ['#3ec9d6', '#FF3A6E'],
                fill: {
                    type: 'solid',
                },
                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                },
                // markers: {
                //     size: 4,
                //     colors:  ['#3ec9d6', '#FF3A6E',],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // }
            };
            var chart = new ApexCharts(document.querySelector("#incExpBarChart"), options);
            chart.render();
        })();

        (function () {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: <?php echo json_encode($expenseCatAmount); ?>,
                colors: <?php echo json_encode($expenseCategoryColor); ?>,
                labels: <?php echo json_encode($expenseCategory); ?>,
                legend: {
                    show: true
                }
            };
            var chart = new ApexCharts(document.querySelector("#expenseByCategory"), options);
            chart.render();
        })();

        (function () {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: <?php echo json_encode($incomeCatAmount); ?>,
                colors: <?php echo json_encode($incomeCategoryColor); ?>,
                labels:  <?php echo json_encode($incomeCategory); ?>,
                legend: {
                    show: true
                }
            };
            var chart = new ApexCharts(document.querySelector("#incomeByCategory"), options);
            chart.render();
        })();
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Account')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xxl-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total')); ?></p>
                                            <h6 class="mb-3"><?php echo e(__('Customers')); ?></h6>
                                            <h3 class="mb-0"><?php echo e(\Auth::user()->countCustomers()); ?>


                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-info">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total')); ?></p>
                                            <h6 class="mb-3"><?php echo e(__('Vendors')); ?></h6>
                                            <h3 class="mb-0"><?php echo e(\Auth::user()->countVenders()); ?>

                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-warning">
                                                <i class="ti ti-report-money"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total')); ?></p>
                                            <h6 class="mb-3"><?php echo e(__('Invoices')); ?></h6>
                                            <h3 class="mb-0"><?php echo e(\Auth::user()->countInvoices()); ?> </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="theme-avtar bg-danger">
                                                <i class="ti ti-report-money"></i>
                                            </div>
                                            <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total')); ?></p>
                                            <h6 class="mb-3"><?php echo e(__('Bills')); ?></h6>
                                            <h3 class="mb-0"><?php echo e(\Auth::user()->countBills()); ?> </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Income & Expense')); ?>

                                        <span class="float-end text-muted"><?php echo e(__('Current Year').' - '.$currentYear); ?></span>
                                    </h5>

                                </div>
                                <div class="card-body">
                                    <div id="incExpBarChart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Account Balance')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('Bank')); ?></th>
                                                <th><?php echo e(__('Holder Name')); ?></th>
                                                <th><?php echo e(__('Balance')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $bankAccountDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bankAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr class="font-style">
                                                    <td><?php echo e($bankAccount->bank_name); ?></td>
                                                    <td><?php echo e($bankAccount->holder_name); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($bankAccount->opening_balance)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="text-center">
                                                            <h6><?php echo e(__('there is no account balance')); ?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Latest Income')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Customer')); ?></th>
                                                <th><?php echo e(__('Amount Due')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $latestIncome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(\Auth::user()->dateFormat($income->date)); ?></td>
                                                    <td><?php echo e(!empty($income->customer)?$income->customer->name:'-'); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($income->amount)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="text-center">
                                                            <h6><?php echo e(__('there is no latest income')); ?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Recent Invoices')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo e(__('Customer')); ?></th>
                                                <th><?php echo e(__('Issue Date')); ?></th>
                                                <th><?php echo e(__('Due Date')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                                <th><?php echo e(__('Status')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $recentInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(\Auth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></td>
                                                    <td><?php echo e(!empty($invoice->customer)? $invoice->customer->name:''); ?> </td>
                                                    <td><?php echo e(Auth::user()->dateFormat($invoice->issue_date)); ?></td>
                                                    <td><?php echo e(Auth::user()->dateFormat($invoice->due_date)); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoice->getTotal())); ?></td>
                                                    <td>
                                                        <?php if($invoice->status == 0): ?>
                                                            <span class="p-2 px-3 rounded badge bg-secondary"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php elseif($invoice->status == 1): ?>
                                                            <span class="p-2 px-3 rounded badge bg-warning"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php elseif($invoice->status == 2): ?>
                                                            <span class="p-2 px-3 rounded badge bg-danger"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php elseif($invoice->status == 3): ?>
                                                            <span class="p-2 px-3 rounded badge bg-info"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php elseif($invoice->status == 4): ?>
                                                            <span class="p-2 px-3 rounded badge bg-success"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center">
                                                            <h6><?php echo e(__('there is no recent invoice')); ?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Recent Bills')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo e(__('Vendor')); ?></th>
                                                <th><?php echo e(__('Bill Date')); ?></th>
                                                <th><?php echo e(__('Due Date')); ?></th>
                                                <th><?php echo e(__('Amount')); ?></th>
                                                <th><?php echo e(__('Status')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $recentBill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(\Auth::user()->billNumberFormat($bill->bill_id)); ?></td>
                                                    <td><?php echo e(!empty($bill->vender)? $bill->vender->name:''); ?> </td>
                                                    <td><?php echo e(Auth::user()->dateFormat($bill->bill_date)); ?></td>
                                                    <td><?php echo e(Auth::user()->dateFormat($bill->due_date)); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($bill->getTotal())); ?></td>
                                                    <td>
                                                        <?php if($bill->status == 0): ?>
                                                            <span class="p-2 px-3 rounded badge bg-secondary"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 1): ?>
                                                            <span class="p-2 px-3 rounded badge bg-warning"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 2): ?>
                                                            <span class="p-2 px-3 rounded badge bg-danger"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 3): ?>
                                                            <span class="p-2 px-3 rounded badge bg-info"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 4): ?>
                                                            <span class="p-2 px-3 rounded badge bg-success"><?php echo e(__(\App\Models\Bill::$statues[$bill->status])); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center">
                                                            <h6><?php echo e(__('there is no recent bill')); ?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Cashflow')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div id="cash-flow"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Income Vs Expense')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-6 my-2">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-report-money"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Income Today')); ?></p>
                                                    <h4 class="mb-0 text-success"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->todayIncome())); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 my-2">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="theme-avtar bg-info">
                                                    <i class="ti ti-file-invoice"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Expense Today')); ?></p>
                                                    <h4 class="mb-0 text-info"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->todayExpense())); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 my-2">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="theme-avtar bg-warning">
                                                    <i class="ti ti-report-money"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Income This Month')); ?></p>
                                                        <h4 class="mb-0 text-warning"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->incomeCurrentMonth())); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 my-2">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="theme-avtar bg-danger">
                                                    <i class="ti ti-file-invoice"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Expense This Month')); ?></p>
                                                    <h4 class="mb-0 text-danger"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->expenseCurrentMonth())); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Income By Category')); ?>

                                        <span class="float-end text-muted"><?php echo e(__('Year').' - '.$currentYear); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="incomeByCategory"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Expense By Category')); ?>

                                        <span class="float-end text-muted"><?php echo e(__('Year').' - '.$currentYear); ?></span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="expenseByCategory"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1 mb-0"><?php echo e(__('Latest Expense')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Customer')); ?></th>
                                                <th><?php echo e(__('Amount Due')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $latestExpense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(\Auth::user()->dateFormat($expense->date)); ?></td>
                                                    <td><?php echo e(!empty($expense->customer)?$expense->customer->name:'-'); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($expense->amount)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="text-center">
                                                            <h6><?php echo e(__('there is no latest expense')); ?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-body">

                                    <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#invoice_weekly_statistics" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Invoices Weekly Statistics')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#invoice_monthly_statistics" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Invoices Monthly Statistics')); ?></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="invoice_weekly_statistics" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0 ">
                                                    <tbody class="list">
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Invoice Generated')); ?></p>

                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyInvoice['invoiceTotal'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyInvoice['invoicePaid'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyInvoice['invoiceDue'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="invoice_monthly_statistics" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0 ">
                                                    <tbody class="list">
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Invoice Generated')); ?></p>

                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyInvoice['invoiceTotal'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyInvoice['invoicePaid'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyInvoice['invoiceDue'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-body">

                                    <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#bills_weekly_statistics" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Bills Weekly Statistics')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#bills_monthly_statistics" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Bills Monthly Statistics')); ?></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="bills_weekly_statistics" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0 ">
                                                    <tbody class="list">
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Bill Generated')); ?></p>

                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyBill['billTotal'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyBill['billPaid'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($weeklyBill['billDue'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bills_monthly_statistics" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0 ">
                                                    <tbody class="list">
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Bill Generated')); ?></p>

                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyBill['billTotal'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyBill['billPaid'])); ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                        </td>
                                                        <td>
                                                            <h4 class="text-muted"><?php echo e(\Auth::user()->priceFormat($monthlyBill['billDue'])); ?></h4>
                                                        </td>
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
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Goal')); ?></h5>
                        </div>
                        <div class="card-body">
                            <?php $__empty_1 = true; $__currentLoopData = $goals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $total= $goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['total'];
                                    $percentage=$goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'];
                                    $per=number_format($goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'], Utility::getValByName('decimal_number'), '.', '');
                                ?>
                                <div class="card border-success border-2 border-bottom-0 border-start-0 border-end-0">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <label class="form-check-label d-block" for="customCheckdef1">
                                                <span>
                                                    <span class="row align-items-center">
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Name')); ?></span>
                                                            <h6 class="text-nowrap mb-3 mb-sm-0"><?php echo e($goal->name); ?></h6>
                                                        </span>
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Type')); ?></span>
                                                            <h6 class="mb-3 mb-sm-0"><?php echo e(__(\App\Models\Goal::$goalType[$goal->type])); ?></h6>
                                                        </span>
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Duration')); ?></span>
                                                            <h6 class="mb-3 mb-sm-0"><?php echo e($goal->from .' To '.$goal->to); ?></h6>
                                                        </span>
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Target')); ?></span>
                                                            <h6 class="mb-3 mb-sm-0"><?php echo e(\Auth::user()->priceFormat($total).' of '. \Auth::user()->priceFormat($goal->amount)); ?></h6>
                                                        </span>
                                                        <span class="col">
                                                            <span class="text-muted text-sm"><?php echo e(__('Progress')); ?></span>
                                                            <h6 class="mb-2 d-block"><?php echo e(number_format($goal->target($goal->type,$goal->from,$goal->to,$goal->amount)['percentage'], Utility::getValByName('decimal_number'), '.', '')); ?>%</h6>
                                                            <div class="progress mb-0">
                                                                <?php if($per<=33): ?>
                                                                    <div class="progress-bar bg-danger" style="width: <?php echo e($per); ?>%"></div>
                                                                <?php elseif($per>=33 && $per<=66): ?>
                                                                    <div class="progress-bar bg-warning" style="width: <?php echo e($per); ?>%"></div>
                                                                <?php else: ?>
                                                                    <div class="progress-bar bg-primary" style="width: <?php echo e($per); ?>%"></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card pb-0">
                                    <div class="card-body text-center">
                                        <h6><?php echo e(__('There is no goal.')); ?></h6>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/dashboard/account-dashboard.blade.php ENDPATH**/ ?>