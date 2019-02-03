<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//no routes for transactions

$route['register'] = 'login/register';
$route['first-time-login'] = 'login/first_time_login';
$route['change-password-success'] = 'login/change_pw_success';
$route['logout'] = 'login/log_out';

$route['settings/renew-password'] = 'settings/reset_pw_form';
$route['e-confirmation'] = 'e_confirmation';
$route['e-confirmation/show/(:num)'] = 'e_confirmation/show/$1';

// -------------------------CLASS---------------------------------

$route['class-selected/(:num)/(:num)/(:num)/(:num)/(:num)'] = 'classes/class_selected/$1/$2/$3/$4/$5';
$route['grade-sheet/(:num)/(:num)/(:num)/(:num)/(:num)'] = 'classes/grade_sheet/$1/$2/$3/$4/$5';
// $route['student-grade/(:num)/(:num)'] = 'classes/student_grade/$1/$2';
// $route['update-grade/(:any)/(:num)'] = 'classes/update_grade/$1/$2';

// --------------END CLASS-----------------

// -------------------------FACULTY ONLY---------------------------------

$route['my-class'] = 'my_class';
$route['my-class/class-selected/(:num)/(:num)/(:num)/(:num)'] = 'my_class/class_selected/$1/$2/$3/$4';
$route['my-class/grade-sheet/(:num)/(:num)/(:num)/(:num)'] = 'my_class/grade_sheet/$1/$2/$3/$4';
$route['inc-grades'] = 'faculty_inc';
$route['inc-grades/classes/(:num)'] = 'faculty_inc/classes/$1';
$route['inc-grades/completion/(:num)/(:num)/(:num)'] = 'faculty_inc/completion/$1/$2/$3';

// -------------------------END FACULTY ONLY---------------------------------

$route['incomplete'] = 'incomplete';

$route['auto-schedule'] = 'auto_schedule';

// -------------------------MAINTENANCE---------------------------------

$route['maintenance/term'] = 'maintenance_term';
$route['maintenance/term/form'] = 'maintenance_term/form';
$route['maintenance/term/form/(:num)'] = 'maintenance_term/form/$1';
$route['maintenance/term/show/(:num)'] = 'maintenance_term/show/$1';
$route['maintenance/term/form-success/(:num)'] = 'maintenance_term/success_page/$1';

$route['maintenance/room'] = 'maintenance_room';
$route['maintenance/room/form'] = 'maintenance_room/form';
$route['maintenance/room/form/(:num)'] = 'maintenance_room/form/$1';
$route['maintenance/room/show/(:num)'] = 'maintenance_room/show/$1';
$route['maintenance/room/form-success/(:num)'] = 'maintenance_room/success_page/$1';

$route['maintenance/course'] = 'maintenance_course';
$route['maintenance/course/form'] = 'maintenance_course/form';
$route['maintenance/course/form/(:num)'] = 'maintenance_course/form/$1';
$route['maintenance/course/show/(:num)'] = 'maintenance_course/show/$1';
$route['maintenance/course/form-success/(:num)'] = 'maintenance_course/success_page/$1';

$route['maintenance/prospectus'] = 'maintenance_prospectus';
$route['maintenance/prospectus/form'] = 'maintenance_prospectus/form';
$route['maintenance/prospectus/form/(:num)'] = 'maintenance_prospectus/form/$1';
$route['maintenance/prospectus/show/(:num)'] = 'maintenance_prospectus/show/$1';
$route['maintenance/prospectus/form-success/(:num)'] = 'maintenance_prospectus/success_page/$1';

$route['maintenance/section'] = 'maintenance_section';
$route['maintenance/section/form'] = 'maintenance_section/form';
$route['maintenance/section/form/(:num)'] = 'maintenance_section/form/$1';
$route['maintenance/section/show/(:num)'] = 'maintenance_section/show/$1';
$route['maintenance/section/form-success/(:num)'] = 'maintenance_section/success_page/$1';

$route['maintenance/day'] = 'maintenance_day';
$route['maintenance/day/form'] = 'maintenance_day/form';
$route['maintenance/day/form/(:num)'] = 'maintenance_day/form/$1';
$route['maintenance/day/show/(:num)'] = 'maintenance_day/show/$1';
$route['maintenance/day/form-success/(:num)'] = 'maintenance_day/success_page/$1';

$route['maintenance/subject'] = 'maintenance_subject';
$route['maintenance/subject/form'] = 'maintenance_subject/form';
$route['maintenance/subject/form/(:num)/(:num)'] = 'maintenance_subject/form/$1/$2';
$route['maintenance/subject/show/(:num)/(:num)'] = 'maintenance_subject/show/$1/$2';
$route['maintenance/subject/form-success/(:num)/(:num)'] = 'maintenance_subject/success_page/$1/$2';

$route['maintenance/specialization'] = 'maintenance_specialization';
$route['maintenance/specialization/form'] = 'maintenance_specialization/form';
$route['maintenance/specialization/form/(:num)'] = 'maintenance_specialization/form/$1';
$route['maintenance/specialization/show/(:num)'] = 'maintenance_specialization/show/$1';
$route['maintenance/specialization/form-success/(:num)'] = 'maintenance_specialization/success_page/$1';
// $route['maintenance/class'] = 'maintenance_class';
// $route['maintenance/class/(:num)'] = 'maintenance_class/index/$1';
// $route['maintenance/class/form'] = 'maintenance_class/form';
// $route['maintenance/class/form/(:num)'] = 'maintenance_class/form/$1';
// $route['maintenance/class/form-batch'] = 'maintenance_class/form_batch';
// $route['maintenance/class/form-batch/(:num)/(:num)'] = 'maintenance_class/form_batch/$1/$2';
// $route['maintenance/class/show/(:num)'] = 'maintenance_class/show/$1';
// $route['maintenance/class/form-success/(:num)'] = 'maintenance_class/success_page/$1';
// $route['maintenance/class/success/(:num)/(:num)'] = 'maintenance_class/batch_success_page/$1/$2';

$route['maintenance/grade-formula'] = 'maintenance_formula';

$route['maintenance/fees'] = 'maintenance_fees';
$route['maintenance/fees/form'] = 'maintenance_fees/form';
$route['maintenance/fees/form/(:num)'] = 'maintenance_fees/form/$1';
$route['maintenance/fees/show/(:num)'] = 'maintenance_fees/show/$1';
$route['maintenance/fees/form-success/(:num)'] = 'maintenance_fees/success_page/$1';
$route['maintenance/fees/transfer-fee/(:num)'] = 'maintenance_fees/transfer_fee/$1';
$route['maintenance/fees/involved-students/(:num)'] = 'maintenance_fees/involved_page/$1';

// --------------END MAINTENANCE-----------------


// --------------USERS-----------------

$route['users/student'] = 'users_student';
$route['users/student/form'] = 'users_student/form';
$route['users/student/form/(:num)'] = 'users_student/form/$1';
$route['users/student/show/(:num)'] = 'users_student/show/$1';
$route['users/student/credit-subjects/(:num)'] = 'users_student/credit_subjects/$1';
$route['users/student/form-success/(:num)'] = 'users_student/success_page/$1';

$route['users/faculty'] = 'users_faculty';
$route['users/faculty/form'] = 'users_faculty/form';
$route['users/faculty/form/(:num)'] = 'users_faculty/form/$1';
$route['users/faculty/show/(:num)'] = 'users_faculty/show/$1';
$route['users/faculty/access-rights/(:num)'] = 'users_faculty/access_rights/$1';
$route['users/faculty/form-success/(:num)'] = 'users_faculty/success_page/$1';

$route['users/staff'] = 'users_staff';
$route['users/staff/form'] = 'users_staff/form';
$route['users/staff/form/(:num)'] = 'users_staff/form/$1';
$route['users/staff/show/(:num)'] = 'users_staff/show/$1';
$route['users/staff/access-rights/(:num)'] = 'users_staff/access_rights/$1';
$route['users/staff/form-success/(:num)'] = 'users_staff/success_page/$1';

$route['users/registration'] = 'registration';
$route['users/registration/show/(:num)'] = 'registration/show/$1';

// --------------END USERS-----------------


// --------------REPORTS-----------------

$route['reports/prospectus'] = 'reports_prospectus';
$route['reports/prospectus/download/(:num)'] = 'reports_prospectus/download/$1';

$route['reports/student'] = 'reports_student';
$route['reports/student/download/(:any)/(:any)/(:any)/(:any)'] = 'reports_student/download/$1/$2/$3/$4';

$route['reports/grade'] = 'reports_grade';
$route['reports/grade/by-class/(:num)'] = 'reports_grade/by_class/$1';
$route['reports/grade/(:any)/(:num)'] = 'reports_grade/download/$1/$2';
$route['reports/grade/(:num)'] = 'reports_grade/index/$1';

$route['reports/remark'] = 'reports_remark';

$route['reports/fees'] = 'reports_fees';
$route['reports/fees/download/(:num)/(:any)'] = 'reports_fees/download/$1/$2';

$route['reports/payment-logs'] = 'reports_payment_logs';
$route['reports/payment-logs/download/(:any)/(:any)/(:any)'] = 'reports_payment_logs/download/$1/$2/$3';

$route['reports/class'] = 'reports_class';
$route['reports/class/download/(:any)/(:num)'] = 'reports_class/download/$1/$2';

// --------------END REPORTS-----------------


// -------------------------STUDENT NAVIGATION---------------------------------

$route['student/dashboard'] = 'student_users';
$route['student/my-classes'] = 'student_users/my_classes';
$route['student/enrolment'] = 'student_users/enrolment';
$route['student/class-schedules'] = 'student_users/class_schedules';
$route['student/grades-by-prospectus'] = 'student_users/grades_by_prospectus';
$route['student/grades-by-class'] = 'student_users/grades_by_class';
$route['student/fees'] = 'student_users/fees';
$route['student/payment-logs'] = 'student_users/payment_logs';
$route['student/profile'] = 'student_users/profile';
$route['student/payment-logs'] = 'student_users/payment_logs';
$route['student/prospectus'] = 'student_users/prospectus';

// -------------------------END STUDENT NAVIGATION---------------------------------