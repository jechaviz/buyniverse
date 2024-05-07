<?php

/**
 * Here is where you can register web routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * contains the "web" middleware group. Now create something great!
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com amentotech
 * @link    http://www.amentotech.com
 */

Route::fallback(
    function () {
        return View('errors.404 ');
    }
);
// Authentication route
Auth::routes();
// Cache clear route
Route::get(
    'cache-clear',
    function () {
        \Artisan::call('config:cache');
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        return redirect()->back();
    }
);
// Home 
if (empty(Request::segment(1))) {
    if (Schema::hasTable('users') && Schema::hasTable('site_managements')) {
        Route::get('/', 'HomeController@index')->name('home');
    } else {
        if (!empty(env('DB_DATABASE'))) {
            Route::get('/',
                function () {
                    //return Redirect::to('/install');
                }
            );
        } else {
            return trans('lang.configure_database');
        }
    }
}
else
{
    Route::get(
        '/home',
        function () {
            return Redirect::to('/');
        }
    )->name('home');
}


Route::get('uploadcurrency', 'HomeController@upload');
Route::get('articles/{category?}', 'ArticleController@articlesList')->name('articlesList');
Route::get('article/{slug}', 'ArticleController@showArticle')->name('showArticle');
Route::get('profile/{slug}/{role}', 'PublicController@showUserProfile')->name('showUserProfile');
Route::get('categories', 'CategoryController@categoriesList')->name('categoriesList');
Route::get('page/{slug}', 'PageController@show')->name('showPage');
Route::post('store/project-offer', 'UserController@storeProjectOffers');
if (Helper::getAccessType() == 'both' || Helper::getAccessType() == 'jobs') {
    Route::get('jobs', 'JobController@listjobs')->name('jobs');
    Route::get('job/{slug}', 'JobController@show')->name('jobDetail');
}

if (Helper::getAccessType() == 'both' || Helper::getAccessType() == 'services') {
    Route::get('services', 'ServiceController@index')->name('services');
    Route::get('service/{slug}', 'ServiceController@show')->name('serviceDetail');
}
Route::get('user/password/reset/{verify_code}', 'PublicController@resetPasswordView')->name('getResetPassView');
Route::post('user/update/password', 'PublicController@resetUserPassword')->name('resetUserPassword');
// Authentication|Guest Routes
Route::post('register/login-register-user', 'PublicController@loginUser')->name('loginUser');
Route::post('register/verify-user-code', 'PublicController@verifyUserCode');
Route::post('register/form-step1-custom-errors', 'PublicController@RegisterStep1Validation');
Route::post('register/form-step2-custom-errors', 'PublicController@RegisterStep2Validation');
Route::post('register/single-form-custom-errors', 'PublicController@singleFormValidation');
Route::get('search-results', 'PublicController@getSearchResult')->name('searchResults');
Route::post('user/add-wishlist', 'UserController@addWishlist');
// Admin Routes
Route::group(
    ['middleware' => ['role:admin']],
    function () {
        Route::get('admin/conversations/search', 'MessageController@getConversations');
        Route::get('admin/view/conversations', 'MessageController@getConversations')->name('viewConversations');
        Route::post('admin/conversation/delete-message', 'MessageController@deleteMessage');
        Route::post('admin/conversation/delete', 'MessageController@deleteConversation');
        Route::post('admin/update/user-verify', 'UserController@updateUserVerification');
        // Article Category Routes
        Route::get('admin/article/categories', 'ArticleCategoryController@index')->name('articleCategories');
        Route::get('admin/article/categories/edit-cats/{id}', 'ArticleCategoryController@edit')->name('editArticleCategories');
        Route::post('admin/article/store-category', 'ArticleCategoryController@store');
        Route::get('admin/article/categories/search', 'ArticleCategoryController@index');
        Route::post('admin/article/categories/delete-cats', 'ArticleCategoryController@destroy');
        Route::post('admin/article/categories/update-cats/{id}', 'ArticleCategoryController@update');
        Route::post('admin/articles/categories/upload-temp-image', 'ArticleCategoryController@uploadTempImage');
        Route::post('admin/article/delete-checked-cats', 'ArticleCategoryController@deleteSelected');
        // Articles Routes
        Route::get('admin/articles', 'ArticleController@index')->name('articles');
        Route::get('admin/articles/edit-article/{id}', 'ArticleController@edit')->name('editArticle');
        Route::post('admin/articles/store-article', 'ArticleController@store');
        Route::get('admin/articles/search', 'ArticleController@index');
        Route::post('admin/articles/delete-article', 'ArticleController@destroy');
        Route::post('admin/articles/update-article/{id}', 'ArticleController@update');
        Route::post('admin/articles/upload-temp-image', 'ArticleController@uploadTempImage');
        Route::post('admin/article/delete-checked-article', 'ArticleController@deleteSelected');

        Route::post('admin/clear-cache', 'SiteManagementController@clearCache');
        Route::get('admin/clear-allcache', 'SiteManagementController@clearAllCache');
        Route::get('admin/import-updates', 'SiteManagementController@importUpdate');
        Route::get('admin/import-demo', 'SiteManagementController@importDemo');
        Route::get('admin/remove-demo', 'SiteManagementController@removeDemoContent');
        Route::get('admin/payouts', 'UserController@getPayouts')->name('adminPayouts');
        Route::post('admin/update-payout-status', 'UserController@updatePayoutStatus');
        Route::get('admin/payouts/download/{year}/{month}/{ids?}', 'UserController@generatePDF');
        Route::get('users', 'UserController@userListing')->name('userListing');
        Route::get('admin/home-page-settings', 'SiteManagementController@homePageSettings')->name('homePageSettings');
        Route::post('admin/get-page-option', 'SiteManagementController@getPageOption');
        
        // Department Routes
        Route::get('admin/departments', 'DepartmentController@index')->name('departments');
        Route::get('admin/departments/edit-dpts/{id}', 'DepartmentController@edit')->name('editDepartment');
        Route::post('admin/store-department', 'DepartmentController@store');
        Route::get('admin/departments/search', 'DepartmentController@index');
        Route::post('admin/departments/delete-dpts', 'DepartmentController@destroy');
        Route::post('admin/departments/update-dpts/{id}', 'DepartmentController@update');
        Route::post('admin/delete-checked-dpts', 'DepartmentController@deleteSelected');
        // Language Routes
        Route::get('admin/languages', 'LanguageController@index')->name('languages');
        Route::get('admin/languages/edit-langs/{id}', 'LanguageController@edit')->name('editLanguages');
        Route::post('admin/store-language', 'LanguageController@store');
        Route::get('admin/languages/search', 'LanguageController@index');
        Route::post('admin/languages/delete-langs', 'LanguageController@destroy');
        Route::post('admin/languages/update-langs/{id}', 'LanguageController@update');
        Route::post('admin/delete-checked-langs', 'LanguageController@deleteSelected');
        
        // Badges Routes
        Route::get('admin/badges', 'BadgeController@index')->name('badges');
        Route::get('admin/badges/edit-badges/{id}', 'BadgeController@edit')->name('editbadges');
        Route::post('admin/store-badge', 'BadgeController@store');
        Route::get('admin/badges/search', 'BadgeController@index');
        Route::post('admin/badges/delete-badges', 'BadgeController@destroy');
        Route::post('admin/badges/update-badges/{id}', 'BadgeController@update');
        Route::post('admin/badges/upload-temp-image', 'BadgeController@uploadTempImage');
        Route::post('admin/delete-checked-badges', 'BadgeController@deleteSelected');
        // Location Routes
        Route::get('admin/locations', 'LocationController@index')->name('locations');
        Route::get('admin/locations/edit-locations/{id}', 'LocationController@edit')->name('editLocations');
        Route::post('admin/store-location', 'LocationController@store');
        Route::post('admin/locations/delete-locations', 'LocationController@destroy');
        Route::post('/admin/locations/update-location/{id}', 'LocationController@update');
        Route::post('admin/get-location-flag', 'LocationController@getFlag');
        Route::post('admin/locations/upload-temp-image', 'LocationController@uploadTempImage');
        Route::post('admin/delete-checked-locs', 'LocationController@deleteSelected');
        // Review Options Routes
        Route::get('admin/review-options', 'ReviewController@index')->name('reviewOptions');
        Route::get('admin/review-options/edit-review-options/{id}', 'ReviewController@edit')->name('editReviewOptions');
        Route::post('admin/store-review-options', 'ReviewController@store');
        Route::post('admin/review-options/delete-review-options', 'ReviewController@destroy');
        Route::post('admin/review-options/update-review-options/{id}', 'ReviewController@update');
        Route::post('admin/delete-checked-rev-options', 'ReviewController@deleteSelected');
        // Delivery Time Routes
        Route::get('admin/delivery-time', 'DeliveryTimeController@index')->name('deliveryTime');
        Route::get('admin/delivery-time/edit-delivery-time/{id}', 'DeliveryTimeController@edit')->name('editDeliveryTime');
        Route::post('admin/store-delivery-time', 'DeliveryTimeController@store');
        Route::post('admin/delivery-time/delete-delivery-time', 'DeliveryTimeController@destroy');
        Route::post('admin/delivery-time/update-delivery-time/{id}', 'DeliveryTimeController@update');
        Route::post('admin/delete-checked-delivery-time', 'DeliveryTimeController@deleteSelected');
        // Response Time Routes
        Route::get('admin/response-time', 'ResponseTimeController@index')->name('ResponseTime');
        Route::get('admin/response-time/edit-response-time/{id}', 'ResponseTimeController@edit')->name('editResponseTime');
        Route::post('admin/store-response-time', 'ResponseTimeController@store');
        Route::post('admin/response-time/delete-response-time', 'ResponseTimeController@destroy');
        Route::post('admin/response-time/update-response-time/{id}', 'ResponseTimeController@update');
        Route::post('admin/delete-checked-response-time', 'ResponseTimeController@deleteSelected');
        // Site Management Routes
        Route::get('admin/settings', 'SiteManagementController@Settings')->name('settings');
        Route::post('admin/store/email-settings', 'SiteManagementController@storeEmailSettings');
        Route::post('admin/store/home-settings', 'SiteManagementController@storeHomeSettings');
        Route::get('admin/get-section-display-setting', 'SiteManagementController@getSectionDisplaySetting');
        Route::get('admin/get-chat-display-setting', 'SiteManagementController@getchatDisplaySetting');
        Route::post('admin/store/section-settings', 'SiteManagementController@storeSectionSettings');
        Route::post('admin/store/service-section-settings', 'SiteManagementController@storeServiceSectionSettings');
        Route::post('admin/store/settings', 'SiteManagementController@storeGeneralSettings');
        Route::post('admin/store/general-home-settings', 'SiteManagementController@storeGeneralHomeSettings');
        Route::post('admin/store/menu-settings', 'SiteManagementController@storeMenuSettings');
        Route::post('admin/store/chat-settings', 'SiteManagementController@storeChatSettings');
        Route::post('admin/store/innerpage-settings', 'SiteManagementController@storeInnerPageSettings');
        Route::post('admin/get/innerpage-settings', 'SiteManagementController@getInnerPageSettings');
        Route::get('admin/get/registration-settings', 'SiteManagementController@getRegistrationSettings');
        Route::get('admin/get/site-payment-option', 'SiteManagementController@getSitePaymentOption');
        // Route::get('admin/theme-style-settings', 'SiteManagementController@ThemeStyleSettings');
        Route::post('admin/store/theme-styling-settings', 'SiteManagementController@storeThemeStylingSettings');
        Route::get('admin/get-theme-color-display-setting', 'SiteManagementController@getThemeColorDisplaySetting');
        Route::post('admin/store/registration-settings', 'SiteManagementController@storeRegistrationSettings');
        Route::post('admin/upload-temp-image/{file_name}', 'SiteManagementController@uploadTempImage');
        Route::post('admin/pages/upload-temp-image/{file_name}', 'PageController@uploadTempImage');
        Route::post('admin/store/upload-icons', 'SiteManagementController@storeDashboardIcons');
        Route::post('admin/store/footer-settings', 'SiteManagementController@storeFooterSettings');
        Route::post('admin/store/access-type-settings', 'SiteManagementController@storeAccessTypeSettings');
        Route::post('admin/store/social-settings', 'SiteManagementController@storeSocialSettings');
        Route::post('admin/store/search-menu', 'SiteManagementController@storeSearchMenu');
        Route::post('admin/store/commision-settings', 'SiteManagementController@storeCommisionSettings');
        Route::post('admin/store/payment-settings', 'SiteManagementController@storePaymentSettings');
        Route::post('admin/store/stripe-payment-settings', 'SiteManagementController@storeStripeSettings');
        Route::get('admin/email-templates', 'EmailTemplateController@index')->name('emailTemplate');
        Route::get('admin/email-templates/filter-templates', 'EmailTemplateController@index')->name('emailTemplates');
        Route::get('admin/email-templates/{id}', 'EmailTemplateController@edit')->name('editEmailTemplates');
        Route::post('admin/email-templates/update-content', 'EmailTemplateController@updateTemplateContent');
        Route::post('admin/email-templates/update-templates/{id}', 'EmailTemplateController@update');
        Route::post('admin/store/breadcrumbs-settings', 'SiteManagementController@storeBreadcrumbsSettings');
        Route::post('admin/get/breadcrumbs-settings', 'SiteManagementController@getBreadcrumbsSettings');
        Route::post('admin/get/project-settings', 'SiteManagementController@getprojectSettings');
        Route::post('admin/store/project-settings', 'SiteManagementController@storeProjectSettings');
        Route::post('admin/store/bank-detail', 'SiteManagementController@storeBankDetail');
        Route::post('admin/store/order-settings', 'SiteManagementController@storeOrderSettings');
        // Pages Routes
        Route::get('admin/pages', 'PageController@index')->name('pages');
        Route::get('admin/create/pages', 'PageController@create')->name('createPage');
        Route::get('admin/pages/edit-page/{id}', 'PageController@edit')->name('editPage');
        Route::post('admin/store-page', 'PageController@store');
        Route::get('admin/pages/search', 'PageController@index');
        Route::post('admin/pages/delete-page', 'PageController@destroy');
        // Route::post('admin/pages/update-page/{id}', 'PageController@update');
        Route::post('admin/update-page', 'PageController@update');
        Route::post('admin/delete-checked-pages', 'PageController@deleteSelected');
        //All Jobs
        Route::get('admin/jobs', 'JobController@jobsAdmin')->name('allJobs');
        Route::get('admin/jobs/search', 'JobController@jobsAdmin');
        //All Services
        Route::get('admin/services', 'ServiceController@adminServices')->name('allServices');
        Route::get('admin/service-orders', 'ServiceController@adminServiceOrders')->name('ServiceOrders');
        //All packages
        Route::get('admin/packages', 'PackageController@create')->name('createPackage');
        Route::get('admin/packages/search', 'PackageController@create');
        Route::get('admin/packages/edit/{slug}', 'PackageController@edit')->name('editPackage');
        Route::post('admin/packages/update/{slug}', 'PackageController@update');
        Route::post('admin/store/package', 'PackageController@store');
        Route::post('admin/packages/delete-package', 'PackageController@destroy');
        Route::post('package/get-package-options', 'PackageController@getPackageOptions');
        Route::post('admin/packages/upload-temp-image', 'PackageController@uploadTempImage');

        Route::get('admin/profile', 'UserController@adminProfileSettings')->name('adminProfile');
        Route::post('admin/store-profile-settings', 'UserController@storeProfileSettings');
        Route::post('admin/upload-temp-image', 'UserController@uploadTempImage');
        Route::post('admin/submit-user-refund', 'UserController@submitUserRefund');

        Route::get('admin/orders', 'UserController@showOrders')->name('orderList');
        Route::post('admin/order/change-status', 'UserController@changeOrderStatus');

        Route::get('get-pages-list', 'PageController@getPagesList');
        Route::get('get-saved-pages-order', 'SiteManagementController@getPagesOrder');
        Route::get('admin/get-menu-color-setting', 'SiteManagementController@getMenuColorSetting');
        
        Route::get('get-parent-menu-list', 'SiteManagementController@getParentMenuList');
        Route::get('get-saved-custom-menus-list', 'SiteManagementController@getSavedMenusList');

        //uploads details
        Route::get('admin/show_uploads', 'UploadsController@show_uploads')->name('show_uploads');
        Route::get('admin/provider_template', 'UploadsController@provider_template')->name('provider_template');
        Route::get('admin/employer_template', 'UploadsController@employer_template')->name('employer_template');
        Route::get('admin/address_template', 'UploadsController@address_template')->name('address_template');
        Route::get('admin/contact_template', 'UploadsController@contact_template')->name('contact_template');
        
        Route::post('admin/upload_provider', 'UploadsController@upload_provider')->name('upload_provider');
        Route::post('admin/upload_employer', 'UploadsController@upload_employer')->name('upload_employer');
        Route::post('admin/upload_address', 'UploadsController@upload_address')->name('upload_address');
        Route::post('admin/upload_contact', 'UploadsController@upload_contact')->name('upload_contact');

        Route::get('admin/approve-category/{id}', 'Sub_categoryController@approve');
        Route::get('admin/reject-category/{id}', 'Sub_categoryController@reject');
        Route::get('admin/approve-skill/{id}', 'SkillController@approve');
        Route::get('admin/reject-skill/{id}', 'SkillController@reject');

    }
);

Route::group(
    ['middleware' => ['role:employer|provider|admin']],
    function () {
        Route::get('job/edit-job/{job_slug}', 'JobController@edit')->name('editJob');
        Route::get('job/approval/{job_slug}', 'JobController@approval')->name('approvalJob'); 
        Route::get('job/resetjob/{job_slug}', 'JobController@resetjob')->name('resetjob');
        Route::get('job/cancelled/{job_slug}', 'JobController@cancelled')->name('cancelledJob');
        Route::post('job/get-stored-job-skills', 'JobController@getJobSkills');
        Route::post('job/get-job-settings', 'JobController@getAttachmentSettings');
        Route::post('job/update-job', 'JobController@update');
        Route::post('skills/get-job-skills', 'SkillController@getJobSkills');
        Route::post('job/delete-job', 'JobController@destroy');
        Route::resource('quiz', 'QuizController');
        Route::resource('questions', 'QuestionController');
        Route::resource('contests', 'ContestController');
        Route::get('contests/start/{id}', 'ContestController@start')->name('contests.start');
        Route::get('contests/invite/{id}', 'ContestController@sendinvite')->name('contests.invite');
        Route::get('employer/job/contest/{id}', 'ContestController@contest')->name('getcontest');
        Route::get('answer/{id}', 'QuestionController@answer')->name('answer');
        // Category Routes
        Route::get('admin/categories', 'CategoryController@index')->name('categories');
        Route::get('admin/categories/edit-cats/{id}', 'CategoryController@edit')->name('editCategories');
        Route::post('admin/store-category', 'CategoryController@store');
        Route::get('admin/categories/search', 'CategoryController@index');
        Route::post('admin/categories/delete-cats', 'CategoryController@destroy');
        Route::post('admin/categories/update-cats/{id}', 'CategoryController@update');
        Route::post('admin/categories/upload-temp-image', 'CategoryController@uploadTempImage');
        Route::post('admin/delete-checked-cats', 'CategoryController@deleteSelected');
        
        // Category Routes
        Route::get('employer/categories', 'EcategoryController@index')->name('ecategories');
        Route::get('employer/categories/edit-cats/{id}', 'EcategoryController@edit')->name('eeditCategories');
        //Route::post('admin/store-category', 'CategoryController@store');
        Route::get('employer/categories/search', 'EcategoryController@index');
        /*Route::post('admin/categories/delete-cats', 'CategoryController@destroy');
        Route::post('admin/categories/update-cats/{id}', 'CategoryController@update');
        Route::post('admin/categories/upload-temp-image', 'CategoryController@uploadTempImage');
        Route::post('admin/delete-checked-cats', 'CategoryController@deleteSelected');*/

        Route::resource('admin/sub-skills', 'Sub_skillController');
        
        Route::resource('admin/sub-category', 'Sub_categoryController');
        Route::resource('employer/esub-category', 'Esub_categoryController');
        Route::resource('employer/esub-skills', 'Esub_skillController');

        // Skill Routes
        Route::get('admin/skills', 'SkillController@index')->name('skills');
        
        Route::get('admin/skills/edit-skills/{id}', 'SkillController@edit')->name('editSkill');
        Route::post('admin/store-skill', 'SkillController@store');
        Route::post('admin/skills/update-skills/{id}', 'SkillController@update');
        Route::get('admin/skills/search', 'SkillController@index');
        Route::post('admin/skills/delete-skills', 'SkillController@destroy');
        Route::post('admin/delete-checked-skills', 'SkillController@deleteSelected');
        // Skill Routes
        Route::get('employer/skills', 'EskillController@index')->name('eskills');
        Route::get('employer/skills/edit-skills/{id}', 'EskillController@edit')->name('eeditSkill');
        //Route::post('admin/store-skill', 'SkillController@store');
        //Route::post('admin/skills/update-skills/{id}', 'SkillController@update');
        Route::get('employer/skills/search', 'SkillController@index');
        //Route::post('admin/skills/delete-skills', 'SkillController@destroy');
        //Route::post('admin/delete-checked-skills', 'SkillController@deleteSelected');

    }
);
Route::group(
    ['middleware' => ['role:provider|employer|admin']],
    function () {
        if (Helper::getAccessType() == 'both' || Helper::getAccessType() == 'services') {
            Route::get('provider/services/{status}', 'ProviderController@showServices')->name('ServiceListing');
            Route::get('provider/services', 'ProviderController@providerServices')->name('providerServices');
            Route::get('provider/service/{id}/{status}', 'ProviderController@showServiceDetail')->name('ServiceDetail');
        }
        Route::post('services/change-status', 'ServiceController@changeStatus');
        Route::get('provider/dashboard/edit-service/{id}', 'ServiceController@edit')->name('edit_service');
        Route::post('services/post-service', 'ServiceController@store');
        Route::post('service/upload-temp-image', 'ServiceController@uploadTempImage');
        Route::post('provider/dashboard/delete-service', 'ServiceController@destroy');
        Route::post('service/get-service-settings', 'ServiceController@getServiceSettings');
        Route::post('service/update-service', 'ServiceController@update');
    }
);
//Employer Routes
Route::group(
    ['middleware' => ['role:employer|provider']],
    function () {
        Route::post('skills/get-job-skills', 'SkillController@getJobSkills');
        Route::get('employer/dashboard/post-job', 'JobController@postJob')->name('employerPostJob');
        Route::get('employer/dashboard/draft-job/{slug}', 'JobController@draftJob')->name('employerdraftJob');       
        Route::get('employer/dashboard/manage-jobs', 'JobController@index')->name('employerManageJobs');
        Route::get('employer/jobs/{status}', 'EmployerController@showEmployerJobs');
        Route::get('employer/dashboard/job/{slug}/proposals', 'ProposalController@getJobProposals')->name('getProposals');
        Route::get('employer/dashboard', 'EmployerController@employerDashboard')->name('employerDashboard');
        Route::get('employer/profile', 'EmployerController@index')->name('employerPersonalDetail');
        Route::get('employer/employerdetail', 'EmployerController@employerdetail')->name('employerDetail');
        Route::get('employer/addressdetail', 'EmployerController@addressdetail')->name('addressDetail');
        Route::get('employer/contactdetail', 'EmployerController@contactdetail')->name('contactDetail');
        Route::post('employer/upload-temp-image', 'EmployerController@uploadTempImage');
        Route::post('employer/store-profile-settings', 'EmployerController@storeProfileSettings');
        Route::post('employer/store-employer-settings', 'EmployerController@storeemployerSettings');
        Route::post('employer/store-address-settings', 'EmployerController@storeaddressSettings');
        Route::post('employer/store-contact-settings', 'EmployerController@storecontactSettings');
        Route::post('job/post-job', 'JobController@store');
        Route::post('job/job-post', 'JobController@storejob');
        Route::post('job/upload-temp-image', 'JobController@uploadTempImage');
        Route::post('user/submit-review', 'UserController@submitReview');
        Route::post('proposal/hire-provider', 'ProposalController@hiredProvider');
        Route::get('employer/services/{status}', 'EmployerController@showEmployerServices');
        Route::get('employer/services', 'EmployerController@employerServices')->name('employerServices');
        Route::get('employer/service/{service_id}/{id}/{status}', 'EmployerController@showServiceDetail');
        Route::get('employer/payout-settings', 'EmployerController@payoutSettings')->name('employerPayoutsSettings');
        Route::get('employer/payouts', 'EmployerController@getPayouts')->name('getEmployerPayouts');
        Route::get('employer/jobs/details/{id}', 'EmployerController@showJobsDetails');
        Route::get('employer/buy', 'EmployerController@buy')->name('buy');
        Route::get('employer/products', 'EmployerController@products')->name('products');
    }
);
// Provider Routes
Route::group(
    ['middleware' => ['role:provider|employer']],
    function () {
        Route::get('change-role/{role}', 'UserController@changerole')->name('changerole');
        Route::get('/get-provider-skills', 'SkillController@getProviderSkills');
        Route::get('/get-skills', 'SkillController@getSkills');
        Route::get('provider/dispute/{slug}', 'UserController@raiseDispute');
        Route::post('provider/store-dispute', 'UserController@storeDispute');
        Route::get('provider/dashboard/experience-education', 'ProviderController@experienceEducationSettings')->name('experienceEducation');
        Route::get('provider/dashboard/project-awards', 'ProviderController@projectAwardsSettings')->name('projectAwards');
        Route::post('provider/store-profile-settings', 'ProviderController@storeProfileSettings')->name('providerProfileSetting');
        Route::post('provider/store-experience-settings', 'ProviderController@storeExperienceEducationSettings');
        Route::post('provider/store-project-award-settings', 'ProviderController@storeProjectAwardSettings');
        Route::get('provider/get-provider-skills', 'ProviderController@getproviderSkills');
        Route::get('provider/get-provider-experiences', 'ProviderController@getproviderExperiences');
        Route::get('provider/get-provider-projects', 'ProviderController@getproviderProjects');
        Route::get('provider/get-provider-educations', 'ProviderController@getproviderEducations');
        Route::get('provider/get-provider-awards', 'ProviderController@getproviderAwards');
        Route::get('provider/jobs/{status}', 'ProviderController@showproviderJobs');
        Route::get('provider/job-list', 'ProviderController@providerJoblist')->name('providerJoblist');
        Route::get('provider/job/{slug}', 'ProviderController@showOnGoingJobDetail')->name('showOnGoingJobDetail');
        Route::get('provider/proposals', 'ProviderController@showproviderProposals')->name('showProviderProposals');
        Route::get('provider/dashboard', 'ProviderController@providerDashboard')->name('providerDashboard');
        Route::get('provider/profile', 'ProviderController@index')->name('personalDetail');
        Route::post('provider/upload-temp-image', 'ProviderController@uploadTempImage');
        Route::get('provider/dashboard/post-service', 'ServiceController@create')->name('providerPostService');
        Route::get('provider/payout-settings', 'ProviderController@payoutSettings')->name('ProviderPayoutsSettings');
        Route::get('provider/payouts', 'ProviderController@getPayouts')->name('getProviderPayouts');
        Route::get('provider/jobs/', 'ProviderController@providerJobs')->name('providerJobs');
        Route::get('provider/team/{slug}', 'ProviderController@showOnGoingJobTeamDetail')->name('showOnGoingJobTeamDetail');

        Route::get('provider/quiz/{id}', 'MarksController@show')->name('getQuiz');
        Route::put('provider/quiz/{id}', 'MarksController@update')->name('postquiz');
        Route::get('provider/contest/{id}', 'ProviderController@contest')->name('providercontest');
        Route::match(['get', 'post'], '/botman', 'BotManController@handle');

        Route::get('provider/teams', 'FteamController@index')->name('fteam.index');
        Route::get('provider/teams/create', 'FteamController@create');
        Route::get('provider/teams/{id}/edit', 'FteamController@edit');
        Route::put('provider/teams/{id}', 'FteamController@update')->name('fteam.update');
        Route::post('provider/teams', 'FteamController@store');
        Route::get('provider/teams/delete-team/{id}', 'FteamController@destroy')->name('fteam.destroy');
        
    }
);
// Employer|Provider Routes
Route::group(
    ['middleware' => ['role:employer|provider|admin']],
    function () {
        Route::post('proposal/upload-temp-image', 'ProposalController@uploadTempImage');
        Route::get('job/proposal/{job_slug}', 'ProposalController@createProposal')->name('createProposal');
        Route::get('job/edit-proposal/{job_slug}', 'ProposalController@editProposal')->name('editProposal');
        Route::get('profile/settings/manage-account', 'UserController@accountSettings')->name('manageAccount');
        Route::get('profile/settings/reset-password', 'UserController@resetPassword')->name('resetPassword');
        Route::post('profile/settings/request-password', 'UserController@requestPassword');
        Route::get('profile/settings/email-notification-settings', 'UserController@emailNotificationSettings')->name('emailNotificationSettings');
        Route::post('profile/settings/save-email-settings', 'UserController@saveEmailNotificationSettings');
        Route::post('profile/settings/save-account-settings', 'UserController@saveAccountSettings');
        Route::get('profile/settings/delete-account', 'UserController@deleteAccount')->name('deleteAccount');
        Route::get('profile/settings/email-verification', 'UserController@emailVerificationSettings')->name('emailVerification');
        Route::post('user/resend-verification-code', 'UserController@resendCode');
        Route::post('user/verify-user-code', 'UserController@reVerifyUserCode');
        Route::post('profile/settings/delete-user', 'UserController@destroy');
        Route::post('admin/delete-user', 'UserController@deleteUser');
        Route::get('profile/settings/get-manage-account', 'UserController@getManageAccountData');
        Route::get('profile/settings/get-user-notification-settings', 'UserController@getUserEmailNotificationSettings');
        Route::get('profile/settings/get-user-searchable-settings', 'UserController@getUserSearchableSettings');
        Route::get('{role}/saved-items', 'UserController@getSavedItems')->name('getSavedItems');
        Route::post('profile/get-wishlist', 'UserController@getUserWishlist');
        Route::post('job/add-wishlist', 'JobController@addWishlist');
        Route::get('proposal/{slug}/{status}', 'ProposalController@show');
        Route::post('proposal/download-attachments', 'UserController@downloadAttachments');
        Route::get('proposal/download-attachments/{id}', 'UserController@downloadAttachment');
        Route::post('proposal/send-message', 'UserController@sendPrivateMessage');
        Route::post('proposal/get-private-messages', 'UserController@getPrivateMessage');
        Route::get('proposal/download/message-attachments/{id}', 'UserController@downloadMessageAttachments');
        Route::get('user/package/checkout/{id}', 'UserController@checkout');
        Route::get('user/order/bacs/{id}/{order}/{type}/{project_type?}', 'UserController@bankCheckout')->name('bankCheckout');
        Route::get('user/generate-order/bacs/{id}/{type}', 'UserController@generateOrder')->name('generate.order');
        Route::get('employer/{type}/invoice', 'UserController@getEmployerInvoices')->name('employerInvoice');
        Route::get('provider/{type}/invoice', 'UserController@getProviderInvoices')->name('providerInvoice');
        Route::get('show/invoice/{id}', 'UserController@showInvoice');
        Route::post('service/upload-temp-message_attachments', 'ServiceController@uploadTempMessageAttachments');
        // Route::post('user/verify/emailcode', 'UserController@verifyUserEmailCode');
        Route::post('user/update-payout-detail', 'UserController@updatePayoutDetail');
        Route::get('user/get-payout-detail', 'UserController@getPayoutDetail');
        Route::post('user/upload-temp-image/{type?}', 'UserController@uploadTempImage');
        Route::post('user/submit/transection', 'UserController@submitTransection');
    }
);
Route::get('page/get-page-data/{id}', 'PageController@getPage');
Route::get('get-categories', 'CategoryController@getCategories'); 
Route::get('get-currency', 'CategoryController@getcurrency'); 
Route::get('get-seven-categories', 'CategoryController@getSevenCategories');
Route::get('get-articles', 'PublicController@getArticles');
Route::get('get-home-slider/{id}', 'PageController@getSlider');
// Route::get('section/get-iframe/{video}', 'PublicController@getVideo');
Route::get('get-top-providers', 'ProviderController@getTopProviders');
Route::get('get-all-providers', 'ProviderController@getAllProviders');
Route::get('get-services', 'ServiceController@getServices');
Route::post('job/get-wishlist', 'JobController@getWishlist');
Route::get('dashboard/packages/{role}', 'PackageController@index');
Route::get('package/get-purchase-package', 'PackageController@getPurchasePackage');
Route::get('paypal/redirect-url', 'PaypalController@getIndex');
Route::get('paypal/ec-checkout', 'PaypalController@getExpressCheckout');
Route::get('paypal/ec-checkout-success', 'PaypalController@getExpressCheckoutSuccess');
Route::get('user/products/thankyou', 'UserController@thankyou');
Route::get('payment-process/{id}', 'EmployerController@employerPaymentProcess');
Route::get('search/get-search-filters', 'PublicController@getFilterlist');
Route::get('search/get-price-limit', 'PublicController@getPriceLimit');
Route::post('search/get-searchable-data', 'PublicController@getSearchableData');
Route::post('search/get-searchable-data-v2', 'PublicController@getSearchableDataV2');
Route::get('channels/{channel}/messages', 'MessageController@index')->name('cmessage');
Route::post('channels/{channel}/messages', 'MessageController@store');
Route::post('message/send-private-message', 'MessageController@store');
Route::get('message-center', 'MessageController@index')->name('message');
Route::get('message-center/get-users', 'MessageController@getUsers');
Route::get('message-center-job/{id}', 'MessageController@getUsersjob');
Route::get('start-chat/{id}', 'MessageController@startchat')->name('startchat');
Route::post('message-center/get-messages', 'MessageController@getUserMessages');
Route::post('message', 'MessageController@store')->name('message.store');
Route::get('download/{id}', 'PublicController@getFile')->name('getfile');
Route::post('submit-report', 'UserController@storeReport');
Route::post('badge/get-color', 'BadgeController@getBadgeColor');
Route::get('check-proposal-auth-user', 'PublicController@checkProposalAuth');
Route::get('check-service-auth-user', 'PublicController@checkServiceAuth');
Route::post('proposal/submit-proposal', 'ProposalController@store');
Route::post('proposal/update-proposal', 'ProposalController@estore');
Route::post('get-provider-experiences', 'PublicController@getProviderExperience');
Route::post('get-provider-education', 'PublicController@getProviderEducation');

Route::get('addmoney/stripe', array('as' => 'addmoney.paywithstripe', 'uses' => 'StripeController@payWithStripe',));
Route::post('addmoney/stripe', array('as' => 'addmoney.stripe', 'uses' => 'StripeController@postPaymentWithStripe',));


Route::get('service/payment-process/{id}', 'ServiceController@employerPaymentProcess');

// Page Builder
Route::get('get-edit-page/{id}', 'PageController@getEditPageData');
Route::get('page/get-sections/{id}', 'PageController@getEditPageSections');
Route::post('get-latest-jobs', 'JobController@getLatestJobs');
Route::get('get-top-packages/{role}', 'PackageController@getTopPackages');

// Search Component V2 
Route::get('search/get-search-filtersV2', 'PublicController@getFilterOptions');

Route::get('search/location-list', 'PublicController@getLocationList');

Route::get('api/get_provider_search', 'API\JobController@get_provider_search');
Route::post('api/search_provider_filter', 'API\JobController@search_provider_filter'); 
//api routes
Route::group(
    ['prefix' => 'api', 'middleware' => ['role:employer|provider|admin']],
    function () {
        Route::resources(['job_overview' => 'API\JobController']);
        Route::get('jobtitle/{id}', 'API\JobController@jobtitle');
        Route::post('postjobtitle', 'API\JobController@postjobtitle');
        Route::resources(['tasks' => 'API\TaskController']);
        Route::resources(['aquiz' => 'API\QuizController']);
        Route::get('aquiz/selectall/{id}', 'API\QuizController@selectall');
        Route::get('aquiz/selectrecord/{id}', 'API\QuizController@selectrecord');
        Route::get('quiz/results/{id}', 'API\QuizController@results');
        Route::resources(['question' => 'API\QuestionController']);
        Route::resources(['answer' => 'API\AnswerController']);
        Route::resources(['comments' => 'API\CommentController']);
        Route::resources(['checklist' => 'API\ChecklistController']);
        Route::get('checklist/status/{id}', 'API\ChecklistController@status');
        Route::get('tasks/status/{id}', 'API\TaskController@status');
        Route::get('tasks/priority/{id}', 'API\TaskController@priority');
        Route::get('tasks/visibility/{id}', 'API\TaskController@visibility');
        Route::get('tasks/milestone/{id}', 'API\TaskController@milestone');
        Route::get('tasks/startdate/{id}', 'API\TaskController@startdate');
        Route::get('tasks/duedate/{id}', 'API\TaskController@duedate');
        Route::resources(['v1/user' => 'API\UserController']); 
        Route::get('user/role/{id}', 'API\UserController@getrole');
        Route::resources(['contest' => 'API\ContestController']);
        Route::get('contest/bid/{id}', 'API\ContestController@bid');
        Route::get('contest/provider_bid/{id}', 'API\ContestController@provider_bid');
        Route::get('contest/over/{id}', 'API\ContestController@over');
        Route::resources(['job_note' => 'API\NoteController']);
        Route::get('job_note/star/{id}', 'API\NoteController@star');
        Route::resources(['job_ticket' => 'API\TicketController']);
        Route::get('ticket/status/{id}', 'API\TicketController@status');
        Route::resources(['reply_ticket' => 'API\ReplyticketController']);
        Route::resources(['job_file' => 'API\FilesController']);
        Route::get('job_file/download/{id}', 'API\FilesController@download');

        Route::get('proposal_file/{id}', 'API\FilesController@pfiles');
        Route::post('proposal_file', 'API\FilesController@store1');
        Route::get('proposal_file/download/{id}', 'API\FilesController@pdownload');
        Route::delete('dproposal_file/{id}', 'API\FilesController@dfiles');

        Route::get('job_ticket/download/{id}', 'API\TicketController@download');
        Route::get('job_ticket/teams/{id}', 'API\TicketController@team');
        Route::resources(['contest_proposal' => 'API\Contest_proposalController']);

        Route::get('job_project_level', 'API\JobController@getProjectLevel');
        Route::get('job_project_duration', 'API\JobController@getProjectduration');
        Route::get('job_project_english', 'API\JobController@getProjectenglishlevel');
        Route::get('job_project_provider', 'API\JobController@getProjectproviderlevel');
        Route::get('job_overview/project_level/{id}', 'API\JobController@postProjectLevel');
        Route::get('job_overview/project_duration/{id}', 'API\JobController@postProjectDuration');
        Route::get('job_overview/postprojecttype/{id}', 'API\JobController@postProjecttype');
        Route::get('job_overview/project_price/{id}', 'API\JobController@postProjectprice');
        Route::get('job_overview/project_provider/{id}', 'API\JobController@postProjectprovider');
        Route::get('job_overview/project_english/{id}', 'API\JobController@postProjectenglish');
        Route::get('job_overview/project_expirydate/{id}', 'API\JobController@postProjectexpirydate');
        Route::get('job_overview/project_jobmonth/{id}', 'API\JobController@postProjectmonth');
        Route::get('job_overview/project_jobweek/{id}', 'API\JobController@postProjectweek');
        Route::get('job_overview/project_jobday/{id}', 'API\JobController@postProjectday');
        Route::get('job_overview/project_jobhour/{id}', 'API\JobController@postProjecthour');
        Route::get('job_overview/quiz/{id}', 'API\JobController@postquiz');
        Route::get('job_overview/getquiz/{id}', 'API\JobController@getQuiz');
        Route::get('job_overview/updatequiz/{id}', 'API\JobController@updatequiz');
        Route::get('job_overview/deletequiz/{id}', 'API\JobController@deletequiz');
        Route::post('job_overview/description/{id}', 'API\JobController@postdescription');

        Route::get('job_overview/getlang/{id}', 'API\JobController@getLanguages');
        Route::get('job_overview/language/{id}', 'API\JobController@Language');
        Route::get('job_overview/updatelang/{id}', 'API\JobController@updatelang');
        Route::get('job_overview/deletelang/{id}', 'API\JobController@deletelang');

        Route::get('job_overview/skill/{id}', 'API\JobController@Skill');
        Route::get('job_overview/getskill/{id}', 'API\JobController@getSkills');
        Route::get('job_overview/updateskill/{id}', 'API\JobController@updateskill');
        Route::get('job_overview/deleteskill/{id}', 'API\JobController@deleteskill');

        Route::get('job_overview/getteam/{id}', 'API\JobController@getTeam');
        Route::post('job_overview/team/{id}', 'API\JobController@postteam');
        Route::get('job_overview/deleteteam/{id}', 'API\JobController@deleteteam');

        Route::get('job_overview/getapprover/{id}', 'API\JobController@getApprover');
        Route::post('job_overview/approver/{id}', 'API\JobController@postApprover');
        Route::get('job_overview/deleteapprover/{id}', 'API\JobController@deleteApprover');
        Route::get('job_overview/approvejob/{id}', 'API\JobController@approvejob')->name('approverapprovejob');
        Route::post('job_overview/rejectjob/{id}', 'API\JobController@rejectjob')->name('approverrejectjob');
        Route::get('job_overview/restorejob/{id}', 'API\JobController@restorejob')->name('restorejob');


        Route::get('job_overview/getenglish/{id}', 'API\JobController@getEnglish');
        Route::get('job_overview/deleteenglish/{id}', 'API\JobController@deleteenglish');

        Route::get('job_overview/getprovider/{id}', 'API\JobController@getProvider');
        Route::get('job_overview/deleteprovider/{id}', 'API\JobController@deleteProvider');

        Route::get('contest_proposal/hascontest/{id}', 'API\Contest_proposalController@hascontest');

        Route::get('job_overview/getinvited/{id}', 'API\JobController@getInvited');
        Route::get('job_overview/deleteinvited/{id}', 'API\JobController@deleteInvited');
        Route::post('job_overview/createinvite/', 'API\JobController@postInvite');

        Route::get('job_overview/getcontest/{id}', 'API\JobController@getcontest');
        //Route::post('job_overview/newbid/', 'API\JobController@store');
        Route::get('job_overview/newbid/{id}', 'API\JobController@newbid');


        //category

        Route::get('job_overview/updatecategory/{id}', 'API\JobController@updatecategory');
        Route::get('job_overview/updatecurrency/{id}', 'API\JobController@updatecurrency');
        Route::get('job_overview/deletecategory/{id}', 'API\JobController@deletecategory');


        Route::get('job_overview/updateusercategory/{id}', 'API\JobController@updateusercategory');
        Route::get('getusercategory', 'API\JobController@getusercategory');
        Route::get('job_overview/deleteusercategory/{id}', 'API\JobController@deleteusercategory');


        Route::get('sub_skills/{id}', 'API\JobController@getsubskill');
        Route::get('sub_skill/{id}', 'API\JobController@getsubkills');
        Route::get('delete_sub_skill/{id}', 'API\JobController@deletesubskill');
        Route::get('post_sub_skill/{id}', 'API\JobController@postsubskill');
        Route::get('sub_skill_status/{id}', 'API\JobController@getskillstatus');
        Route::get('sub_cat_status/{id}', 'API\JobController@getcatstatus');
        Route::get('sub_category/{id}', 'API\JobController@getsubcategory');
        Route::get('sendinvitation/{id}', 'API\JobController@sendinvitation');
        

        Route::get('contest/check/{id}', 'API\ContestController@check');
        Route::get('contest/getmessages/{id}', 'API\ContestController@getmessages');
        Route::post('contest/sendmessage', 'API\ContestController@sendmessage');

        Route::get('get_search/{id}', 'API\JobController@get_search');
        Route::get('get_search_invited/{id}', 'API\JobController@get_search_invited');
        Route::post('search_filter/{id}', 'API\JobController@search_filter'); 

        
    }
); 
