<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $company_small_logo=Utility::getValByName('company_small_logo');
    $company_favicon=Utility::getValByName('company_favicon');
$lang=\App\Models\Utility::getValByName('default_language');
?>

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', '.email-template-checkbox', function () {
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {

                },
            });
        });
    </script>

<script>
    $(document).ready(function () {
            if ($('.gdpr_fulltime').is(':checked') ) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

        $('#gdpr_cookie').on('change', function() {
            if ($('.gdpr_fulltime').is(':checked') ) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }
        });
    });

</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#site-setting" class="active"><?php echo e(__('Site Setting')); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#company-setting"><?php echo e(__('Company Setting')); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#system-setting"><?php echo e(__('System Setting')); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#email-settings" class=""><?php echo e(__('Email Setting')); ?> </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#pusher-settings" class=""><?php echo e(__('Pusher Setting')); ?> </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#email-noti-setting"><?php echo e(__('Email Notification Setting')); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" id="profile-tab2" href="#ip-restrict-setting"><?php echo e(__('Ip Restrict Setting')); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" id="profile-tab2" href="#zoom-setting"><?php echo e(__('Zoom Setting')); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" id="profile-tab2" href="#slack-setting"><?php echo e(__('Slack Setting')); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" id="profile-tab2" href="#telegram-setting"><?php echo e(__('Telegram Setting')); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" id="profile-tab2" href="#twilio-setting"><?php echo e(__('Twilio Setting')); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="site-setting" class="tab-pane in active">
                        <?php echo e(Form::model($settings,array('url'=>'settings','method'=>'POST','enctype' => "multipart/form-data"))); ?>

                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Site settings')); ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title"><?php echo e(__('Logo')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="<?php echo e($logo.'/logo.png'); ?>" class="big-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="logo">
                                            <div><?php echo e(__('Choose file here')); ?></div>
                                            <input type="file" class="form-control" name="logo" id="logo" data-filename="edit-logo">
                                        </label>
                                        <p class="edit-logo"></p>
                                    </div>
                                    <p class="lh-160 mb-0 pt-2"><?php echo e(__('These Logo will appear on Payslip.')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title"><?php echo e(__('Landing Page Logo')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="col-12">
                                        <div class="logo-content">
                                            <img src="<?php echo e($logo.'/landing_logo.png'); ?>" class="landing-logo" alt=""/>
                                        </div>
                                        <div class="choose-file mt-4">
                                            <label for="landing-logo">
                                                <div><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control" name="landing_logo" id="landing-logo" data-filename="edit-landing-logo">
                                            </label>
                                            <p class="edit-landing-logo"></p>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2">
                                        <?php echo e(Form::label('display_landing_page',__('Landing Page Display'),array('class'=>'form-control-label'))); ?>

                                        <div class="">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="display_landing_page" id="display_landing_page" <?php echo e($settings['display_landing_page'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                <label class="custom-control-label form-control-label" for="display_landing_page"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title"><?php echo e(__('Favicon')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="<?php echo e($logo.'/favicon.png'); ?>" class="small-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="small-favicon">
                                            <div><?php echo e(__('Choose file here')); ?></div>
                                            <input type="file" class="form-control" name="favicon" id="small-favicon" data-filename="edit-favicon">
                                        </label>
                                        <p class="edit-favicon"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4 class="small-title"><?php echo e(__('Settings')); ?></h4>
                                <div class="card setting-card">
                                    <div class="form-group">
                                        <?php echo e(Form::label('title_text',__('Title Text'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))); ?>

                                        <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-title_text" role="alert">
                                         <strong class="text-danger"><?php echo e($message); ?></strong>
                                         </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('footer_text',__('Footer Text'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('footer_text',null,array('class'=>'form-control','placeholder'=>__('Footer Text')))); ?>

                                        <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-footer_text" role="alert">
                                                                     <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                   <div class="form-group">
                                        <?php echo e(Form::label('default_language',__('Default Language'),array('class'=>'form-control-label'))); ?>

                                        <div class="changeLanguage">
                                            <select name="default_language" id="default_language" class="form-control select2">
                                                <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e($language); ?>"><?php echo e(Str::upper($language)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('SITE_RTL',__('RTL'),array('class'=>'form-control-label'))); ?>

                                        <div class="">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="SITE_RTL" id="SITE_RTL" <?php echo e(env('SITE_RTL') == 'on' ? 'checked="checked"' : ''); ?>>
                                                <label class="custom-control-label form-control-label" for="SITE_RTL"></label>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="form-group">
                                            <?php echo e(Form::label('gdpr_cookie',__('GDPR Cookie'))); ?>


                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input gdpr_fulltime gdpr_type" name="gdpr_cookie" id="gdpr_cookie" <?php echo e(isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                <label class="custom-control-label form-control-label" for="gdpr_cookie"></label>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                           
                                            <textarea id="btn" type="text" name="cookie_text" class="form-control fulltime"
                                            rows="4" style="height: auto"
                                            value="<?php echo e(isset($settings['cookie_text']) && $settings['cookie_text'] ? $settings['cookie_text'] : ''); ?>"
                                            placeholder="<?php echo e(isset($settings['cookie_text']) && $settings['cookie_text'] ? $settings['cookie_text'] : ''); ?>"><?php echo e(isset($settings['cookie_text']) && $settings['cookie_text'] ? $settings['cookie_text'] : ''); ?></textarea>
                                        </div>
                                         
                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                            <label for="metakeyword" class="form-control-label text-dark">Meta Keywords</label>
                                            <textarea class="form-control" rows="4" cols="8" value="<?php echo e(isset($settings['metakeyword'])  ? $settings['metakeyword'] : ''); ?>" name="metakeyword"  id="metakeyword" style="resize: vertical; height: 70px;"><?php echo e(isset($settings['metakeyword'])? $settings['metakeyword'] : ''); ?></textarea>
                                       </div>
                                       
                                       <div class="col-lg-12 col-sm-12 col-md-12">
                                        <label for="metadesc" class="form-control-label text-dark">Meta Description</label>
                                        <textarea class="form-control" rows="4" cols="8" value="<?php echo e(isset($settings['metadesc'])  ? $settings['metadesc'] : ''); ?>" name="metadesc"  id="metadesc" style="resize: vertical; height: 100px;"><?php echo e(isset($settings['metadesc'])  ? $settings['metadesc'] : ''); ?></textarea>
        
                                        </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12 text-right">
                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <div id="company-setting" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Company Setting')); ?></h4>
                                </div>
                            </div>
                            <div class="card bg-none p-4">
                                <?php echo e(Form::model($settings,array('route'=>'company.settings','method'=>'post'))); ?>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('company_name *',__('Company Name *'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('company_name',null,array('class'=>'form-control font-style'))); ?>

                                        <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_name" role="alert">
                                                            <small class="text-danger"><?php echo e($message); ?></small>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('company_address',__('Address'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('company_address',null,array('class'=>'form-control font-style'))); ?>

                                        <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_address" role="alert">
                                                            <small class="text-danger"><?php echo e($message); ?></small>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('company_city',__('City'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('company_city',null,array('class'=>'form-control font-style'))); ?>

                                        <?php $__errorArgs = ['company_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_city" role="alert">
                                                                    <small class="text-danger"><?php echo e($message); ?></small>
                                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('company_state',__('State'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('company_state',null,array('class'=>'form-control font-style'))); ?>

                                        <?php $__errorArgs = ['company_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_state" role="alert">
                                                            <small class="text-danger"><?php echo e($message); ?></small>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('company_zipcode',__('Zip/Post Code'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('company_zipcode',null,array('class'=>'form-control'))); ?>

                                        <?php $__errorArgs = ['company_zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_zipcode" role="alert">
                                                            <small class="text-danger"><?php echo e($message); ?></small>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <?php echo e(Form::label('company_country',__('Country'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('company_country',null,array('class'=>'form-control font-style'))); ?>

                                        <?php $__errorArgs = ['company_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_country" role="alert">
                                                            <small class="text-danger"><?php echo e($message); ?></small>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('company_telephone',__('Telephone'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('company_telephone',null,array('class'=>'form-control'))); ?>

                                        <?php $__errorArgs = ['company_telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_telephone" role="alert">
                                                            <small class="text-danger"><?php echo e($message); ?></small>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('company_email',__('System Email *'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('company_email',null,array('class'=>'form-control'))); ?>

                                        <?php $__errorArgs = ['company_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_email" role="alert">
                                                            <small class="text-danger"><?php echo e($message); ?></small>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('company_email_from_name',__('Email (From Name) *'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('company_email_from_name',null,array('class'=>'form-control font-style'))); ?>

                                        <?php $__errorArgs = ['company_email_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_email_from_name" role="alert">
                                                                <small class="text-danger"><?php echo e($message); ?></small>
                                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('company_start_time',__('Company Start Time *'),['class'=>'form-control-label text-dark'])); ?>


                                                <?php echo e(Form::text('company_start_time',null,array('class'=>'form-control timepicker_format'))); ?>

                                                <?php $__errorArgs = ['company_start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-company_start_time" role="alert">
                                                                    <small class="text-danger"><?php echo e($message); ?></small>
                                                                </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('company_end_time',__('Company End Time *'),['class'=>'form-control-label text-dark'])); ?>

                                                <?php echo e(Form::text('company_end_time',null,array('class'=>'form-control timepicker_format'))); ?>

                                                <?php $__errorArgs = ['company_end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-company_end_time" role="alert">
                                                                    <small class="text-danger"><?php echo e($message); ?></small>
                                                                </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo e(Form::label('timezone',__('Timezone'),['class'=>'form-control-label text-dark'])); ?>

                                        <select type="text" name="timezone" class="form-control select2" id="timezone">
                                            <option value=""><?php echo e(__('Select Timezone')); ?></option>
                                            <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php echo e((env('TIMEZONE')==$k)?'selected':''); ?>><?php echo e($timezone); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                    <div class="col-md-6 py-5">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="ip_restrict" id="ip_restrict" <?php echo e($settings['ip_restrict'] == 'on' ? 'checked="checked"' : ''); ?> >
                                            <label class="custom-control-label form-control-label" for="ip_restrict"><?php echo e(__('Ip Restrict')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-right">
                                        <input type="submit" value="<?php echo e(__('Save Change')); ?>" class="btn-create badge-blue">
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div id="system-setting" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('System Settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card bg-none p-4">
                                <?php echo e(Form::model($settings,array('route'=>'system.settings','method'=>'post'))); ?>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('site_currency',__('Currency *'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('site_currency',null,array('class'=>'form-control font-style'))); ?>

                                        <?php $__errorArgs = ['site_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-site_currency" role="alert">
                                                            <small class="text-danger"><?php echo e($message); ?></small>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('site_currency_symbol',__('Currency Symbol *'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('site_currency_symbol',null,array('class'=>'form-control'))); ?>

                                        <?php $__errorArgs = ['site_currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-site_currency_symbol" role="alert">
                                            <small class="text-danger"><?php echo e($message); ?></small>
                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label text-dark" for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-12">
                                                    <div class="d-flex radio-check">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="pre_symbol" name="site_currency_symbol_position" value="pre" class="custom-control-input" <?php if($settings['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?>>
                                                            <label class="custom-control-label" for="pre_symbol"><?php echo e(__('Pre')); ?></label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="post_symbol" name="site_currency_symbol_position" value="post" class="custom-control-input" <?php if($settings['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>>
                                                            <label class="custom-control-label" for="post_symbol"><?php echo e(__('Post')); ?></label>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="site_date_format" class="form-control-label text-dark"><?php echo e(__('Date Format')); ?></label>
                                        <select type="text" name="site_date_format" class="form-control select2" id="site_date_format">
                                            <option value="M j, Y" <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>Jan 1,2015</option>
                                            <option value="d-m-Y" <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>d-m-y</option>
                                            <option value="m-d-Y" <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>m-d-y</option>
                                            <option value="Y-m-d" <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>y-m-d</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="site_time_format" class="form-control-label text-dark"><?php echo e(__('Time Format')); ?></label>
                                        <select type="text" name="site_time_format" class="form-control select2" id="site_time_format">
                                            <option value="g:i A" <?php if(@$settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>>10:30 PM</option>
                                            <option value="g:i a" <?php if(@$settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>>10:30 pm</option>
                                            <option value="H:i" <?php if(@$settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>>22:30</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('employee_prefix',__('Employee Prefix'),['class'=>'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('employee_prefix',null,array('class'=>'form-control'))); ?>

                                        <?php $__errorArgs = ['employee_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-employee_prefix" role="alert">
                                                            <small class="text-danger"><?php echo e($message); ?></small>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-12 text-right">
                                        <input type="submit" value="<?php echo e(__('Save Change')); ?>" class="btn-create badge-blue">
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    
                    <div id="email-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Email settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card bg-none company-setting">
                                <?php echo e(Form::open(array('route'=>'email.settings','method'=>'post'))); ?>

                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_driver',__('Mail Driver'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control','placeholder'=>__('Enter Mail Driver')))); ?>

                                        <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_host',__('Mail Host'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control ','placeholder'=>__('Enter Mail Host')))); ?>

                                        <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_port',__('Mail Port'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control','placeholder'=>__('Enter Mail Port')))); ?>

                                        <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_port" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_username',__('Mail Username'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Username')))); ?>

                                        <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_username" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_password',__('Mail Password'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control','placeholder'=>__('Enter Mail Password')))); ?>

                                        <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_password" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_encryption',__('Mail Encryption'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))); ?>

                                        <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_encryption" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_from_address',__('Mail From Address'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Address')))); ?>

                                        <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_from_address" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('mail_from_name',__('Mail From Name'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Name')))); ?>

                                        <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-mail_from_name" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                </div>
                                <div class="col-lg-12 ">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <a href="#" data-url="<?php echo e(route('test.mail' )); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Send Test Mail')); ?>" class="text-white btn-custom">
                                                <?php echo e(__('Send Test Mail')); ?>

                                            </a>
                                        </div>
                                        <div class="form-group col-md-6 text-right">
                                            <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                                        </div>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    
                    <div id="pusher-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Pusher settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card bg-none company-setting">
                                <?php echo e(Form::open(array('route'=>'pusher.settings','method'=>'post'))); ?>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('pusher_app_id',__('Pusher App Id'),['class'=>'form-control-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_id',env('PUSHER_APP_ID'),array('class'=>'form-control','placeholder'=>__('Enter Pusher App Id')))); ?>

                                        <?php $__errorArgs = ['pusher_app_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-pusher_app_id" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('pusher_app_key',__('Pusher App Key'),['class'=>'form-control-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_key',env('PUSHER_APP_KEY'),array('class'=>'form-control ','placeholder'=>__('Enter Pusher App Key')))); ?>

                                        <?php $__errorArgs = ['pusher_app_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-pusher_app_key" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('pusher_app_secret',__('Pusher App Secret'),['class'=>'form-control-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_secret',env('PUSHER_APP_SECRET'),array('class'=>'form-control ','placeholder'=>__('Enter Pusher App Secret')))); ?>

                                        <?php $__errorArgs = ['pusher_app_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-pusher_app_secret" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('pusher_app_cluster',__('Pusher App Cluster'),['class'=>'form-control-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_cluster',env('PUSHER_APP_CLUSTER'),array('class'=>'form-control ','placeholder'=>__('Enter Pusher App Cluster')))); ?>

                                        <?php $__errorArgs = ['pusher_app_cluster'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-pusher_app_cluster" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>


                                </div>
                                <div class="col-lg-12  text-right">
                                    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div id="email-noti-setting" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Email Notification Setting')); ?></h4>
                                </div>
                            </div>
                            <div class="card bg-none ">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0 dataTable">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('Module')); ?></th>
                                                <th class="text-right"><?php echo e(__('On/Off')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = \App\Models\Utility::$emailStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="font-style odd" role="row">
                                                    <td class="sorting_1"><?php echo e($email); ?></td>
                                                    <td class="action text-right">
                                                        <label class="switch">
                                                            <input type="checkbox" class="email-template-checkbox" name="<?php echo e($key); ?>" <?php echo e(\App\Models\Utility::getValByName("$key") ==1 ?'checked':''); ?> value="<?php echo e(\App\Models\Utility::getValByName("$key") ==1 ?'1':'0'); ?>" data-url="<?php echo e(route('company.email.setting',$key)); ?>">
                                                            <span class="slider1 round"></span>
                                                        </label>
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

                       
                    <div class="tab-pane" id="ip-restrict-setting">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Ip Restrict Setting')); ?></h4>
                                </div>
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0 text-right">
                                    <a href="#" data-url="<?php echo e(route('create.ip')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="<?php echo e(__('Create New IP')); ?>">
                                        <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                                    </a>
                                </div>
                            </div>
                            <div class="card bg-none ">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0 dataTable">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('IP')); ?></th>
                                                <th class=""><?php echo e(__('Action')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="font-style odd" role="row">
                                                    <td class="sorting_1"><?php echo e($ip->ip); ?></td>
                                                    <td class="">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Company Settings')): ?>
                                                            <a href="#" data-url="<?php echo e(route('edit.ip',$ip->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit IP')); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Company Settings')): ?>
                                                            <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($ip->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['destroy.ip', $ip->id],'id'=>'delete-form-'.$ip->id]); ?>

                                                            <?php echo Form::close(); ?>

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
                       

                    
                    <div id="zoom-setting" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Zoom settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card bg-none company-setting">
                                <?php echo e(Form::open(array('route'=>'zoom.settings','method'=>'post'))); ?>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                      
                                        <?php echo e(Form::label('zoom_apikey',__('Zoom API Key'),['class'=>'form-control-label'])); ?>


                                        <?php echo e(Form::text('zoom_apikey',isset($settings['zoom_apikey'])?$settings['zoom_apikey']:'', ['class' => 'form-control', 'placeholder' => __('Enter Zoom API Key')])); ?>

                                        <?php $__errorArgs = ['zoom_api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-zoom_api_key" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        
                                        <?php echo e(Form::label('zoom_secret_key',__('Zoom Secret Key'),['class'=>'form-control-label'])); ?>


                                        <?php echo e(Form::text('zoom_secret_key',isset($settings['zoom_secret_key'])?$settings['zoom_secret_key']:'', ['class' => 'form-control', 'placeholder' => __('Enter Zoom Secret Key')])); ?>

                                        <?php $__errorArgs = ['zoom_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-zoom_secret_key" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                   


                                </div>
                                <div class="col-lg-12  text-right">
                                    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="tab-pane fade" id="slack-setting" role="tabpanel">
                        <div class="card-header bg-transparent p-0 pb-1">
                            <div class="row mb-2">
                                <div class="col my-auto">
                                    <h5><?php echo e(__('Slack')); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <?php echo e(Form::open(['route' => 'slack.setting','id'=>'slack-setting','method'=>'post' ,'class'=>'d-contents'])); ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="small-title"><?php echo e(__('Slack Webhook URL')); ?></h4>
                                    <div class="col-md-8">
                                        <?php echo e(Form::text('slack_webhook', isset($settings['slack_webhook']) ?$settings['slack_webhook'] :'', ['class' => 'form-control w-100', 'placeholder' => __('Enter Slack Webhook URL'), 'required' => 'required'])); ?>

                                    </div>
                                </div>

                                <div class="col-md-12 mt-4 mb-2">
                                    <h4 class="small-title bg-white"><?php echo e(__('Module Setting')); ?></h4>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Monthly payslip create')); ?></span> 
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('monthly_payslip_notification', '1',isset($settings['monthly_payslip_notification']) && $settings['monthly_payslip_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'monthly_payslip_notification'))); ?>

                                                <label class="custom-control-label" for="monthly_payslip_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item"> 
                                            <span><?php echo e(__('Award create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('award_notificaation', '1',isset($settings['award_notificaation']) && $settings['award_notificaation'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'award_notificaation'))); ?>

                                                <label class="custom-control-label" for="award_notificaation"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Announcement create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('Announcement_notification', '1',isset($settings['Announcement_notification']) && $settings['Announcement_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'Announcement_notification'))); ?>

                                                <label class="custom-control-label" for="Announcement_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <span> <?php echo e(__('Holidays create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('Holiday_notification', '1',isset($settings['Holiday_notification']) && $settings['Holiday_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'Holiday_notification'))); ?>

                                                <label class="custom-control-label" for="Holiday_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                    </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Meeting create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('meeting_notification', '1',isset($settings['meeting_notification']) && $settings['meeting_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'meeting_notification'))); ?>

                                                <label class="custom-control-label" for="meeting_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Company policy create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('company_policy_notification', '1',isset($settings['company_policy_notification']) && $settings['company_policy_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'company_policy_notification'))); ?>

                                                <label class="custom-control-label" for="company_policy_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Ticket create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('ticket_notification', '1',isset($settings['ticket_notification']) && $settings['ticket_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'ticket_notification'))); ?>

                                                <label class="custom-control-label" for="ticket_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Event create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('event_notification', '1',isset($settings['event_notification']) && $settings['event_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'event_notification'))); ?>

                                                <label class="custom-control-label" for="event_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                      
                                      </ul>
                                </div>
                                
                            </div>
                           
                            <div class="col-lg-12  text-right">
                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div> 

                    
                    <div class="tab-pane fade" id="telegram-setting" role="tabpanel">
                        <div class="card-header bg-transparent p-0 pb-1">
                            <div class="row mb-2">
                                <div class="col my-auto">
                                    <h5><?php echo e(__('Telegram')); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <?php echo e(Form::open(['route' => 'telegram.setting','id'=>'telegram-setting','method'=>'post' ,'class'=>'d-contents'])); ?>

                            <div class="row">

                                <div class="card-body pd-0">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label mb-0"><?php echo e(__('Telegram AccessToken')); ?></label> <br>
                                            <?php echo e(Form::text('telegram_accestoken',isset($settings['telegram_accestoken'])?$settings['telegram_accestoken']:'', ['class' => 'form-control', 'placeholder' => __('Enter Telegram AccessToken')])); ?>

                                        </div>
                                
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label mb-0"><?php echo e(__('Telegram ChatID')); ?></label> <br>
                                            <?php echo e(Form::text('telegram_chatid',isset($settings['telegram_chatid'])?$settings['telegram_chatid']:'', ['class' => 'form-control', 'placeholder' => __('Enter Telegram ChatID')])); ?>

                                        </div>
                                
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4 mb-2">
                                    <h4 class="small-title bg-white"><?php echo e(__('Module Setting')); ?></h4>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Monthly payslip create')); ?></span> 
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('telegram_monthly_payslip_notification', '1',isset($settings['telegram_monthly_payslip_notification']) && $settings['telegram_monthly_payslip_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'telegram_monthly_payslip_notification'))); ?>

                                                <label class="custom-control-label" for="telegram_monthly_payslip_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item"> 
                                            <span><?php echo e(__('Award create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('telegram_award_notification', '1',isset($settings['telegram_award_notification']) && $settings['telegram_award_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'telegram_award_notification'))); ?>

                                                <label class="custom-control-label" for="telegram_award_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Announcement create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('telegram_Announcement_notification', '1',isset($settings['telegram_Announcement_notification']) && $settings['telegram_Announcement_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'telegram_Announcement_notification'))); ?>

                                                <label class="custom-control-label" for="telegram_Announcement_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <span> <?php echo e(__('Holidays create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('telegram_Holiday_notification', '1',isset($settings['telegram_Holiday_notification']) && $settings['telegram_Holiday_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'telegram_Holiday_notification'))); ?>

                                                <label class="custom-control-label" for="telegram_Holiday_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                    </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Meeting create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('telegram_meeting_notification', '1',isset($settings['telegram_meeting_notification']) && $settings['telegram_meeting_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'telegram_meeting_notification'))); ?>

                                                <label class="custom-control-label" for="telegram_meeting_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Company policy create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('telegram_company_policy_notification', '1',isset($settings['telegram_company_policy_notification']) && $settings['telegram_company_policy_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'telegram_company_policy_notification'))); ?>

                                                <label class="custom-control-label" for="telegram_company_policy_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Ticket create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('telegram_ticket_notification', '1',isset($settings['telegram_ticket_notification']) && $settings['telegram_ticket_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'telegram_ticket_notification'))); ?>

                                                <label class="custom-control-label" for="telegram_ticket_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Event create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('telegram_event_notification', '1',isset($settings['telegram_event_notification']) && $settings['telegram_event_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'telegram_event_notification'))); ?>

                                                <label class="custom-control-label" for="telegram_event_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                      
                                      </ul>
                                </div>
                                
                            </div>
                            <div class="col-lg-12  text-right">
                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div> 

                      
                      <div class="tab-pane fade" id="twilio-setting" role="tabpanel">
                        <div class="card-header bg-transparent p-0 pb-1">
                            <div class="row mb-2">
                                <div class="col my-auto">
                                    <h5><?php echo e(__('Twilio')); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <?php echo e(Form::open(['route' => 'twilio.setting','id'=>'twilio-setting','method'=>'post' ,'class'=>'d-contents'])); ?>

                            <div class="row">

                                <div class="card-body pd-0">
                                    <div class="row">
                                        <div class="form-group col-md-4 ">
                                            <?php echo e(Form::label('twilio_sid',__('Twilio SID'),array('class'=>'form-control-label mb-0'))); ?>

                                            <?php echo e(Form::text('twilio_sid',isset($settings['twilio_sid'])?$settings['twilio_sid']:'', ['class' => 'form-control', 'placeholder' => __('Enter Twilio Sid')])); ?>


                                        </div>
                                
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label mb-0"><?php echo e(__('Twilio Token')); ?></label> <br>
                                            <?php echo e(Form::text('twilio_token',isset($settings['twilio_token'])?$settings['twilio_token']:'', ['class' => 'form-control', 'placeholder' => __('Enter Twilio Token')])); ?>


                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label mb-0"><?php echo e(__('Twilio From')); ?></label> <br>
                                            <?php echo e(Form::text('twilio_from',isset($settings['twilio_from'])?$settings['twilio_from']:'', ['class' => 'form-control', 'placeholder' => __('Enter Twilio From')])); ?>


                                        </div>
                                
                                    </div>
                                </div>
                                     
                                <div class="col-md-12 mt-4 mb-2">
                                    <h4 class="small-title bg-white"><?php echo e(__('Module Setting')); ?></h4>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Payslip create')); ?></span> 
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('twilio_payslip_notification', '1',isset($settings['twilio_payslip_notification']) && $settings['twilio_payslip_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'twilio_payslip_notification'))); ?>

                                                <label class="custom-control-label" for="twilio_payslip_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item"> 
                                            <span><?php echo e(__('Leave approve/reject')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('twilio_leave_approve_notification', '1',isset($settings['twilio_leave_approve_notification']) && $settings['twilio_leave_approve_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'twilio_leave_approve_notification'))); ?>

                                                <label class="custom-control-label" for="twilio_leave_approve_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Award create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('twilio_award_notification', '1',isset($settings['twilio_award_notification']) && $settings['twilio_award_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'twilio_award_notification'))); ?>

                                                <label class="custom-control-label" for="twilio_award_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <span> <?php echo e(__('Trip create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('twilio_trip_notification', '1',isset($settings['twilio_trip_notification']) && $settings['twilio_trip_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'twilio_trip_notification'))); ?>

                                                <label class="custom-control-label" for="twilio_trip_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                    </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Announcement create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('twilio_announcement_notification', '1',isset($settings['twilio_announcement_notification']) && $settings['twilio_announcement_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'twilio_announcement_notification'))); ?>

                                                <label class="custom-control-label" for="twilio_announcement_notification"></label>
                                            </div>
                                        </li>
                                       
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Ticket create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('twilio_ticket_notification', '1',isset($settings['twilio_ticket_notification']) && $settings['twilio_ticket_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'twilio_ticket_notification'))); ?>

                                                <label class="custom-control-label" for="twilio_ticket_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span><?php echo e(__('Event create')); ?></span>
                                            <div class="custom-control custom-switch float-right">
                                                <?php echo e(Form::checkbox('twilio_event_notification', '1',isset($settings['twilio_event_notification']) && $settings['twilio_event_notification'] == '1' ?'checked':'',array('class'=>'custom-control-input','id'=>'twilio_event_notification'))); ?>

                                                <label class="custom-control-label" for="twilio_event_notification"></label>
                                            </div>
                                        </li>
                                      </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-group">
                                      
                                      </ul>
                                </div>
                                
                            </div>
                            <div class="col-lg-12  text-right">
                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-submit text-white">
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>  

                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/setting/company_settings.blade.php ENDPATH**/ ?>