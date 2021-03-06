<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middle-ware group. Now create something great!
|
 */

if (application_installed()) {
    Route::get('/install/final', function () {
        return redirect('/');
    });
}

// Handle Main / Route
Route::get('/', 'Auth\LoginController@checkLoginState')->name('home');
Route::get('/locale', 'PublicController@set_lang')->name('language');

// Authenticates Routes
Route::get('/auth/{service}', 'Auth\SocialAuthController@redirect')->name('social.login');
Route::get('/auth/{service}/callback', 'Auth\SocialAuthController@callback')->name('social.login.callback');
Route::post('/auth/social/register', 'Auth\SocialAuthController@register')->name('social.register');

// Authenticates Routes
Auth::routes();
Route::get('verify/', 'Auth\VerifyController@index')->name('verify');
Route::get('verify/resend', 'Auth\VerifyController@resend')->name('verify.resend');
Route::get('verify/{id}/{token}', 'Auth\VerifyController@verify')->name('verify.email');
Route::get('verify/success', 'Auth\LoginController@verified')->name('verified');
Route::get('register/success', 'Auth\LoginController@registered')->name('registered');
Route::any('log-out', 'Auth\LoginController@logout')->name('log-out');
// Google 2FA Routes
Route::get('/login/2fa', 'Auth\SocialAuthController@show_2fa_form')->middleware('auth')->name('auth.2fa');
Route::get('/login/2fa/reset', 'Auth\SocialAuthController@show_2fa_reset_form')->name('auth.2fa.reset');
Route::post('/login/2fa/reset', 'Auth\SocialAuthController@reset_2fa');
Route::post('/login/2fa', function () {
    return redirect()->route('home');
})->middleware(['auth', 'g2fa']);

// if(is_maintenance()){
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
Route::get('admin/login/2fa', 'Auth\SocialAuthController@show_2fa_form')->middleware('auth')->name('admin.auth.2fa');
Route::post('admin/login/2fa', function () {
    return redirect()->route('home');
})->middleware(['auth', 'g2fa']);
// }

// User Routes
Route::prefix('user')->middleware(['auth', 'user', 'verify_user', 'g2fa'])->name('user.')->group(function () {
    Route::get('/', 'User\UserController@index')->name('home');
    Route::get('/account', 'User\UserController@account')->name('account');
    Route::get('/compliance', 'User\UserController@compliance')->name('compliance');
    Route::get('/compliance/identity/details', 'User\UserController@user_identity')->name('identity.details');
    Route::get('/compliance/residency/details', 'User\UserController@user_residency')->name('residency.details');
    Route::get('/compliance/tax/details', 'User\UserController@user_tax')->name('tax.details');

    Route::get('/account/activity', 'User\UserController@account_activity')->name('account.activity');
    Route::get('/contribute', 'User\TokenController@index')->name('token');
    Route::get('/contribute/cancel/{gateway?}', 'User\TokenController@payment_cancel')->name('payment.cancel');
    Route::get('/transactions', 'User\TransactionController@index')->name('transactions');
    Route::get('/kyc', 'User\KycController@index')->name('kyc');
    Route::get('/kyc/application', 'User\KycController@application')->name('kyc.application');
    Route::get('/kyc/application/view', 'User\KycController@view')->name('kyc.application.view');
    Route::get('/kyc-list/documents/{file}/{doc}', 'User\KycController@get_documents')->middleware('ico')->name('kycs.file');
    Route::get('/password/confirm/{token}', 'User\UserController@password_confirm')->name('password.confirm');
    // Referral v1.0.3 > v1.1.1
    Route::get('/referral', 'User\UserController@referral')->name('referral');
    // My Token v1.1.2
    Route::get('/account/balance', 'User\UserController@mytoken_balance')->name('token.balance');

    Route::get('/entities', 'User\EntitiesController@index')->name('entities');
    Route::get('/add_entities', 'User\EntitiesController@addentities_index')->name('addentities');
    Route::get('/entities/template1', 'User\EntitiesController@template1')->name('entites.template1');

    Route::post('/entities/add', 'User\EntitiesController@entities_add')->name('entities.add')->middleware('demo_user');
    Route::post('/entities/add_purpose_activities', 'User\EntitiesController@add_purpose_activities')->name('entities.add.purpose_activites')->middleware('demo_user');
    Route::post('/entities/add_domiciliation', 'User\EntitiesController@add_domiciliation')->name('entities.add.domiciliation')->middleware('demo_user');
    Route::post('/entities/add_sharecapital', 'User\EntitiesController@add_sharecapital')->name('entities.add.sharecapital')->middleware('demo_user');

    // User Ajax Request
    Route::name('ajax.')->prefix('ajax')->group(function () {
        Route::post('/account/wallet-form', 'User\UserController@get_wallet_form')->name('account.wallet');
        Route::post('/account/update', 'User\UserController@account_update')->name('account.update')->middleware('demo_user');
        Route::post('/contribute/access', 'User\TokenController@access')->name('token.access');
        Route::post('/contribute/payment', 'User\TokenController@payment')->name('payment');

        Route::post('/transactions/delete/{id}', 'User\TransactionController@destroy')->name('transactions.delete')->middleware('demo_user');
        Route::post('/transactions/view', 'User\TransactionController@show')->name('transactions.view');
        Route::post('/kyc/submit', 'User\KycController@submit')->name('kyc.submit');
        Route::post('/account/activity', 'User\UserController@account_activity_delete')->name('account.activity.delete')->middleware('demo_user');

        Route::post('/entities/change_business_activities', 'User\EntitiesController@change_business_activities')->name('change.business_activities')->middleware('demo_user');
        Route::post('/entities/add_branches', 'User\EntitiesController@add_branches')->name('entities.add.branches')->middleware('demo_user');
        Route::post('/entities/add_shareclass', 'User\EntitiesController@add_shareclass')->name('entities.add.shareclass')->middleware('demo_user');
    });
});

Route::prefix('admin')->middleware(['auth', 'admin', 'g2fa', 'ico'])->name('admin.')->group(function () {
    Route::get('/', 'Admin\AdminController@index')->name('home');
    Route::any('/system-info', 'Admin\AdminController@system_info')->name('system');
    Route::any('/tokenlite-register', 'Admin\AdminController@treatment')->name('tokenlite');
    Route::get('/profile', 'Admin\AdminController@profile')->middleware('ico')->name('profile');
    Route::get('/profile/activity', 'Admin\AdminController@activity')->middleware('ico')->name('profile.activity');
    Route::get('/password/confirm/{token}', 'Admin\AdminController@password_confirm')->name('password.confirm');
    Route::get('/transactions/{state?}', 'Admin\TransactionController@index')->middleware('ico')->name('transactions');
    Route::get('/stages/settings', 'Admin\IcoController@settings')->middleware('ico')->name('stages.settings');
    Route::get('/pages', 'Admin\PageController@index')->middleware('ico')->name('pages');
    Route::get('/settings', 'Admin\SettingController@index')->middleware(['ico', 'super_admin'])->name('settings');
    Route::get('/settings/email', 'Admin\EmailSettingController@index')->middleware(['ico', 'super_admin'])->name('settings.email');
    Route::get('/settings/referral', 'Admin\SettingController@referral_setting')->middleware(['ico', 'super_admin'])->name('settings.referral'); // v1.1.2
    Route::get('/settings/rest-api', 'Admin\SettingController@api_setting')->middleware(['ico', 'super_admin'])->name('settings.api'); // v1.0.6

    Route::get('/entity-types', 'Admin\EntityController@index')->middleware(['ico', 'super_admin'])->name('entity');
    Route::get('/add_entity', 'Admin\EntityController@add_entity')->middleware(['ico', 'super_admin'])->name('addentity');
    Route::get('/entities', 'Admin\EntitiesController@index')->middleware(['ico', 'super_admin'])->name('entities');
    Route::get('/add_entities', 'Admin\EntitiesController@addentities')->middleware(['ico', 'super_admin'])->name('addentities');


    Route::get('/jurisdiction', 'Admin\JurisdictionController@index')->middleware(['ico', 'super_admin'])->name('jurisdiction');
    Route::get('/entity/user-entity-type/{id}', 'Admin\EntityController@typedetail')->middleware(['ico', 'super_admin'])->name('entity.typedetail');
    Route::get('/entity/view-detail/{id}', 'Admin\EntityController@viewDetail')->middleware(['ico', 'super_admin'])->name('entity.viewDetail');
    Route::get('/entity/activation/{id}/{act}', 'Admin\EntityController@activation')->middleware(['ico', 'super_admin'])->name('entity.activation');

    Route::get('/articles', 'Admin\ArticlesController@index')->middleware(['ico', 'super_admin'])->name('articles');
    Route::get('/articles/detail/{article_id}', 'Admin\ArticlesController@article_detail')->middleware(['ico', 'super_admin'])->name('articles.detail');

    Route::get('/payment-methods', 'Admin\PaymentMethodController@index')->middleware(['ico', 'super_admin'])->name('payments.setup');
    Route::get('/payment-methods/edit/{slug}', 'Admin\PaymentMethodController@edit')->middleware(['ico', 'super_admin'])->name('payments.setup.edit');
    Route::get('/stages', 'Admin\IcoController@index')->middleware('ico')->name('stages');
    Route::get('/stages/{id}', 'Admin\IcoController@edit_stage')->middleware('ico')->name('stages.edit');
    Route::get('/users/{role?}', 'Admin\UsersController@index')->middleware('ico')->name('users'); //v1.1.0
    Route::get('/users/delete/{user_id}', 'Admin\UsersController@delete_users')->name('delete_users'); //v1.1.0
    Route::get('/users/wallet/change-request', 'Admin\UsersController@wallet_change_request')->middleware('ico')->name('users.wallet.change');

    Route::get('/kyc-identity/{status?}', 'Admin\KycController@identity')->middleware('ico')->name('kycs.identity');
    Route::get('/kyc-residency/{status?}', 'Admin\KycController@residency')->middleware('ico')->name('kycs.residency');
    Route::get('/kyc-tax/{status?}', 'Admin\KycController@tax')->middleware('ico')->name('kycs.tax');
    // Route::get('/kyc-identity/{status?}', 'Admin\KycController@identity')->middleware('ico')->name('kycs.identity');
    // Route::get('/kyc-identity/{status?}', 'Admin\KycController@identity')->middleware('ico')->name('kycs.identity');

    Route::get('/kyc/view/identity/{id}/{type}', 'Admin\KycController@show')->name('kyc.view.identity');
    Route::get('/kyc/edit/identity/{id}/{type}', 'Admin\KycController@edit_details')->name('kyc.edit.identity');
    Route::get('/kyc/view/residency/{id}/{type}', 'Admin\KycController@show')->name('kyc.view.residency');
    Route::get('/kyc/edit/residency/{id}/{type}', 'Admin\KycController@edit_details')->name('kyc.edit.residency');
    Route::get('/kyc/view/tax/{id}/{type}', 'Admin\KycController@show')->name('kyc.view.tax');
    Route::get('/kyc/edit/tax/{id}/{type}', 'Admin\KycController@edit_details')->name('kyc.edit.tax');


    Route::get('/kyc-list/documents/{file}/{doc}', 'Admin\KycController@get_documents')->middleware('ico')->name('kycs.file');
    Route::get('/transactions/view/{id}', 'Admin\TransactionController@show')->name('transactions.view');
    Route::get('/users/{id?}/{type?}', 'Admin\UsersController@show')->name('users.view');



    Route::get('/pages/{slug}', 'Admin\PageController@edit')->middleware('ico')->name('pages.edit');
    Route::get('/export/{table?}/{format?}', 'ExportController@export')->middleware(['ico', 'demo_user', 'super_admin'])->name('export'); // v1.1.0
    Route::get('/languages', 'Admin\LanguageController@index')->middleware(['ico'])->name('lang.manage'); // v1.1.3
    Route::get('/languages/translate/{code}', 'Admin\LanguageController@translator')->middleware(['ico'])->name('lang.translate'); // v1.1.3
    Route::get('/languages/generate/{code}', 'Admin\LanguageController@generate_translate')->middleware(['ico'])->name('generate.translate'); // v1.1.3

    /* Admin Ajax Route */
    Route::name('ajax.')->prefix('ajax')->middleware(['ico'])->group(function () {
        Route::post('/users/view', 'Admin\UsersController@status')->name('users.view')->middleware('demo_user');
        Route::post('/users/showinfo', 'Admin\UsersController@show')->name('users.show');
        Route::post('/users/delete/all', 'Admin\UsersController@delete_unverified_user')->name('users.delete')->middleware('demo_user');
        Route::post('/users/email/send', 'Admin\UsersController@send_email')->name('users.email')->middleware('demo_user');
        Route::post('/users/insert', 'Admin\UsersController@store')->middleware(['super_admin', 'demo_user'])->name('users.add');
        Route::post('/profile/update', 'Admin\AdminController@profile_update')->name('profile.update')->middleware('demo_user');
        Route::post('/profile/activity', 'Admin\AdminController@activity_delete')->name('profile.activity.delete')->middleware('demo_user');
        Route::post('/users/wallet/action', 'Admin\UsersController@wallet_change_request_action')->name('users.wallet.action');
        Route::post('/payment-methods/view', 'Admin\PaymentMethodController@show')->middleware('super_admin')->name('payments.view');
        Route::post('/payment-methods/update', 'Admin\PaymentMethodController@update')->middleware(['super_admin', 'demo_user'])->name('payments.update');
        Route::post('/payment-methods/quick-update', 'Admin\PaymentMethodController@quick_update')->middleware(['super_admin', 'demo_user'])->name('payments.qupdate');
        Route::post('/kyc/view', 'Admin\KycController@ajax_show')->name('kyc.ajax_show');
        Route::post('/stages/update', 'Admin\IcoController@update')->name('stages.update')->middleware('demo_user');
        Route::post('/stages/pause', 'Admin\IcoController@pause')->middleware('ico')->name('stages.pause')->middleware('demo_user');
        Route::post('/stages/active', 'Admin\IcoController@active')->middleware('ico')->name('stages.active')->middleware('demo_user');
        Route::post('/stages/meta/update', 'Admin\IcoController@update_options')->name('stages.meta.update')->middleware('demo_user');
        Route::post('/stages/settings/update', 'Admin\IcoController@update_settings')->name('stages.settings.update')->middleware('demo_user');
        Route::post('/stages/actions', 'Admin\IcoController@stages_action')->middleware('ico')->name('stages.actions'); //v1.1.2
        Route::post('/kyc/update', 'Admin\KycController@update')->name('kyc.update')->middleware('demo_user');

        Route::post('/kyc/edit/identity/{id}/{type}', 'Admin\KycController@save_detail')->name('kyc.edit.identity')->middleware('demo_user');
        Route::post('/kyc/edit/residency/{id}/{type}', 'Admin\KycController@save_detail')->name('kyc.edit.residency')->middleware('demo_user');
        Route::post('/kyc/edit/tax/{id}/{type}', 'Admin\KycController@save_detail')->name('kyc.edit.tax')->middleware('demo_user');

        Route::post('/transactions/update', 'Admin\TransactionController@update')->name('transactions.update')->middleware('demo_user');

        Route::post('/transactions/adjust', 'Admin\TransactionController@adjustment')->name('transactions.adjustement');
        Route::post('/settings/email/template/view', 'Admin\EmailSettingController@show_template')->middleware('super_admin')->name('settings.email.template.view');
        Route::post('/transactions/view', 'Admin\TransactionController@show')->name('transactions.view');
        Route::post('/transactions/insert', 'Admin\TransactionController@store')->name('transactions.add')->middleware('demo_user');
        Route::post('/pages/upload', 'Admin\PageController@upload_zone')->name('pages.upload')->middleware('demo_user');
        Route::post('/pages/view', 'Admin\PageController@show')->name('pages.view');
        Route::post('/pages/update', 'Admin\PageController@update')->name('pages.update')->middleware('demo_user');
        Route::post('/settings/update', 'Admin\SettingController@update')->middleware(['super_admin', 'demo_user'])->name('settings.update');
        // Settings UpdateMeta v1.1.0
        Route::post('/settings/meta/update', 'Admin\SettingController@update_meta')->middleware(['super_admin', 'demo_user'])->name('settings.meta.update');
        Route::post('/settings/email/update', 'Admin\EmailSettingController@update')->middleware(['super_admin', 'demo_user'])->name('settings.email.update');
        Route::post('/settings/email/template/update', 'Admin\EmailSettingController@update_template')->middleware(['super_admin', 'demo_user'])->name('settings.email.template.update');
        Route::post('/languages', 'Admin\LanguageController@language_action')->middleware(['ico', 'demo_user'])->name('lang.action'); // v1.1.3
        Route::post('/languages/translate', 'Admin\LanguageController@language_action')->middleware(['ico', 'demo_user'])->name('lang.translate.action'); // v1.1.3

        Route::post('/jurisdiction/edit', 'Admin\JurisdictionController@editJuris')->middleware(['ico', 'demo_user'])->name('juris.edit');
        Route::post('/jurisdiction/add', 'Admin\JurisdictionController@addJuris')->middleware(['ico', 'demo_user'])->name('juris.add');
        Route::Post('/jurisdiction/delete/{id}', 'Admin\JurisdictionController@delJuris')->middleware(['ico', 'demo_user'])->name('juris.delete');
        Route::post('/article/new_add', 'Admin\ArticlesController@newAdd')->middleware(['ico', 'demo_user'])->name('article.new');

        Route::Post('/article/delete/{article_id}', 'Admin\ArticlesController@deleteArticle')->middleware(['ico', 'demo_user'])->name('article.delete');
        Route::post('/article/edit', 'Admin\ArticlesController@editArticle')->middleware(['ico', 'demo_user'])->name('article.edit');

        Route::post('/add_entity/add-companies', 'Admin\EntityController@addEntityCompanies')->middleware(['ico', 'demo_user'])->name('entype.addcompanies');
        Route::post('/edit_entity/edit-companies', 'Admin\EntityController@editEntityCompanies')->middleware(['ico', 'demo_user'])->name('entype.editCompanies');
        Route::post('/add_entity/add-associations', 'Admin\EntityController@addEntityAssociations')->middleware(['ico', 'demo_user'])->name('entype.addAssociations');
        Route::post('/edit_entity/edit-associations', 'Admin\EntityController@editEntityAssociations')->middleware(['ico', 'demo_user'])->name('entype.editAssociations');
        Route::post('/add_entity/add-foundations', 'Admin\EntityController@addEntityFoundations')->middleware(['ico', 'demo_user'])->name('entype.addFoundations');
        Route::post('/edit_entity/edit-foundations', 'Admin\EntityController@editEntityFoundations')->middleware(['ico', 'demo_user'])->name('entype.editFoundations');
        Route::post('/add_entity/add-partnerships', 'Admin\EntityController@addEntityPartnerships')->middleware(['ico', 'demo_user'])->name('entype.addPartnerships');
        Route::post('/edit_entity/edit-partnerships', 'Admin\EntityController@editEntityPartnerships')->middleware(['ico', 'demo_user'])->name('entype.editPartnerships');
        Route::post('/add_entity/add-trusts', 'Admin\EntityController@addEntityTrusts')->middleware(['ico', 'demo_user'])->name('entype.addTrusts');
        Route::post('/edit_entity/edit-trusts', 'Admin\EntityController@editEntityTrusts')->middleware(['ico', 'demo_user'])->name('entype.editTrusts');

        Route::post('/add_entity/add', 'Admin\EntityController@addEntityInitial')->middleware(['ico', 'demo_user'])->name('entype.addinitial');
        Route::post('/edit_entity/edit', 'Admin\EntityController@editEntityInitial')->middleware(['ico', 'demo_user'])->name('entype.editinitial');

        Route::post('/entype/delete/{id}', 'Admin\EntityController@deleteEntitytype')->middleware(['ico', 'demo_user'])->name('entype.delete');

        Route::post('/entities/add', 'Admin\EntitiesController@add_entities_post')->middleware(['ico', 'demo_user'])->name('entities.add');
        Route::post('/entities/add_next', 'Admin\EntitiesController@add_entities_post_next')->middleware(['ico', 'demo_user'])->name('entities.template1');
    });

    //Clear Cache facade value:
    Route::get('/clear', function () {
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('config:clear');
        $exitCode = Artisan::call('route:clear');
        $exitCode = Artisan::call('view:clear');

        $data = ['msg' => 'success', 'message' => 'Cache Cleared and Optimized!'];

        if (request()->ajax()) {
            return response()->json($data);
        }
        return back()->with([$data['msg'] => $data['message']]);
    })->name('clear.cache');
});

Route::name('public.')->group(function () {
    Route::get('/check/updater', 'PublicController@update_check');
    Route::get('/insert/database', 'PublicController@database')->name('database');
    Route::get('/kyc-application', 'PublicController@kyc_application')->name('kyc');
    Route::get('/invite', 'PublicController@referral')->name('referral');
    Route::post('/kyc-application/file-upload', 'User\KycController@upload')->name('kyc.file.upload');
    Route::post('/kyc-application/submit', 'User\KycController@submit')->name('kyc.submit');
    Route::get('/qrgen.png', 'PublicController@qr_code')->name('qrgen');

    Route::get('white-paper', function () {
        $filename = get_setting('site_white_paper');
        $path = storage_path('app/public/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }
        $file = \File::get($path);
        $type = \File::mimeType($path);
        $response = response($file, 200)->header("Content-Type", $type);
        return $response;
    })->name('white.paper');

    Route::get('/{slug}', 'PublicController@site_pages')->name('pages');
});

// Ajax Routes
Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::post('/kyc/file-upload', 'User\KycController@upload')->name('kyc.file.upload');
});
