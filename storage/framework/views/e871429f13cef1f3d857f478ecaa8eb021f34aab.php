<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Employee Report')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Employee Report')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Filter Data -->
    <div class="col-sm-12">
        <div class=" mt-2 " id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <form id="new" action="<?php echo e(route('filter.employee.attendance')); ?>" method="GET">

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 date">
                                        <div class="btn-box">
                                            <label class="form-label" for="custom_date"><?php echo e(__('Date')); ?></label>
                                            <input class="form-control month-btn" name="custom_date" type="date"
                                                   id="custom_date" />
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 date">
                                        <div class="btn-box">
                                            <label class="form-label" for="name"><?php echo e(__('Name')); ?></label>
                                            <input class="form-control month-btn" name="name" type="text"
                                                   id="name"/>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="btn btn-sm btn-primary"
                                           onclick="document.getElementById('new').submit(); return false;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- View Employee Attendance Data -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">

                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                        <tr>
                            <?php if(\Auth::user()->type != 'employee'): ?>
                                <th><?php echo e(__('Employee')); ?></th>
                            <?php endif; ?>
                            <th><?php echo e(__('Date')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Clock In')); ?></th>
                            <th><?php echo e(__('Clock Out')); ?></th>
                            <th><?php echo e(__('Total')); ?></th>
                            <th><?php echo e(__('Late')); ?></th>
                            <th><?php echo e(__('Early Leaving')); ?></th>
                            <th><?php echo e(__('Overtime')); ?></th>
                            <?php if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance')): ?>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>


                        <?php if(isset($attendanceEmployee)): ?>
                            <?php $__currentLoopData = $attendanceEmployee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(\Auth::user()->type != 'employee'): ?>
                                        <td><?php echo e(!empty($attendance->employee) ? $attendance->employee->name : ''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(\Auth::user()->dateFormat($attendance->date)); ?></td>
                                    <td><?php echo e($attendance->status); ?></td>
                                    <td><?php echo e($attendance->clock_in != '00:00:00' ? \Auth::user()->timeFormat($attendance->clock_in) : '00:00'); ?>

                                    </td>
                                    <td><?php echo e($attendance->clock_out != '00:00:00' ? \Auth::user()->timeFormat($attendance->clock_out) : '00:00'); ?>

                                    </td>
                                    <!-- Total Logged Hours-->
                                    <td>
                                        <?php echo e($attendance->clock_out != '00:00:00' ?
                                            gmdate('H:i',
                                            strtotime(Auth::user()->timeFormat($attendance->clock_out)) -
                                            strtotime(Auth::user()->timeFormat($attendance->clock_in)) )
                                            : '00:00'); ?>

                                        <?php
                                            $grand_total = gmdate('H:i',
                                                    strtotime($attendance->clock_out) - strtotime($attendance->clock_in) )
                                        ?>
                                    </td>
                                    <td><?php echo e($attendance->late); ?></td>
                                    <td><?php echo e($attendance->early_leaving); ?></td>
                                    <td><?php echo e($attendance->overtime); ?></td>
                                    <td class="Action">
                                        <?php if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance')): ?>
                                            <span>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Attendance')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                           data-size="lg"
                                                           data-url="<?php echo e(URL::to('attendanceemployee/' . $attendance->id . '/edit')); ?>"
                                                           data-ajax-popup="true" data-size="md"
                                                           data-bs-toggle="tooltip"
                                                           title="" data-title="<?php echo e(__('Edit Attendance')); ?>"
                                                           data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Attendance')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['attendanceemployee.destroy', $attendance->id], 'id' => 'delete-form-' . $attendance->id]); ?>

                                                        <a href="#"
                                                           class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                           data-bs-toggle="tooltip" title=""
                                                           data-bs-original-title="Delete"
                                                           aria-label="Delete"><i
                                                                class="ti ti-trash text-white text-white"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.custom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\q-sale xampp\htdocs\hr\resources\views/attendance/report.blade.php ENDPATH**/ ?>