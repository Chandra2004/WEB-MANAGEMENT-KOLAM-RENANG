<?php
// ROUTER
use TheFramework\App\Router;
use TheFramework\App\View;
use TheFramework\Helpers\Helper;

// MIDDLEWARE
use TheFramework\Middleware\WAFMiddleware;
use TheFramework\Middleware\CsrfMiddleware;
use TheFramework\Middleware\AuthMiddleware;
use TheFramework\Middleware\RoleMiddleware;

// CONTROLLER
use TheFramework\Http\Controllers\HomepageController;
use TheFramework\Http\Controllers\AuthController;
use TheFramework\Http\Controllers\CategoryController;
use TheFramework\Http\Controllers\CoachController;
use TheFramework\Http\Controllers\DashboardController;
use TheFramework\Http\Controllers\EventController;
use TheFramework\Http\Controllers\GalleryController;
use TheFramework\Http\Controllers\MemberController;
use TheFramework\Http\Controllers\MyProfileController;
use TheFramework\Http\Controllers\NotificationController;
use TheFramework\Http\Controllers\PaymentMethodController;
use TheFramework\Http\Controllers\RegistrationController;
use TheFramework\Http\Controllers\UserController;

// COMING SOON
Router::add('GET', '/coming-soon', function () {
    return View::render('layouts.layout-partials.later', [
        'user' => Helper::session_get('user'),
        'notification' => Helper::get_flash('notification'),
        'title' => 'Khafid Swimming Club (KSC) - Official Website | Segera Hadir',
    ]);
});

// GUEST
Router::add('GET', '/', HomepageController::class, 'homepage', [WAFMiddleware::class]);
Router::add('GET', '/about-us', HomepageController::class, 'aboutUs', [WAFMiddleware::class]);
Router::add('GET', '/facilities', HomepageController::class, 'facilities', [WAFMiddleware::class]);
Router::add('GET', '/coaches', HomepageController::class, 'coaches', [WAFMiddleware::class]);

Router::add('GET', '/events/search/{keyword}', HomepageController::class, 'events', [WAFMiddleware::class]);
Router::add('GET', '/events/search/{keyword}/page/{page}', HomepageController::class, 'events', [WAFMiddleware::class]);
Router::add('GET', '/events', HomepageController::class, 'events', [WAFMiddleware::class]);
Router::add('GET', '/events/page/{page}', HomepageController::class, 'events', [WAFMiddleware::class]);

Router::add('GET', '/detail-event/{slug}/{uid}', HomepageController::class, 'eventDetail', [WAFMiddleware::class]);
Router::add('POST', '/registration/event/create/process', RegistrationController::class, 'registrationCreateProcess', [WAFMiddleware::class, CsrfMiddleware::class, [RoleMiddleware::class, ['admin', 'member', 'coach']]]);

Router::add('GET', '/galleries', HomepageController::class, 'galleries', [WAFMiddleware::class]);
Router::add('GET', '/contact', HomepageController::class, 'contact', [WAFMiddleware::class]);
Router::add('POST', '/contact/process', HomepageController::class, 'contactProcess', [WAFMiddleware::class, CsrfMiddleware::class]);

// AUTH
Router::add('GET', '/register', AuthController::class, 'register', [WAFMiddleware::class]);
Router::add('POST', '/register/process', AuthController::class, 'registerProcess', [WAFMiddleware::class, CsrfMiddleware::class]);

Router::add('GET', '/login', AuthController::class, 'login', [WAFMiddleware::class]);
Router::add('POST', '/login/process', AuthController::class, 'loginProcess', [WAFMiddleware::class, CsrfMiddleware::class]);

Router::add('GET', '/forgot-password', AuthController::class, 'forgotPassword', [WAFMiddleware::class]);
Router::add('POST', '/forgot-password/process', AuthController::class, 'forgotPasswordProcess', [WAFMiddleware::class, CsrfMiddleware::class]);

Router::add('GET', '/reset-password/{uid}', AuthController::class, 'resetPassword', [WAFMiddleware::class]);
Router::add('POST', '/reset-password/{uid}/process', AuthController::class, 'resetPasswordProcess', [WAFMiddleware::class, CsrfMiddleware::class]);

Router::group([
    'prefix' => '/{role}',
    'middleware' => [
        AuthMiddleware::class,
        CsrfMiddleware::class,
        WAFMiddleware::class,
    ]
], function () {
    // DASHBOARD
    Router::add('GET', '/dashboard', DashboardController::class, 'dashboard', [[RoleMiddleware::class, ['admin', 'coach', 'member']]]);

    Router::add('GET', '/dashboard/registration-history', RegistrationController::class, 'registrationHistory', [[RoleMiddleware::class, ['member']]]);

    // PAYMENT MANAGEMENT
    Router::add('GET', '/dashboard/management-payment', PaymentMethodController::class, 'paymentMethod', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-payment/create/process', PaymentMethodController::class, 'paymentMethodCreateProcess', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/{uidPaymentMethod}/dashboard/management-payment/edit/process', PaymentMethodController::class, 'paymentMethodEditProcess', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/{uidPaymentMethod}/dashboard/management-payment/delete/process', PaymentMethodController::class, 'paymentMethodDeleteProcess', [[RoleMiddleware::class, ['admin']]]);

    // CATEGORY MANAGEMENT
    Router::add('GET', '/dashboard/management-category', CategoryController::class, 'category', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('GET', '/dashboard/management-category/page/{page}', CategoryController::class, 'category', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-category/create/process', CategoryController::class, 'categoryCreateProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/{uidCategory}/dashboard/management-category/edit/process', CategoryController::class, 'categoryEditProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/{uidCategory}/dashboard/management-category/delete/process', CategoryController::class, 'categoryDeleteProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);

    // EVENT MANAGEMENT
    Router::add('GET', '/dashboard/management-event', EventController::class, 'event', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('GET', '/dashboard/event', EventController::class, 'event', [[RoleMiddleware::class, ['member']]]);
    Router::add('GET', '/dashboard/event/page/{page}', EventController::class, 'event', [[RoleMiddleware::class, ['member']]]);
    Router::add('GET', '/dashboard/management-event/page/{page}', EventController::class, 'event', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-event/create/process', EventController::class, 'eventCreateProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/{uidEvent}/dashboard/management-event/edit/process', EventController::class, 'eventEditProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/{uidEvent}/dashboard/management-event/delete/process', EventController::class, 'eventDeleteProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);

    // REGISTRATION MANAGEMENT
    Router::add('GET', '/dashboard/management-registration', RegistrationController::class, 'registration', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/{uidRegistration}/dashboard/management-registration/edit/process', RegistrationController::class, 'registrationEditProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/{uidRegistration}/dashboard/management-registration/delete/process', RegistrationController::class, 'registrationDeleteProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);

    // GALLERY MANAGEMENT
    Router::add('GET', '/dashboard/management-gallery', GalleryController::class, 'gallery', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('GET', '/dashboard/management-gallery/page/{page}', GalleryController::class, 'galleryPage', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-gallery/create/process', GalleryController::class, 'galleryCreateProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-gallery/{uidGallery}/edit/process', GalleryController::class, 'galleryEditProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-gallery/{uidGallery}/delete/process', GalleryController::class, 'galleryDeleteProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);

    // USER MANAGEMENT
    Router::add('GET', '/dashboard/management-user', UserController::class, 'user', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-user/create/process', UserController::class, 'userCreateProcess', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/{uidPerson}/dashboard/management-user/edit/process', UserController::class, 'userEditProcess', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/{uidPerson}/dashboard/management-user/delete/process', UserController::class, 'userDeleteProcess', [[RoleMiddleware::class, ['admin']]]);

    // PELATIH MANAGEMENT
    Router::add('GET', '/dashboard/management-coach', CoachController::class, 'coach', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-coach/create/process', CoachController::class, 'coachCreateProcess', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-coach/{uidCoach}/edit/process', CoachController::class, 'coachEditProcess', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-coach/{uidCoach}/delete/process', CoachController::class, 'coachDeleteProcess', [[RoleMiddleware::class, ['admin']]]);

    // MEMBER MANAGEMENT
    Router::add('GET', '/dashboard/management-member', MemberController::class, 'member', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-member/create/process', MemberController::class, 'memberCreateProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-member/{uidMember}/edit/process', MemberController::class, 'memberEditProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('POST', '/{uidUser}/dashboard/management-member/{uidMember}/delete/process', MemberController::class, 'memberDeleteProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);

    // NOTIFICATION
    Router::add('GET', '/dashboard/notifications', NotificationController::class, 'notification', [[RoleMiddleware::class, ['admin', 'coach', 'member']]]);
    Router::add('POST', '/{uidUser}/dashboard/notifications/create/process', NotificationController::class, 'notificationCreateProcess', [[RoleMiddleware::class, ['admin']]]);
    Router::add('POST', '/{uidUser}/dashboard/notifications/mark-all-as-read/process', NotificationController::class, 'notificationMarkAllAsReadProcess', [[RoleMiddleware::class, ['admin', 'coach', 'member']]]);
    Router::add('POST', '/{uidUser}/dashboard/notifications/delete-all/process', NotificationController::class, 'notificationDeleteAllProcess', [[RoleMiddleware::class, ['admin', 'coach', 'member']]]);
    Router::add('POST', '/{uidUser}/dashboard/notifications/{uidNotification}/edit/process', NotificationController::class, 'notificationEditProcess', [[RoleMiddleware::class, ['admin', 'coach', 'member']]]);
    Router::add('POST', '/{uidUser}/dashboard/notifications/{uidNotification}/delete/process', NotificationController::class, 'notificationDeleteProcess', [[RoleMiddleware::class, ['admin', 'coach', 'member']]]);

    // REPORT
    Router::add('GET', '/dashboard/export-reports', DashboardController::class, 'report', [[RoleMiddleware::class, ['admin', 'coach']]]);
    Router::add('GET', '/dashboard/export-reports/process', DashboardController::class, 'exportProcess', [[RoleMiddleware::class, ['admin', 'coach']]]);

    // MY PROFILE
    Router::add('GET', '/dashboard/my-profile', MyProfileController::class, 'myProfile', [[RoleMiddleware::class, ['admin', 'coach', 'member']]]);
    Router::add('POST', '/{uidUser}/dashboard/my-profile/edit/process', MyProfileController::class, 'myProfileEditProcess', [[RoleMiddleware::class, ['admin', 'coach', 'member']]]);

    // LOGOUT
    Router::add('GET', '/{uidUser}/dashboard/logout', AuthController::class, 'logout', [[RoleMiddleware::class, ['admin', 'coach', 'member']]]);
});
