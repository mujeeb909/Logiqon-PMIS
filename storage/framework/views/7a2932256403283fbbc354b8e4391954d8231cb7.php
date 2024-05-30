<?php
    $password = base64_decode($project->password);
?>
<div class="card-body">
    <div class="table-responsive">
        <?php echo e(Form::open(['route' => ['projects.copy.link', $projectID], 'method' => 'POST'])); ?>

        <table class="table mb-0">
            <thead class="thead-light">
                <tr>
                    <th> <?php echo e(__('Module')); ?></th>
                    <th class="text-right"> <?php echo e(__('On/Off')); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo e(__('Basic details')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="basic_details" class="form-check-input"
                                <?php if(isset($result->basic_details) && $result->basic_details == 'on'): ?> checked="checked" <?php endif; ?> id="copy_link_1"
                                value="on">
                            <label class="custom-control-label" for="copy_link_1"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e(__('Member')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="member" class="form-check-input"
                                <?php if(isset($result->member) && $result->member == 'on'): ?> checked="checked" <?php endif; ?> id="copy_link_2"
                                value="on">
                            <label class="custom-control-label" for="copy_link_2"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e(__('Task')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="task" class="form-check-input" id="copy_link_6"
                                   <?php if(isset($result->task) && $result->task == 'on'): ?> checked="checked" <?php endif; ?> value="on">
                            <label class="custom-control-label" for="copy_link_6"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e(__('Milestone')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="milestone" class="form-check-input"
                                <?php if(isset($result->milestone) && $result->milestone == 'on'): ?> checked="checked" <?php endif; ?> id="copy_link_3"
                                value="on">
                            <label class="custom-control-label" for="copy_link_3"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e(__('Attachment')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="attachment" class="form-check-input"
                                <?php if(isset($result->attachment) && $result->attachment == 'on'): ?> checked="checked" <?php endif; ?> id="copy_link_5"
                                value="on">
                            <label class="custom-control-label" for="copy_link_5"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e(__('Bug Report')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="bug_report" class="form-check-input"
                                <?php if(isset($result->bug_report) && $result->bug_report == 'on'): ?> checked="checked" <?php endif; ?> id="copy_link_7"
                                value="on">
                            <label class="custom-control-label" for="copy_link_7"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e(__('Timesheet')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="timesheet" class="form-check-input"
                                   <?php if(isset($result->timesheet) && $result->timesheet == 'on'): ?> checked="checked" <?php endif; ?> id="copy_link_10"
                                   value="on">
                            <label class="custom-control-label" for="copy_link_10"></label>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td><?php echo e(__('Tracker details')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="tracker_details" class="form-check-input"
                                <?php if(isset($result->tracker_details) && $result->tracker_details == 'on'): ?> checked="checked" <?php endif; ?> id="copy_link_9"
                                value="on">
                            <label class="custom-control-label" for="copy_link_9"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e(__('Expense')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="expense" class="form-check-input"
                                   <?php if(isset($result->expense) && $result->expense == 'on'): ?> checked="checked" <?php endif; ?> id="copy_link_8"
                                   value="on">
                            <label class="custom-control-label" for="copy_link_8"></label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><?php echo e(__('Activity')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="activity" class="form-check-input"
                                   <?php if(isset($result->activity) && $result->activity == 'on'): ?> checked="checked" <?php endif; ?> id="copy_link_4"
                                   value="on">
                            <label class="custom-control-label" for="copy_link_4"></label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><?php echo e(__('Password Protected')); ?></td>
                    <td class="action text-right">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="password_protected" class="form-check-input password_protect"
                                id="password_protected" <?php if(isset($result->password_protected) && $result->password_protected == 'on'): ?> checked="checked" <?php endif; ?>
                                value="on">
                            <label class="custom-control-label" for="password_protected"></label>
                        </div>
                    </td>
                    <tr class="passwords">
                        <td>
                            <div class="action input-group input-group-merge  text-left ">
                                <input type="password" value="<?php echo e($password); ?>" class=" form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="password"  autocomplete="new-password" id="password"
                                    placeholder="<?php echo e(__('Enter Your Password')); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text py-3">
                                        <a href="#" data-toggle="password-text" data-target="#password">
                                            <i class="fas fa-eye-slash" id="togglePassword"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tr>
            </tbody>
        </table>
        <div class="text-right pt-3">
            <div class="float-end px-3">
                <?php echo e(Form::button(__('Save'), ['type' => 'submit', 'class' => 'btn btn-primary'])); ?>

            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</div>

<script>
    $(document).ready(function() {
        if ($('.password_protect').is(':checked')) {
            $('.passwords').show();
        } else {
            $('.passwords').hide();
        }
        $('#password_protected').on('change', function() {
            if ($('.password_protect').is(':checked')) {
                $('.passwords').show();
            } else {
                $('.passwords').hide();
            }
        });
    });
    $(document).on('change', '#password_protected', function() {
        if ($(this).is(':checked')) {
            $('.passwords').removeClass('password_protect');
            $('.passwords').attr("required", true);
        } else {
            $('.passwords').addClass('password_protect');
            $('.passwords').val(null);
            $('.passwords').removeAttr("required");
        }
    });
</script>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
    });

    // prevent form submit
    // const form = document.querySelector("form");
    // form.addEventListener('submit', function (e) {
    //     e.preventDefault();
    // });
</script>
<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/copylink_setting.blade.php ENDPATH**/ ?>