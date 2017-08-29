<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Add Validation Rules...
		\Validator::extend('true',              'App\Http\Validator\CustomValidator@validateTrue');
		\Validator::extend('false',             'App\Http\Validator\CustomValidator@validateFalse');
		\Validator::extend('user_role',         'App\Http\Validator\CustomValidator@validateUserRole');
		\Validator::extend('admin_role',        'App\Http\Validator\CustomValidator@validateAdminRole');
		\Validator::extend('video_scale',       'App\Http\Validator\CustomValidator@validateVideoScale');
		\Validator::extend('jp_zip_code',       'App\Http\Validator\CustomValidator@validateJpZipCode');
		\Validator::extend('card_number',       'App\Http\Validator\CustomValidator@validateCardNumber');
		\Validator::extend('card_holder_name',  'App\Http\Validator\CustomValidator@validateCardHolderName');
		\Validator::extend('security_code',     'App\Http\Validator\CustomValidator@validateSecurityCode');
		\Validator::extend('card_expire',       'App\Http\Validator\CustomValidator@validateCardExpire');
		\Validator::extend('zenkaku_kana',      'App\Http\Validator\CustomValidator@validateZenkakuKana');
		\Validator::extend('only_zenkaku',      'App\Http\Validator\CustomValidator@validateOnlyZenkaku');
		\Validator::extend('mime_images',       'App\Http\Validator\CustomValidator@validateMimeTypeOfImages');
		\Validator::extend('mime_csv',          'App\Http\Validator\CustomValidator@validateMimeTypeOfCsv');
		\Validator::extend('exists_file',       'App\Http\Validator\CustomValidator@validateExistsFile');
		\Validator::extend('select_contact',    'App\Http\Validator\CustomValidator@validateSelectContact');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
