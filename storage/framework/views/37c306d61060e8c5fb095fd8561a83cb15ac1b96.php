
<table class="table mb-0">
    <thead>
        <tr>
            <th class="text-muted"><?php echo e(__('Title')); ?></th>
            <?php $__currentLoopData = $days['datePeriod']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $perioddate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th scope="col" class="heading"><span><?php echo e($perioddate->format('D')); ?></span><span><?php echo e($perioddate->format('d M')); ?></span></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th class="text-center"><?php echo e(__('Total')); ?></th>
        </tr>
    </thead>
    <tbody class="tbody">
        <?php if(isset($allProjects) && $allProjects == true): ?>
            <?php $__currentLoopData = $timesheetArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="project-name" data-bs-toggle="tooltip" title="<?php echo e(__('Project')); ?>"><?php echo e($timesheet['project_name']); ?></td>
                </tr>
                <?php $__currentLoopData = $timesheet['taskArray']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $taskTimesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $taskTimesheet['dateArray']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateTimeArray): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="timesheet-user">
                            <td class="task-name" data-bs-toggle="tooltip" title="<?php echo e(__('Task')); ?>"><?php echo e($taskTimesheet['task_name']); ?></td>
                            <?php $__currentLoopData = $dateTimeArray['week']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateSubArray): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <input class="form-control <?php echo e($dateSubArray['time'] != '00:00' ? 'border-dark' : '-'); ?> wid-120 task-time day-time"
                                           data-type="<?php echo e($dateSubArray['type']); ?>" data-user-id="<?php echo e($dateTimeArray['user_id']); ?>"
                                           data-project-id="<?php echo e($timesheet['project_id']); ?>" data-task-id="<?php echo e($taskTimesheet['task_id']); ?>"
                                           data-date="<?php echo e($dateSubArray['date']); ?>" data-ajax-timesheet-popup="true"
                                           data-url="<?php echo e($dateSubArray['url']); ?>"
                                           type="text" value="<?php echo e($dateSubArray['time'] != '00:00' ? $dateSubArray['time'] : '00:00'); ?>">
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td class="text-center total-task-time day-time">
                                <input class="form-control border-dark wid-120 total-task-time day-time"
                                       type="text" value="<?php echo e($dateTimeArray['totaltime'] != '00:00' ? $dateTimeArray['totaltime'] : '00:00'); ?>">
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php $__currentLoopData = $timesheetArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $timesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="task-name"><?php echo e($timesheet['task_name']); ?></td>
                    <?php $__currentLoopData = $timesheet['dateArray']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $datetime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td>
                            <input class="form-control <?php echo e($datetime['time'] != '00:00' ? 'border-dark' : '00:00'); ?> wid-120 task-time day-time1"
                                   data-type="<?php echo e($datetime['type']); ?>" data-task-id="<?php echo e($timesheet['task_id']); ?>"
                                   data-date="<?php echo e($datetime['date']); ?>" data-ajax-timesheet-popup="true"
                                   data-url="<?php echo e($datetime['url']); ?>" type="text"
                                   value="<?php echo e($datetime['time'] != '00:00' ? $datetime['time'] : '00:00'); ?>">
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td class="text-center total-task-time day-time1"> <input class="form-control border-dark wid-120 task-time day-time1"  type="text" value="<?php echo e($timesheet['totaltime'] != '00:00' ? $timesheet['totaltime'] : '00:00'); ?>" >
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>
    <tfooter>
        <tr class="bg-primary">
            <td><?php echo e(__('Total')); ?></td>
            <?php $__currentLoopData = $totalDateTimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $totaldatetime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td class="total-date-time" > <input class="form-control bg-transparent <?php echo e($totaldatetime != '00:00' ? 'border-dark' : 'border-white'); ?>  wid-120" type="text" value="<?php echo e($totaldatetime != '00:00' ? $totaldatetime : '00:00'); ?>"> </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <td class="text-center total-value1">
                <input class="form-control bg-transparent <?php echo e($calculatedtotaltaskdatetime != '00:00' ? 'border-dark' : 'border-white'); ?> wid-120" type="text" value="<?php echo e($calculatedtotaltaskdatetime != '00:00' ? $calculatedtotaltaskdatetime : '00:00'); ?>">
            </td>
        </tr>
    </tfooter>
</table>

<div class="text-center d-flex align-items-center justify-content-center mt-4 mb-5 timelogged">
    <h5 class="f-w-900 me-2 mb-0"><?php echo e(__('Time Logged')); ?> :</h5>
    <span class="p-2  f-w-900 rounded  bg-primary d-inline-block border border-dark"><?php echo e($calculatedtotaltaskdatetime . __(' Hours')); ?></span>
</div>

<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/timesheets/week.blade.php ENDPATH**/ ?>