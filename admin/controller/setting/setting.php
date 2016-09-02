<?php

class ControllerSettingSetting extends Controller
{
    private $error = array();

    /**
     * index method
     */
    public function index()
    {
        $this->load->language('setting/setting');

        $this->document->setTitle($this->language->get('headingTitle'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('config', $this->request->post);
            $this->model_setting_setting->editSetting('social', $this->request->post);

            if ($this->config->get('config_currency_auto')) {
                $this->load->model('localisation/currency');

                $this->model_localisation_currency->refresh();
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['headingTitle']                  = $this->language->get('headingTitle');
        //Text
        $data['text_edit']                     = $this->language->get('text_edit');
        $data['text_enabled']                  = $this->language->get('text_enabled');
        $data['text_disabled']                 = $this->language->get('text_disabled');
        $data['text_select']                   = $this->language->get('text_select');
        $data['text_none']                     = $this->language->get('text_none');
        $data['text_yes']                      = $this->language->get('text_yes');
        $data['text_no']                       = $this->language->get('text_no');
        $data['text_product']                  = $this->language->get('text_product');
        $data['text_tax']                      = $this->language->get('text_tax');
        $data['text_checkout']                 = $this->language->get('text_checkout');
        $data['text_return']                   = $this->language->get('text_return');
        $data['text_shipping']                 = $this->language->get('text_shipping');
        $data['text_payment']                  = $this->language->get('text_payment');
        $data['text_mail']                     = $this->language->get('text_mail');
        $data['text_smtp']                     = $this->language->get('text_smtp');
        $data['text_google_analytics']         = $this->language->get('text_google_analytics');
        $data['text_google_captcha']           = $this->language->get('text_google_captcha');
        $data['text_contacts']                 = $this->language->get('text_contacts');
        $data['text_social_group']             = $this->language->get('text_social_group');
        $data['text_google_map']               = $this->language->get('text_google_map');
        $data['text_social_share']             = $this->language->get('text_social_share');
        $data['text_ulogin']                   = $this->language->get('text_ulogin');
        $data['text_online_chat']              = $this->language->get('text_online_chat');
        $data['text_meta_for_main']            = $this->language->get('text_meta_for_main');
        $data['text_meta_for_catalog']         = $this->language->get('text_meta_for_catalog');
        $data['text_meta_for_look']         = $this->language->get('text_meta_for_look');
        $data['text_meta_for_gallery']         = $this->language->get('text_meta_for_gallery');
        $data['text_meta_for_category']        = $this->language->get('text_meta_for_category');
        $data['text_meta_for_product']         = $this->language->get('text_meta_for_product');
        $data['text_meta_for_news']            = $this->language->get('text_meta_for_news');
        $data['text_meta_for_search']          = $this->language->get('text_meta_for_search');
        $data['text_meta_for_contacts']        = $this->language->get('text_meta_for_contacts');
        $data['text_delivery']                 = $this->language->get('text_delivery');
        $data['text_paymen']                   = $this->language->get('text_paymen');
        $data['text_main']                     = $this->language->get('text_main');
        $data['text_order_success']            = $this->language->get('text_order_success');
        $data['text_sms_message']              = $this->language->get('text_sms_message');
        $data['text_seo_home']                 = $this->language->get('text_seo_home');
        $data['text_table_parameters']                 = $this->language->get('text_table_parameters');

     
        $data['text_seo_google']               = $this->language->get('text_seo_google');
        $data['text_seo_yandex']               = $this->language->get('text_seo_yandex');
        $data['text_seo_remarketing']          = $this->language->get('text_seo_remarketing');
        $data['text_seo_scripts']              = $this->language->get('text_seo_scripts');
        $data['text_sms_settings']              = $this->language->get('text_sms_settings');
        
        //Entry
        $data['entryName']                     = $this->language->get('entryName');

        $data['entryAddress']                  = $this->language->get('entryAddress');
        $data['entryGeocode']                  = $this->language->get('entryGeocode');
        $data['entryEmail']                    = $this->language->get('entryEmail');
        $data['entryTelephone']                = $this->language->get('entryTelephone');
        $data['entryImage']                    = $this->language->get('entryImage');
        $data['entryOpen']                     = $this->language->get('entryOpen');
        $data['entryComment']                  = $this->language->get('entryComment');
        $data['entry_meta_title']              = $this->language->get('entry_meta_title');
        $data['entry_meta_description']        = $this->language->get('entry_meta_description');
        $data['entry_meta_keywords']           = $this->language->get('entry_meta_keywords');
        $data['entryLayout']                   = $this->language->get('entryLayout');
        $data['entryTemplate']                 = $this->language->get('entryTemplate');
        $data['entryCountry']                  = $this->language->get('entryCountry');
        $data['entryZone']                     = $this->language->get('entryZone');
        $data['entryLanguage']                 = $this->language->get('entryLanguage');
        $data['entryAdminLanguage']            = $this->language->get('entryAdminLanguage');
        $data['entryCurrency']                 = $this->language->get('entryCurrency');
        $data['entryCurrency_auto']            = $this->language->get('entryCurrency_auto');
        $data['entryProductLimit']             = $this->language->get('entryProductLimit');
        $data['entry_product_search_limit']    = $this->language->get('entry_product_search_limit');
        $data['entryProductDescriptionLength'] = $this->language->get('entryProductDescriptionLength');
        $data['entryLimitAdmin']               = $this->language->get('entryLimitAdmin');
        $data['entryProductCount']             = $this->language->get('entryProductCount');
        $data['entryTax']                      = $this->language->get('entryTax');
        $data['entryTaxDefault']               = $this->language->get('entryTaxDefault');
        $data['entryTax_customer']             = $this->language->get('entryTax_customer');
        $data['entryAccountMail']              = $this->language->get('entryAccountMail');
        $data['entryApi']                      = $this->language->get('entryApi');
        $data['entryCheckoutGuest']            = $this->language->get('entryCheckoutGuest');
        $data['entryCheckout']                 = $this->language->get('entryCheckout');
        $data['entryOrderStatus']              = $this->language->get('entryOrderStatus');
        $data['entryProcessingStatus']         = $this->language->get('entryProcessingStatus');
        $data['entryCompleteStatus']           = $this->language->get('entryCompleteStatus');
        $data['entryOrderMail']                = $this->language->get('entryOrderMail');
        $data['entryLogo']                     = $this->language->get('entryLogo');
        $data['entry_order_icon']              = $this->language->get('entry_order_icon');
        $data['entryIcon']                     = $this->language->get('entryIcon');
        $data['entryImageCategory']            = $this->language->get('entryImageCategory');
        $data['entry_image_tab_category']      = $this->language->get('entry_image_tab_category');
        $data['entryImageThumb']               = $this->language->get('entryImageThumb');
        $data['entry_image_article']           = $this->language->get('entry_image_article');
        $data['entryImageProduct']             = $this->language->get('entryImageProduct');
        $data['entry_image_advantage']         = $this->language->get('entry_image_advantage');
        $data['entry_image_product_info']      = $this->language->get('entry_image_product_info');
        $data['entry_image_logo']              = $this->language->get('entry_image_logo');
        $data['entry_image_banner']            = $this->language->get('entry_image_banner');
        $data['entryImageRelated']             = $this->language->get('entryImageRelated');
        $data['entry_image_news']              = $this->language->get('entry_image_news');
        $data['entryImageWishlist']            = $this->language->get('entryImageWishlist');
        $data['entryImageCart']                = $this->language->get('entryImageCart');
        $data['entry_image_search']            = $this->language->get('entry_image_search');
        $data['entry_image_order']             = $this->language->get('entry_image_order');
        $data['entryImageLocation']            = $this->language->get('entryImageLocation');
        $data['entry_width']                   = $this->language->get('entry_width');
        $data['entry_height']                  = $this->language->get('entry_height');

        $data['entryMailProtocol']             = $this->language->get('entryMailProtocol');
        $data['entryMailParameter']            = $this->language->get('entryMailParameter');
        $data['entryMailSmtpHostname']         = $this->language->get('entryMailSmtpHostname');
        $data['entryMailSmtpUsername']         = $this->language->get('entryMailSmtpUsername');
        $data['entryMailSmtpPassword']         = $this->language->get('entryMailSmtpPassword');
        $data['entryMailSmtpPort']             = $this->language->get('entryMailSmtpPort');
        $data['entryMailSmtpTimeout']          = $this->language->get('entryMailSmtpTimeout');
        $data['entryMailAlert']                = $this->language->get('entryMailAlert');
        $data['entrySecure']                   = $this->language->get('entrySecure');
        $data['entryShared']                   = $this->language->get('entryShared');
        $data['entryRobots']                   = $this->language->get('entryRobots');
        $data['entryFileMaxSize']              = $this->language->get('entryFileMaxSize');
        $data['entryFileExtAllowed']           = $this->language->get('entryFileExtAllowed');
        $data['entryFileMimeAllowed']          = $this->language->get('entryFileMimeAllowed');
        $data['entryMaintenance']              = $this->language->get('entryMaintenance');
        $data['entryPassword']                 = $this->language->get('entryPassword');
        $data['entryEncryption']               = $this->language->get('entryEncryption');
        $data['entrySeoUrl']                   = $this->language->get('entrySeoUrl');
        $data['entryCompression']              = $this->language->get('entryCompression');
        $data['entryErrorDisplay']             = $this->language->get('entryErrorDisplay');
        $data['entryErrorLog']                 = $this->language->get('entryErrorLog');
        $data['entryErrorFilename']            = $this->language->get('entryErrorFilename');
        $data['entryGoogleAnalytics']          = $this->language->get('entryGoogleAnalytics');
        $data['entryGoogleCaptchaPublic']      = $this->language->get('entryGoogleCaptchaPublic');
        $data['entryGoogleCaptchaSecret']      = $this->language->get('entryGoogleCaptchaSecret');
        $data['entryStatus']                   = $this->language->get('entryStatus');
        $data['entry_facebook_group']          = $this->language->get('entry_facebook_group');
        $data['entry_vkontakte_group']         = $this->language->get('entry_vkontakte_group');
        $data['entry_instagram_group']         = $this->language->get('entry_instagram_group');
        $data['entry_twitter_group']           = $this->language->get('entry_twitter_group');
        $data['entry_odnoklassniki_group']     = $this->language->get('entry_odnoklassniki_group');
        $data['entry_mailru_group']            = $this->language->get('entry_mailru_group');
        $data['entry_googleplus_group']        = $this->language->get('entry_googleplus_group');
        $data['entry_youtube_group']           = $this->language->get('entry_youtube_group');
        $data['entry_referal_information']     = $this->language->get('entry_referal_information');
        $data['entry_сontacts']                = $this->language->get('entry_сontacts');
        $data['entry_google_map']              = $this->language->get('entry_google_map');
        $data['entry_social_share_js']         = $this->language->get('entry_social_share_js');
        $data['entry_social_share_buttons']    = $this->language->get('entry_social_share_buttons');
        $data['entry_ulogin']                  = $this->language->get('entry_ulogin');
        $data['entry_online_chat']             = $this->language->get('entry_online_chat');
        $data['entry_sms']                     = $this->language->get('entry_sms');
        $data['entry_sms_login']               = $this->language->get('entry_sms_login');
        $data['entry_sms_password']            = $this->language->get('entry_sms_password');
        $data['entry_apikey_novaposhta']       = $this->language->get('entry_apikey_novaposhta');
        $data['entry_delivery']                = $this->language->get('entry_delivery');
        $data['entry_payment']                 = $this->language->get('entry_payment');
        $data['entry_main']                    = $this->language->get('entry_main');
        $data['entry_order_success']           = $this->language->get('entry_order_success');
        $data['entry_sms_register']            = $this->language->get('entry_sms_register');
        $data['entry_sms_forgot_password']     = $this->language->get('entry_sms_forgot_password');
        $data['entry_sms_kod']                 = $this->language->get('entry_sms_kod');
        $data['entry_sms_order']               = $this->language->get('entry_sms_order');
        $data['entry_seo_home']                = $this->language->get('entry_seo_home');
        $data['entry_about_information']       = $this->language->get('entry_about_information');
        $data['entry_title']                   = $this->language->get('entry_title');
        $data['entry_information']             = $this->language->get('entry_information');
        $data['entry_image']                   = $this->language->get('entry_image');
        $data['entry_image_hover']             = $this->language->get('entry_image_hover');
        $data['entry_payment_status']          = $this->language->get('entry_payment_status');
        $data['entry_turbosms']                = $this->language->get('entry_turbosms');
        $data['entry_turbosms_login']          = $this->language->get('entry_turbosms_login');
        $data['entry_turbosms_password']       = $this->language->get('entry_turbosms_password');
        $data['entry_sms_client']              = $this->language->get('entry_sms_client');
        $data['entry_sms_admin']               = $this->language->get('entry_sms_admin');
        $data['entry_sms_phones']              = $this->language->get('entry_sms_phones');
        $data['entry_sms_phones_placeholder']  = $this->language->get('entry_sms_phones_placeholder');
        $data['entry_google_conversion']       = $this->language->get('entry_google_conversion');

        //Help
        $data['helpGeocode']                   = $this->language->get('helpGeocode');
        $data['helpOpen']                      = $this->language->get('helpOpen');
        $data['helpComment']                   = $this->language->get('helpComment');
        $data['helpCurrency']                  = $this->language->get('helpCurrency');
        $data['helpProductLimit']              = $this->language->get('helpProductLimit');
        $data['help_product_search_limit']     = $this->language->get('help_product_search_limit');
        $data['helpLimitAdmin']                = $this->language->get('helpLimitAdmin');
        $data['helpProductCount']              = $this->language->get('helpProductCount');
        $data['helpTaxDefault']                = $this->language->get('helpTaxDefault');
        $data['helpTaxCustomer']               = $this->language->get('helpTaxCustomer');
        $data['helpLoginAttempts']             = $this->language->get('helpLoginAttempts');
        $data['helpAccount']                   = $this->language->get('helpAccount');
        $data['helpAccountMail']               = $this->language->get('helpAccountMail');
        $data['helpCheckout']                  = $this->language->get('helpCheckout');
        $data['helpOrderStatus']               = $this->language->get('helpOrderStatus');
        $data['helpProcessingStatus']          = $this->language->get('helpProcessingStatus');
        $data['helpCompleteStatus']            = $this->language->get('helpCompleteStatus');
        $data['helpOrderMail']                 = $this->language->get('helpOrderMail');
        $data['help_commission']               = $this->language->get('help_commission');
        $data['help_brand']                    = $this->language->get('help_brand');
        $data['helpMailProtocol']              = $this->language->get('helpMailProtocol');
        $data['helpMailParameter']             = $this->language->get('helpMailParameter');
        $data['helpMailSmtpHostname']          = $this->language->get('helpMailSmtpHostname');
        $data['helpMailAlert']                 = $this->language->get('helpMailAlert');
        $data['helpSecure']                    = $this->language->get('helpSecure');
        $data['helpShared']                    = $this->language->get('helpShared');
        $data['helpRobots']                    = $this->language->get('helpRobots');
        $data['helpSeoUrl']                    = $this->language->get('helpSeoUrl');
        $data['helpFileMaxSize']               = $this->language->get('helpFileMaxSize');
        $data['helpFileExtAllowed']            = $this->language->get('helpFileExtAllowed');
        $data['helpFileMimeAllowed']           = $this->language->get('helpFileMimeAllowed');
        $data['helpMaintenance']               = $this->language->get('helpMaintenance');
        $data['helpPassword']                  = $this->language->get('helpPassword');
        $data['helpEncryption']                = $this->language->get('helpEncryption');
        $data['helpCompression']               = $this->language->get('helpCompression');
        $data['helpGoogleAnalytics']           = $this->language->get('helpGoogleAnalytics');
        $data['helpGoogleCaptcha']             = $this->language->get('helpGoogleCaptcha');
        $data['help_total']                    = $this->language->get('help_total');
        $data['help_сontacts']                 = $this->language->get('help_сontacts');
        $data['help_google_map']               = $this->language->get('help_google_map');
        $data['help_social_share_js']          = $this->language->get('help_social_share_js');
        $data['help_social_share_buttons']     = $this->language->get('help_social_share_buttons');
        $data['help_ulogin']                   = $this->language->get('help_ulogin');
        $data['help_online_chat']              = $this->language->get('help_online_chat');
        $data['help_meta_category']            = $this->language->get('help_meta_category');
        $data['help_meta_product']             = $this->language->get('help_meta_product');
        $data['help_sms_login']                = $this->language->get('help_sms_login');
        $data['help_sms_password']             = $this->language->get('help_sms_password');
        $data['help_apikey_novaposhta']        = $this->language->get('help_apikey_novaposhta');
        $data['help_order_success']            = $this->language->get('help_order_success');
        $data['help_sms_register']             = $this->language->get('help_sms_register');
        $data['help_sms_forgot_password']      = $this->language->get('help_sms_forgot_password');
        $data['help_sms_kod']                  = $this->language->get('help_sms_kod');
        $data['help_sms_order']                = $this->language->get('help_sms_order');

        //Button
        $data['button_save']                   = $this->language->get('button_save');
        $data['button_cancel']                 = $this->language->get('button_cancel');
        //Tab
        $data['tab_general']                   = $this->language->get('tab_general');
        $data['tab_store']                     = $this->language->get('tab_store');
        $data['tab_local']                     = $this->language->get('tab_local');
        $data['tab_option']                    = $this->language->get('tab_option');
        $data['tab_image']                     = $this->language->get('tab_image');
        $data['tab_mail']                      = $this->language->get('tab_mail');
        $data['tab_server']                    = $this->language->get('tab_server');
        $data['tab_google']                    = $this->language->get('tab_google');
        $data['tab_social']                    = $this->language->get('tab_social');
        $data['tab_content_settings']          = $this->language->get('tab_content_settings');
        $data['tab_meta_settings']             = $this->language->get('tab_meta_settings'); 
        $data['tab_content']                   = $this->language->get('tab_content'); 
        $data['tab_seo']                       = $this->language->get('tab_seo');
        $data['tab_api']                       = $this->language->get('tab_api');

        if (isset($this->error['warning'])) {
            $data['errorWarning'] = $this->error['warning'];
        } else {
            $data['errorWarning'] = '';
        }

        if (isset($this->error['name'])) {
            $data['errorName'] = $this->error['name'];
        } else {
            $data['errorName'] = '';
        }


        if (isset($this->error['address'])) {
            $data['errorAddress'] = $this->error['address'];
        } else {
            $data['errorAddress'] = '';
        }

        if (isset($this->error['email'])) {
            $data['errorEmail'] = $this->error['email'];
        } else {
            $data['errorEmail'] = '';
        }

        if (isset($this->error['telephone'])) {
            $data['errorTelephone'] = $this->error['telephone'];
        } else {
            $data['errorTelephone'] = '';
        }

        if (isset($this->error['meta_title'])) {
            $data['errorMetaTitle'] = $this->error['meta_title'];
        } else {
            $data['errorMetaTitle'] = '';
        }

        if (isset($this->error['country'])) {
            $data['error_country'] = $this->error['country'];
        } else {
            $data['error_country'] = '';
        }

        if (isset($this->error['zone'])) {
            $data['error_zone'] = $this->error['zone'];
        } else {
            $data['error_zone'] = '';
        }

        if (isset($this->error['login_attempts'])) {
            $data['error_login_attempts'] = $this->error['login_attempts'];
        } else {
            $data['error_login_attempts'] = '';
        }
        
        if (isset($this->error['processing_status'])) {
            $data['errorProcessingStatus'] = $this->error['processing_status'];
        } else {
            $data['errorProcessingStatus'] = '';
        }

        if (isset($this->error['complete_status'])) {
            $data['errorCompleteStatus'] = $this->error['complete_status'];
        } else {
            $data['errorCompleteStatus'] = '';
        }

        
        if (isset($this->error['image_category'])) {
            $data['errorImageCategory'] = $this->error['image_category'];
        } else {
            $data['errorImageCategory'] = '';
        }

        if (isset($this->error['image_category'])) {
            $data['error_image_tab_category'] = $this->error['image_category'];
        } else {
            $data['error_image_tab_category'] = '';
        }

        if (isset($this->error['image_thumb'])) {
            $data['errorImageThumb'] = $this->error['image_thumb'];
        } else {
            $data['errorImageThumb'] = '';
        }

        if (isset($this->error['image_logo'])) {
            $data['error_image_logo'] = $this->error['image_logo'];
        } else {
            $data['error_image_logo'] = '';
        }
        
        if (isset($this->error['image_article'])) {
            $data['error_image_article'] = $this->error['image_article'];
        } else {
            $data['error_image_article'] = '';
        }

        if (isset($this->error['image_product'])) {
            $data['errorImageProduct'] = $this->error['image_product'];
        } else {
            $data['errorImageProduct'] = '';
        }

        if (isset($this->error['image_product'])) {
            $data['error_image_product_info'] = $this->error['image_product'];
        } else {
            $data['error_image_product_info'] = '';
        }

        if (isset($this->error['image_banner'])) {
            $data['error_image_banner'] = $this->error['image_banner'];
        } else {
            $data['error_image_banner'] = '';
        }

        if (isset($this->error['image_related'])) {
            $data['errorImageRelated'] = $this->error['image_related'];
        } else {
            $data['errorImageRelated'] = '';
        }

        if (isset($this->error['image_news'])) {
            $data['error_image_news'] = $this->error['image_news'];
        } else {
            $data['error_image_news'] = '';
        }

        if (isset($this->error['image_wishlist'])) {
            $data['errorImageWishlist'] = $this->error['image_wishlist'];
        } else {
            $data['errorImageWishlist'] = '';
        }

        if (isset($this->error['image_cart'])) {
            $data['errorImageCart'] = $this->error['image_cart'];
        } else {
            $data['errorImageCart'] = '';
        }

        if (isset($this->error['image_search'])) {
            $data['error_image_search'] = $this->error['image_search'];
        } else {
            $data['error_image_search'] = '';
        }

        if (isset($this->error['image_order'])) {
            $data['error_image_order'] = $this->error['image_order'];
        } else {
            $data['error_image_order'] = '';
        }

        if (isset($this->error['image_location'])) {
            $data['errorImageLocation'] = $this->error['image_location'];
        } else {
            $data['errorImageLocation'] = '';
        }
        
        if (isset($this->error['image_advantage'])) {
            $data['error_image_advantage'] = $this->error['image_advantage'];
        } else {
            $data['error_image_advantage'] = '';
        }

        if (isset($this->error['error_filename'])) {
            $data['errorErrorFilename'] = $this->error['error_filename'];
        } else {
            $data['errorErrorFilename'] = '';
        }

        if (isset($this->error['product_limit'])) {
            $data['error_product_limit'] = $this->error['product_limit'];
        } else {
            $data['error_product_limit'] = '';
        }
        
        if (isset($this->error['product_limit'])) {
            $data['error_offers_limit'] = $this->error['product_limit'];
        } else {
            $data['error_offers_limit'] = '';
        }

        if (isset($this->error['limit_admin'])) {
            $data['errorLimit_admin'] = $this->error['limit_admin'];
        } else {
            $data['errorLimit_admin'] = '';
        }

        if (isset($this->error['encryption'])) {
            $data['errorEncryption'] = $this->error['encryption'];
        } else {
            $data['errorEncryption'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_stores'),
            'href' => $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('headingTitle'),
            'href' => $this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL')
        );

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $this->load->model('catalog/information');

        $results = $this->model_catalog_information->getInformations();

        foreach ($results as $result) {
            $data['informations'][] = array(
                'information_id' => $result['information_id'],
                'title'          => $result['title'],
            );
        }

        $data['action'] = $this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->post['config_name'])) {
            $data['config_name'] = $this->request->post['config_name'];
        } else {
            $data['config_name'] = $this->config->get('config_name');
        }

        if (isset($this->request->post['config_address'])) {
            $data['config_address'] = $this->request->post['config_address'];
        } else {
            $data['config_address'] = $this->config->get('config_address');
        }

        if (isset($this->request->post['config_geocode'])) {
            $data['config_geocode'] = $this->request->post['config_geocode'];
        } else {
            $data['config_geocode'] = $this->config->get('config_geocode');
        }

        if (isset($this->request->post['config_email'])) {
            $data['config_email'] = $this->request->post['config_email'];
        } else {
            $data['config_email'] = $this->config->get('config_email');
        }
    
        if (isset($this->request->post['config_telephone'])) {
            $data['config_telephone'] = $this->request->post['config_telephone'];
        } else {
            $data['config_telephone'] = $this->config->get('config_telephone');
        }

        if (isset($this->request->post['config_fax'])) {
            $data['config_fax'] = $this->request->post['config_fax'];
        } else {
            $data['config_fax'] = $this->config->get('config_fax');
        }

        if (isset($this->request->post['config_image'])) {
            $data['config_image'] = $this->request->post['config_image'];
        } else {
            $data['config_image'] = $this->config->get('config_image');
        }

        if (isset($this->request->post['config_sms_login'])) {
            $data['config_sms_login'] = $this->request->post['config_sms_login'];
        } else {
            $data['config_sms_login'] = $this->config->get('config_sms_login');
        }

        if (isset($this->request->post['config_sms_password'])) {
            $data['config_sms_password'] = $this->request->post['config_sms_password'];
        } else {
            $data['config_sms_password'] = $this->config->get('config_sms_password');
        }

        if (isset($this->request->post['config_apikey_novaposhta'])) {
            $data['config_apikey_novaposhta'] = $this->request->post['config_apikey_novaposhta'];
        } else {
            $data['config_apikey_novaposhta'] = $this->config->get('config_apikey_novaposhta');
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['config_image']) && is_file(DIR_IMAGE . $this->request->post['config_image'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['config_image'], 100, 100);
        } elseif ($this->config->get('config_image') && is_file(DIR_IMAGE . $this->config->get('config_image'))) {
            $data['thumb'] = $this->model_tool_image->resize($this->config->get('config_image'), 100, 100);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        if (isset($this->request->post['config_open'])) {
            $data['config_open'] = $this->request->post['config_open'];
        } else {
            $data['config_open'] = $this->config->get('config_open');
        }
     
        if (isset($this->request->post['config_comment'])) {
            $data['config_comment'] = $this->request->post['config_comment'];
        } else {
            $data['config_comment'] = $this->config->get('config_comment');
        }

        if (isset($this->request->post['config_layout_id'])) {
            $data['config_layout_id'] = $this->request->post['config_layout_id'];
        } else {
            $data['config_layout_id'] = $this->config->get('config_layout_id');
        }

        $this->load->model('design/layout');

        $data['layouts'] = $this->model_design_layout->getLayouts();

        if (isset($this->request->post['config_template'])) {
            $data['config_template'] = $this->request->post['config_template'];
        } else {
            $data['config_template'] = $this->config->get('config_template');
        }

        $data['templates'] = array();

        $directories = glob(DIR_CATALOG . 'view/theme/*', GLOB_ONLYDIR);

        foreach ($directories as $directory) {
            $data['templates'][] = basename($directory);
        }

        if (isset($this->request->post['config_country_id'])) {
            $data['config_country_id'] = $this->request->post['config_country_id'];
        } else {
            $data['config_country_id'] = $this->config->get('config_country_id');
        }

        $this->load->model('localisation/country');

        $data['countries'] = $this->model_localisation_country->getCountries();

        if (isset($this->request->post['config_zone_id'])) {
            $data['config_zone_id'] = $this->request->post['config_zone_id'];
        } else {
            $data['config_zone_id'] = $this->config->get('config_zone_id');
        }

        if (isset($this->request->post['config_language'])) {
            $data['config_language'] = $this->request->post['config_language'];
        } else {
            $data['config_language'] = $this->config->get('config_language');
        }

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['config_admin_language'])) {
            $data['config_admin_language'] = $this->request->post['config_admin_language'];
        } else {
            $data['config_admin_language'] = $this->config->get('config_admin_language');
        }

        if (isset($this->request->post['config_currency'])) {
            $data['config_currency'] = $this->request->post['config_currency'];
        } else {
            $data['config_currency'] = $this->config->get('config_currency');
        }

        $this->load->model('localisation/currency');

        $data['currencies'] = $this->model_localisation_currency->getCurrencies();

        $this->load->model('catalog/product_parameter');

        $data['parameters'] = $this->model_catalog_product_parameter->getParameters();

        if (isset($this->request->post['config_product_limit'])) {
            $data['config_product_limit'] = $this->request->post['config_product_limit'];
        } else {
            $data['config_product_limit'] = $this->config->get('config_product_limit');
        }
 
        if (isset($this->request->post['config_product_search_limit'])) {
            $data['config_product_search_limit'] = $this->request->post['config_product_search_limit'];
        } else {
            $data['config_product_search_limit'] = $this->config->get('config_product_search_limit');
        }

        if (isset($this->request->post['config_limit_admin'])) {
            $data['config_limit_admin'] = $this->request->post['config_limit_admin'];
        } else {
            $data['config_limit_admin'] = $this->config->get('config_limit_admin');
        }

        if (isset($this->request->post['config_product_count'])) {
            $data['config_product_count'] = $this->request->post['config_product_count'];
        } else {
            $data['config_product_count'] = $this->config->get('config_product_count');
        }

        if (isset($this->request->post['config_tax'])) {
            $data['config_tax'] = $this->request->post['config_tax'];
        } else {
            $data['config_tax'] = $this->config->get('config_tax');
        }
        
        if (isset($this->request->post['config_tax_default'])) {
            $data['config_tax_default'] = $this->request->post['config_tax_default'];
        } else {
            $data['config_tax_default'] = $this->config->get('config_tax_default');
        }

        if (isset($this->request->post['config_tax_customer'])) {
            $data['config_tax_customer'] = $this->request->post['config_tax_customer'];
        } else {
            $data['config_tax_customer'] = $this->config->get('config_tax_customer');
        }
        
        $this->load->model('catalog/information');

        $data['informations'] = $this->model_catalog_information->getInformations();

        if (isset($this->request->post['config_account_mail'])) {
            $data['config_account_mail'] = $this->request->post['config_account_mail'];
        } else {
            $data['config_account_mail'] = $this->config->get('config_account_mail');
        }

        if (isset($this->request->post['config_order_status_id'])) {
            $data['config_order_status_id'] = $this->request->post['config_order_status_id'];
        } else {
            $data['config_order_status_id'] = $this->config->get('config_order_status_id');
        }
        
        if (isset($this->request->post['config_payment_status_id'])) {
            $data['config_payment_status_id'] = $this->request->post['config_payment_status_id'];
        } else {
            $data['config_payment_status_id'] = $this->config->get('config_payment_status_id');
        }

        if (isset($this->request->post['config_processing_status'])) {
            $data['config_processing_status'] = $this->request->post['config_processing_status'];
        } elseif ($this->config->get('config_processing_status')) {
            $data['config_processing_status'] = $this->config->get('config_processing_status');
        } else {
            $data['config_processing_status'] = array();
        }

        if (isset($this->request->post['config_complete_status'])) {
            $data['config_complete_status'] = $this->request->post['config_complete_status'];
        } elseif ($this->config->get('config_complete_status')) {
            $data['config_complete_status'] = $this->config->get('config_complete_status');
        } else {
            $data['config_complete_status'] = array();
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['config_order_mail'])) {
            $data['config_order_mail'] = $this->request->post['config_order_mail'];
        } else {
            $data['config_order_mail'] = $this->config->get('config_order_mail');
        }


        if (isset($this->request->post['config_logo'])) {
            $data['config_logo'] = $this->request->post['config_logo'];
        } else {
            $data['config_logo'] = $this->config->get('config_logo');
        }

        if (isset($this->request->post['config_logo_white'])) {
            $data['config_logo_white'] = $this->request->post['config_logo_white'];
        } else {
            $data['config_logo_white'] = $this->config->get('config_logo_white');
        }

        if (isset($this->request->post['config_logo']) && is_file(DIR_IMAGE . $this->request->post['config_logo'])) {
            $data['logo'] = $this->model_tool_image->resize($this->request->post['config_logo'], 100, 100);
        } elseif ($this->config->get('config_logo') && is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
            $data['logo'] = $this->model_tool_image->resize($this->config->get('config_logo'), 100, 100);
        } else {
            $data['logo'] = $this->model_tool_image->resize('placeholder.png', 100, 100);
        }

        if (isset($this->request->post['config_logo_white']) && is_file(DIR_IMAGE . $this->request->post['config_logo_white'])) {
            $data['logo_white'] = $this->model_tool_image->resize($this->request->post['config_logo_white'], 100, 100);
        } elseif ($this->config->get('config_logo_white') && is_file(DIR_IMAGE . $this->config->get('config_logo_white'))) {
            $data['logo_white'] = $this->model_tool_image->resize($this->config->get('config_logo_white'), 100, 100);
        } else {
            $data['logo_white'] = $this->model_tool_image->resize('placeholder.png', 100, 100);
        }

        if (isset($this->request->post['config_icon'])) {
            $data['config_icon'] = $this->request->post['config_icon'];
        } else {
            $data['config_icon'] = $this->config->get('config_icon');
        }

        if (isset($this->request->post['config_icon']) && is_file(DIR_IMAGE . $this->request->post['config_icon'])) {
            $data['icon'] = $this->model_tool_image->resize($this->request->post['config_logo'], 100, 100);
        } elseif ($this->config->get('config_icon') && is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
            $data['icon'] = $this->model_tool_image->resize($this->config->get('config_icon'), 100, 100);
        } else {
            $data['icon'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        if (isset($this->request->post['config_order_icon'])) {
            $data['config_order_icon'] = $this->request->post['config_order_icon'];
        } else {
            $data['config_order_icon'] = $this->config->get('config_order_icon');
        }
        
        if (isset($this->request->post['config_order_icon']) && is_file(DIR_IMAGE . $this->request->post['config_order_icon'])) {
            $data['order_icon'] = $this->model_tool_image->resize($this->request->post['config_logo'], 100, 100);
        } elseif ($this->config->get('config_order_icon') && is_file(DIR_IMAGE . $this->config->get('config_order_icon'))) {
            $data['order_icon'] = $this->model_tool_image->resize($this->config->get('config_order_icon'), 100, 100);
        } else {
            $data['order_icon'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
        
        if (isset($this->request->post['config_image_category_width'])) {
            $data['config_image_category_width'] = $this->request->post['config_image_category_width'];
        } else {
            $data['config_image_category_width'] = $this->config->get('config_image_category_width');
        }

        if (isset($this->request->post['config_image_category_height'])) {
            $data['config_image_category_height'] = $this->request->post['config_image_category_height'];
        } else {
            $data['config_image_category_height'] = $this->config->get('config_image_category_height');
        }

        if (isset($this->request->post['config_image_tab_category_width'])) {
            $data['config_image_tab_category_width'] = $this->request->post['config_image_tab_category_width'];
        } else {
            $data['config_image_tab_category_width'] = $this->config->get('config_image_tab_category_width');
        }

        if (isset($this->request->post['config_image_tab_category_height'])) {
            $data['config_image_tab_category_height'] = $this->request->post['config_image_tab_category_height'];
        } else {
            $data['config_image_tab_category_height'] = $this->config->get('config_image_tab_category_height');
        }
        
        if (isset($this->request->post['config_about_information'])) {
            $data['config_about_information'] = $this->request->post['config_about_information'];
        } else {
            $data['config_about_information'] = $this->config->get('config_about_information');
        }

        if (isset($this->request->post['config_delivery_information'])) {
            $data['config_delivery_information'] = $this->request->post['config_delivery_information'];
        } else {
            $data['config_delivery_information'] = $this->config->get('config_delivery_information');
        }

        if (isset($this->request->post['config_table_parameters'])) {
            $data['config_table_parameters'] = $this->request->post['config_table_parameters'];
        } else {
            $data['config_table_parameters'] = $this->config->get('config_table_parameters');
        }
        
        if (isset($this->request->post['config_image_thumb_width'])) {
            $data['config_image_thumb_width'] = $this->request->post['config_image_thumb_width'];
        } else {
            $data['config_image_thumb_width'] = $this->config->get('config_image_thumb_width');
        }

        if (isset($this->request->post['config_image_thumb_height'])) {
            $data['config_image_thumb_height'] = $this->request->post['config_image_thumb_height'];
        } else {
            $data['config_image_thumb_height'] = $this->config->get('config_image_thumb_height');
        }

        if (isset($this->request->post['config_image_article_width'])) {
            $data['config_image_article_width'] = $this->request->post['config_image_article_width'];
        } else {
            $data['config_image_article_width'] = $this->config->get('config_image_article_width');
        }

        if (isset($this->request->post['config_image_article_height'])) {
            $data['config_image_article_height'] = $this->request->post['config_image_article_height'];
        } else {
            $data['config_image_article_height'] = $this->config->get('config_image_article_height');
        }

        if (isset($this->request->post['config_image_product_width'])) {
            $data['config_image_product_width'] = $this->request->post['config_image_product_width'];
        } else {
            $data['config_image_product_width'] = $this->config->get('config_image_product_width');
        }
        
        if (isset($this->request->post['config_image_logo_height'])) {
            $data['config_image_logo_height'] = $this->request->post['config_image_logo_height'];
        } else {
            $data['config_image_logo_height'] = $this->config->get('config_image_logo_height');
        }

        if (isset($this->request->post['config_image_logo_width'])) {
            $data['config_image_logo_width'] = $this->request->post['config_image_logo_width'];
        } else {
            $data['config_image_logo_width'] = $this->config->get('config_image_logo_width');
        }

        if (isset($this->request->post['config_image_product_height'])) {
            $data['config_image_product_height'] = $this->request->post['config_image_product_height'];
        } else {
            $data['config_image_product_height'] = $this->config->get('config_image_product_height');
        }

        if (isset($this->request->post['config_image_product_info_width'])) {
            $data['config_image_product_info_width'] = $this->request->post['config_image_product_info_width'];
        } else {
            $data['config_image_product_info_width'] = $this->config->get('config_image_product_info_width');
        }

        if (isset($this->request->post['config_image_product_info_height'])) {
            $data['config_image_product_info_height'] = $this->request->post['config_image_product_info_height'];
        } else {
            $data['config_image_product_info_height'] = $this->config->get('config_image_product_info_height');
        }

        if (isset($this->request->post['config_image_banner_width'])) {
            $data['config_image_banner_width'] = $this->request->post['config_image_banner_width'];
        } else {
            $data['config_image_banner_width'] = $this->config->get('config_image_banner_width');
        }

        if (isset($this->request->post['config_image_banner_height'])) {
            $data['config_image_banner_height'] = $this->request->post['config_image_banner_height'];
        } else {
            $data['config_image_banner_height'] = $this->config->get('config_image_banner_height');
        }

        if (isset($this->request->post['config_image_related_width'])) {
            $data['config_image_related_width'] = $this->request->post['config_image_related_width'];
        } else {
            $data['config_image_related_width'] = $this->config->get('config_image_related_width');
        }

        if (isset($this->request->post['config_image_related_height'])) {
            $data['config_image_related_height'] = $this->request->post['config_image_related_height'];
        } else {
            $data['config_image_related_height'] = $this->config->get('config_image_related_height');
        }

        if (isset($this->request->post['config_image_news_width'])) {
            $data['config_image_news_width'] = $this->request->post['config_image_news_width'];
        } else {
            $data['config_image_news_width'] = $this->config->get('config_image_news_width');
        }

        if (isset($this->request->post['config_image_news_height'])) {
            $data['config_image_news_height'] = $this->request->post['config_image_news_height'];
        } else {
            $data['config_image_news_height'] = $this->config->get('config_image_news_height');
        }

        if (isset($this->request->post['config_image_wishlist_width'])) {
            $data['config_image_wishlist_width'] = $this->request->post['config_image_wishlist_width'];
        } else {
            $data['config_image_wishlist_width'] = $this->config->get('config_image_wishlist_width');
        }

        if (isset($this->request->post['config_image_wishlist_height'])) {
            $data['config_image_wishlist_height'] = $this->request->post['config_image_wishlist_height'];
        } else {
            $data['config_image_wishlist_height'] = $this->config->get('config_image_wishlist_height');
        }

        if (isset($this->request->post['config_image_cart_width'])) {
            $data['config_image_cart_width'] = $this->request->post['config_image_cart_width'];
        } else {
            $data['config_image_cart_width'] = $this->config->get('config_image_cart_width');
        }

        if (isset($this->request->post['config_image_cart_height'])) {
            $data['config_image_cart_height'] = $this->request->post['config_image_cart_height'];
        } else {
            $data['config_image_cart_height'] = $this->config->get('config_image_cart_height');
        }

        if (isset($this->request->post['config_image_search_width'])) {
            $data['config_image_search_width'] = $this->request->post['config_image_search_width'];
        } else {
            $data['config_image_search_width'] = $this->config->get('config_image_search_width');
        }

        if (isset($this->request->post['config_image_search_height'])) {
            $data['config_image_search_height'] = $this->request->post['config_image_search_height'];
        } else {
            $data['config_image_search_height'] = $this->config->get('config_image_search_height');
        }

        if (isset($this->request->post['config_image_order_width'])) {
            $data['config_image_order_width'] = $this->request->post['config_image_order_width'];
        } else {
            $data['config_image_order_width'] = $this->config->get('config_image_order_width');
        }

        if (isset($this->request->post['config_image_order_height'])) {
            $data['config_image_order_height'] = $this->request->post['config_image_order_height'];
        } else {
            $data['config_image_order_height'] = $this->config->get('config_image_order_height');
        }

        if (isset($this->request->post['config_image_location_width'])) {
            $data['config_image_location_width'] = $this->request->post['config_image_location_width'];
        } else {
            $data['config_image_location_width'] = $this->config->get('config_image_location_width');
        }

        if (isset($this->request->post['config_image_location_height'])) {
            $data['config_image_location_height'] = $this->request->post['config_image_location_height'];
        } else {
            $data['config_image_location_height'] = $this->config->get('config_image_location_height');
        }
        
        if (isset($this->request->post['config_image_advantage_height'])) {
            $data['config_image_advantage_height'] = $this->request->post['config_image_advantage_height'];
        } else {
            $data['config_image_advantage_height'] = $this->config->get('config_image_advantage_height');
        }
        
        if (isset($this->request->post['config_image_advantage_width'])) {
            $data['config_image_advantage_width'] = $this->request->post['config_image_advantage_width'];
        } else {
            $data['config_image_advantage_width'] = $this->config->get('config_image_advantage_width');
        }
        
        if (isset($this->request->post['config_seo_google'])) {
            $data['config_seo_google'] = $this->request->post['config_seo_google'];
        } else {
            $data['config_seo_google'] = $this->config->get('config_seo_google');
        }
        
        if (isset($this->request->post['config_seo_yandex'])) {
            $data['config_seo_yandex'] = $this->request->post['config_seo_yandex'];
        } else {
            $data['config_seo_yandex'] = $this->config->get('config_seo_yandex');
        }
        
        if (isset($this->request->post['config_seo_remarketing'])) {
            $data['config_seo_remarketing'] = $this->request->post['config_seo_remarketing'];
        } else {
            $data['config_seo_remarketing'] = $this->config->get('config_seo_remarketing');
        }
        

        if (isset($this->request->post['config_mail_protocol'])) {
            $data['config_mail_protocol'] = $this->request->post['config_mail_protocol'];
        } else {
            $data['config_mail_protocol'] = $this->config->get('config_mail_protocol');
        }

        if (isset($this->request->post['config_mail_parameter'])) {
            $data['config_mail_parameter'] = $this->request->post['config_mail_parameter'];
        } else {
            $data['config_mail_parameter'] = $this->config->get('config_mail_parameter');
        }

        if (isset($this->request->post['config_mail_smtp_hostname'])) {
            $data['config_mail_smtp_hostname'] = $this->request->post['config_mail_smtp_hostname'];
        } else {
            $data['config_mail_smtp_hostname'] = $this->config->get('config_mail_smtp_hostname');
        }

        if (isset($this->request->post['config_mail_smtp_username'])) {
            $data['config_mail_smtp_username'] = $this->request->post['config_mail_smtp_username'];
        } else {
            $data['config_mail_smtp_username'] = $this->config->get('config_mail_smtp_username');
        }

        if (isset($this->request->post['config_mail_smtp_password'])) {
            $data['config_mail_smtp_password'] = $this->request->post['config_mail_smtp_password'];
        } else {
            $data['config_mail_smtp_password'] = $this->config->get('config_mail_smtp_password');
        }

        if (isset($this->request->post['config_mail_smtp_port'])) {
            $data['config_mail_smtp_port'] = $this->request->post['config_mail_smtp_port'];
        } elseif ($this->config->has('config_mail_smtp_port')) {
            $data['config_mail_smtp_port'] = $this->config->get('config_mail_smtp_port');
        } else {
            $data['config_mail_smtp_port'] = 25;
        }

        if (isset($this->request->post['config_mail_smtp_timeout'])) {
            $data['config_mail_smtp_timeout'] = $this->request->post['config_mail_smtp_timeout'];
        } elseif ($this->config->has('config_mail_smtp_timeout')) {
            $data['config_mail_smtp_timeout'] = $this->config->get('config_mail_smtp_timeout');
        } else {
            $data['config_mail_smtp_timeout'] = 5;
        }

        if (isset($this->request->post['config_mail_alert'])) {
            $data['config_mail_alert'] = $this->request->post['config_mail_alert'];
        } else {
            $data['config_mail_alert'] = $this->config->get('config_mail_alert');
        }

        if (isset($this->request->post['config_secure'])) {
            $data['config_secure'] = $this->request->post['config_secure'];
        } else {
            $data['config_secure'] = $this->config->get('config_secure');
        }

        if (isset($this->request->post['config_shared'])) {
            $data['config_shared'] = $this->request->post['config_shared'];
        } else {
            $data['config_shared'] = $this->config->get('config_shared');
        }

        if (isset($this->request->post['config_robots'])) {
            $data['config_robots'] = $this->request->post['config_robots'];
        } else {
            $data['config_robots'] = $this->config->get('config_robots');
        }

        if (isset($this->request->post['config_seo_url'])) {
            $data['config_seo_url'] = $this->request->post['config_seo_url'];
        } else {
            $data['config_seo_url'] = $this->config->get('config_seo_url');
        }

        if (isset($this->request->post['config_file_max_size'])) {
            $data['config_file_max_size'] = $this->request->post['config_file_max_size'];
        } elseif ($this->config->get('config_file_max_size')) {
            $data['config_file_max_size'] = $this->config->get('config_file_max_size');
        } else {
            $data['config_file_max_size'] = 300000;
        }

        if (isset($this->request->post['config_file_ext_allowed'])) {
            $data['config_file_ext_allowed'] = $this->request->post['config_file_ext_allowed'];
        } else {
            $data['config_file_ext_allowed'] = $this->config->get('config_file_ext_allowed');
        }

        if (isset($this->request->post['config_file_mime_allowed'])) {
            $data['config_file_mime_allowed'] = $this->request->post['config_file_mime_allowed'];
        } else {
            $data['config_file_mime_allowed'] = $this->config->get('config_file_mime_allowed');
        }

        if (isset($this->request->post['config_maintenance'])) {
            $data['config_maintenance'] = $this->request->post['config_maintenance'];
        } else {
            $data['config_maintenance'] = $this->config->get('config_maintenance');
        }

        if (isset($this->request->post['config_password'])) {
            $data['config_password'] = $this->request->post['config_password'];
        } else {
            $data['config_password'] = $this->config->get('config_password');
        }

        if (isset($this->request->post['config_encryption'])) {
            $data['config_encryption'] = $this->request->post['config_encryption'];
        } else {
            $data['config_encryption'] = $this->config->get('config_encryption');
        }

        if (isset($this->request->post['config_compression'])) {
            $data['config_compression'] = $this->request->post['config_compression'];
        } else {
            $data['config_compression'] = $this->config->get('config_compression');
        }

        if (isset($this->request->post['config_error_display'])) {
            $data['config_error_display'] = $this->request->post['config_error_display'];
        } else {
            $data['config_error_display'] = $this->config->get('config_error_display');
        }

        if (isset($this->request->post['config_error_log'])) {
            $data['config_error_log'] = $this->request->post['config_error_log'];
        } else {
            $data['config_error_log'] = $this->config->get('config_error_log');
        }

        if (isset($this->request->post['config_error_filename'])) {
            $data['config_error_filename'] = $this->request->post['config_error_filename'];
        } else {
            $data['config_error_filename'] = $this->config->get('config_error_filename');
        }

        if (isset($this->request->post['config_google_analytics'])) {
            $data['config_google_analytics'] = $this->request->post['config_google_analytics'];
        } else {
            $data['config_google_analytics'] = $this->config->get('config_google_analytics');
        }

        if (isset($this->request->post['config_google_analytics_status'])) {
            $data['config_google_analytics_status'] = $this->request->post['config_google_analytics_status'];
        } else {
            $data['config_google_analytics_status'] = $this->config->get('config_google_analytics_status');
        }

        if (isset($this->request->post['config_google_captcha_public'])) {
            $data['config_google_captcha_public'] = $this->request->post['config_google_captcha_public'];
        } else {
            $data['config_google_captcha_public'] = $this->config->get('config_google_captcha_public');
        }

        if (isset($this->request->post['config_google_captcha_secret'])) {
            $data['config_google_captcha_secret'] = $this->request->post['config_google_captcha_secret'];
        } else {
            $data['config_google_captcha_secret'] = $this->config->get('config_google_captcha_secret');
        }

        if (isset($this->request->post['config_google_captcha_status'])) {
            $data['config_google_captcha_status'] = $this->request->post['config_google_captcha_status'];
        } else {
            $data['config_google_captcha_status'] = $this->config->get('config_google_captcha_status');
        }

        if (isset($this->request->post['config_google_conversion'])) {
            $data['config_google_conversion'] = $this->request->post['config_google_conversion'];
        } else {
            $data['config_google_conversion'] = $this->config->get('config_google_conversion');
        }

        if (isset($this->request->post['social_facebook'])) {
            $data['social_facebook'] = $this->request->post['social_facebook'];
        } else {
            $data['social_facebook'] = $this->config->get('social_facebook');
        }

        if (isset($this->request->post['social_vkontakte'])) {
            $data['social_vkontakte'] = $this->request->post['social_vkontakte'];
        } else {
            $data['social_vkontakte'] = $this->config->get('social_vkontakte');
        }

        if (isset($this->request->post['social_instagram'])) {
            $data['social_instagram'] = $this->request->post['social_instagram'];
        } else {
            $data['social_instagram'] = $this->config->get('social_instagram');
        }
        
        if (isset($this->request->post['config_google_map'])) {
            $data['config_google_map'] = $this->request->post['config_google_map'];
        } else {
            $data['config_google_map'] = $this->config->get('config_google_map');
        }

        if (isset($this->request->post['config_social_share_js'])) {
            $data['config_social_share_js'] = $this->request->post['config_social_share_js'];
        } else {
            $data['config_social_share_js'] = $this->config->get('config_social_share_js');
        }

        if (isset($this->request->post['config_social_share_buttons'])) {
            $data['config_social_share_buttons'] = $this->request->post['config_social_share_buttons'];
        } else {
            $data['config_social_share_buttons'] = $this->config->get('config_social_share_buttons');
        }

        if (isset($this->request->post['config_ulogin'])) {
            $data['config_ulogin'] = $this->request->post['config_ulogin'];
        } else {
            $data['config_ulogin'] = $this->config->get('config_ulogin');
        }

        if (isset($this->request->post['config_online_chat'])) {
            $data['config_online_chat'] = $this->request->post['config_online_chat'];
        } else {
            $data['config_online_chat'] = $this->config->get('config_online_chat');
        }
        
        if (isset($this->request->post['config_meta_title_main'])) {
            $data['config_meta_title_main'] = $this->request->post['config_meta_title_main'];
        } else {
            $data['config_meta_title_main'] = $this->config->get('config_meta_title_main');
        }

        if (isset($this->request->post['config_meta_description_main'])) {
            $data['config_meta_description_main'] = $this->request->post['config_meta_description_main'];
        } else {
            $data['config_meta_description_main'] = $this->config->get('config_meta_description_main');
        }

        if (isset($this->request->post['config_meta_keyword_main'])) {
            $data['config_meta_keyword_main'] = $this->request->post['config_meta_keyword_main'];
        } else {
            $data['config_meta_keyword_main'] = $this->config->get('config_meta_keyword_main');
        }
        
        if (isset($this->request->post['config_meta_title_category'])) {
            $data['config_meta_title_category'] = $this->request->post['config_meta_title_category'];
        } else {
            $data['config_meta_title_category'] = $this->config->get('config_meta_title_category');
        }

        if (isset($this->request->post['config_meta_description_category'])) {
            $data['config_meta_description_category'] = $this->request->post['config_meta_description_category'];
        } else {
            $data['config_meta_description_category'] = $this->config->get('config_meta_description_category');
        }

        if (isset($this->request->post['config_meta_keyword_category'])) {
            $data['config_meta_keyword_category'] = $this->request->post['config_meta_keyword_category'];
        } else {
            $data['config_meta_keyword_category'] = $this->config->get('config_meta_keyword_category');
        }
        
        if (isset($this->request->post['config_meta_title_product'])) {
            $data['config_meta_title_product'] = $this->request->post['config_meta_title_product'];
        } else {
            $data['config_meta_title_product'] = $this->config->get('config_meta_title_product');
        }

        if (isset($this->request->post['config_meta_description_product'])) {
            $data['config_meta_description_product'] = $this->request->post['config_meta_description_product'];
        } else {
            $data['config_meta_description_product'] = $this->config->get('config_meta_description_product');
        }

        if (isset($this->request->post['config_meta_keyword_product'])) {
            $data['config_meta_keyword_product'] = $this->request->post['config_meta_keyword_product'];
        } else {
            $data['config_meta_keyword_product'] = $this->config->get('config_meta_keyword_product');
        }
        
        if (isset($this->request->post['config_meta_title_blog'])) {
            $data['config_meta_title_blog'] = $this->request->post['config_meta_title_blog'];
        } else {
            $data['config_meta_title_blog'] = $this->config->get('config_meta_title_blog');
        }

        if (isset($this->request->post['config_meta_description_blog'])) {
            $data['config_meta_description_blog'] = $this->request->post['config_meta_description_blog'];
        } else {
            $data['config_meta_description_blog'] = $this->config->get('config_meta_description_blog');
        }

        if (isset($this->request->post['config_meta_keyword_blog'])) {
            $data['config_meta_keyword_blog'] = $this->request->post['config_meta_keyword_blog'];
        } else {
            $data['config_meta_keyword_blog'] = $this->config->get('config_meta_keyword_blog');
        }
        
        if (isset($this->request->post['config_meta_title_search'])) {
            $data['config_meta_title_search'] = $this->request->post['config_meta_title_search'];
        } else {
            $data['config_meta_title_search'] = $this->config->get('config_meta_title_search');
        }

        if (isset($this->request->post['config_meta_description_search'])) {
            $data['config_meta_description_search'] = $this->request->post['config_meta_description_search'];
        } else {
            $data['config_meta_description_search'] = $this->config->get('config_meta_description_search');
        }

        if (isset($this->request->post['config_meta_keyword_search'])) {
            $data['config_meta_keyword_search'] = $this->request->post['config_meta_keyword_search'];
        } else {
            $data['config_meta_keyword_search'] = $this->config->get('config_meta_keyword_search');
        }

        if (isset($this->request->post['config_meta_title_look'])) {
            $data['config_meta_title_look'] = $this->request->post['config_meta_title_look'];
        } else {
            $data['config_meta_title_look'] = $this->config->get('config_meta_title_look');
        }

        if (isset($this->request->post['config_meta_description_look'])) {
            $data['config_meta_description_look'] = $this->request->post['config_meta_description_look'];
        } else {
            $data['config_meta_description_look'] = $this->config->get('config_meta_description_look');
        }

        if (isset($this->request->post['config_meta_keyword_look'])) {
            $data['config_meta_keyword_look'] = $this->request->post['config_meta_keyword_look'];
        } else {
            $data['config_meta_keyword_look'] = $this->config->get('config_meta_keyword_look');
        }
        if (isset($this->request->post['config_meta_title_gallery'])) {
            $data['config_meta_title_gallery'] = $this->request->post['config_meta_title_gallery'];
        } else {
            $data['config_meta_title_gallery'] = $this->config->get('config_meta_title_gallery');
        }

        if (isset($this->request->post['config_meta_description_gallery'])) {
            $data['config_meta_description_gallery'] = $this->request->post['config_meta_description_gallery'];
        } else {
            $data['config_meta_description_gallery'] = $this->config->get('config_meta_description_gallery');
        }

        if (isset($this->request->post['config_meta_keyword_gallery'])) {
            $data['config_meta_keyword_gallery'] = $this->request->post['config_meta_keyword_gallery'];
        } else {
            $data['config_meta_keyword_gallery'] = $this->config->get('config_meta_keyword_gallery');
        }
        
        if (isset($this->request->post['config_meta_title_contacts'])) {
            $data['config_meta_title_contacts'] = $this->request->post['config_meta_title_contacts'];
        } else {
            $data['config_meta_title_contacts'] = $this->config->get('config_meta_title_contacts');
        }

        if (isset($this->request->post['config_meta_description_contacts'])) {
            $data['config_meta_description_contacts'] = $this->request->post['config_meta_description_contacts'];
        } else {
            $data['config_meta_description_contacts'] = $this->config->get('config_meta_description_contacts');
        }

        if (isset($this->request->post['config_meta_keyword_contacts'])) {
            $data['config_meta_keyword_contacts'] = $this->request->post['config_meta_keyword_contacts'];
        } else {
            $data['config_meta_keyword_contacts'] = $this->config->get('config_meta_keyword_contacts');
        }

        if (isset($this->request->post['config_delivery'])) {
            $data['config_delivery'] = $this->request->post['config_delivery'];
        } else {
            $data['config_delivery'] = $this->config->get('config_delivery');
        }

        if (isset($this->request->post['config_payment'])) {
            $data['config_payment'] = $this->request->post['config_payment'];
        } else {
            $data['config_payment'] = $this->config->get('config_payment');
        }
        
        if (isset($this->request->post['config_wholesale'])) {
            $data['config_wholesale'] = $this->request->post['config_wholesale'];
        } else {
            $data['config_wholesale'] = $this->config->get('config_wholesale');
        }
        
        if (isset($this->request->post['config_contacts'])) {
            $data['config_contacts'] = $this->request->post['config_contacts'];
        } else {
            $data['config_contacts'] = $this->config->get('config_contacts');
        }
        
        if (isset($this->request->post['config_order_success'])) {
            $data['config_order_success'] = $this->request->post['config_order_success'];
        } else {
            $data['config_order_success'] = $this->config->get('config_order_success');
        }

        if (isset($this->request->post['config_turbosms_login'])) {
            $data['config_turbosms_login'] = $this->request->post['config_turbosms_login'];
        } else {
            $data['config_turbosms_login'] = $this->config->get('config_turbosms_login');
        }
        
        if (isset($this->request->post['config_turbosms_password'])) {
            $data['config_turbosms_password'] = $this->request->post['config_turbosms_password'];
        } else {
            $data['config_turbosms_password'] = $this->config->get('config_turbosms_password');
        }
        
        if (isset($this->request->post['config_admin_sms_text'])) {
            $data['config_admin_sms_text'] = $this->request->post['config_admin_sms_text'];
        } else {
            $data['config_admin_sms_text'] = $this->config->get('config_admin_sms_text');
        }
        
        if (isset($this->request->post['config_client_sms_text'])) {
            $data['config_client_sms_text'] = $this->request->post['config_client_sms_text'];
        } else {
            $data['config_client_sms_text'] = $this->config->get('config_client_sms_text');
        }
        
        if (isset($this->request->post['config_sms_phones'])) {
            $data['config_sms_phones'] = $this->request->post['config_sms_phones'];
        } else {
            $data['config_sms_phones'] = $this->config->get('config_sms_phones');
        }
        
        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('setting/setting.tpl', $data));
    }

    /**
     * Метод проверки полей на валидность
     *
     * @return array
     */
    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'setting/setting')) {
            $this->error['warning'] = $this->language->get('errorPermission');
        }

        if (!$this->request->post['config_name']) {
            $this->error['name'] = $this->language->get('errorName');
        }

        if ((utf8_strlen($this->request->post['config_address']) < 3) || (utf8_strlen($this->request->post['config_address']) > 256)) {
            $this->error['address'] = $this->language->get('errorAddress');
        }

        if ((utf8_strlen($this->request->post['config_email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['config_email'])) {
            $this->error['email'] = $this->language->get('errorEmail');
        }
    
        if ((utf8_strlen($this->request->post['config_telephone']) < 3) || (utf8_strlen($this->request->post['config_telephone']) > 256)) {
            $this->error['telephone'] = $this->language->get('errorTelephone');
        }

        if (!$this->request->post['config_image_category_width'] || !$this->request->post['config_image_category_height']) {
            $this->error['image_category'] = $this->language->get('errorImageCategory');
        }

        if (!$this->request->post['config_image_thumb_width'] || !$this->request->post['config_image_thumb_height']) {
            $this->error['image_thumb'] = $this->language->get('errorImageThumb');
        }


        if (!$this->request->post['config_image_logo_width'] || !$this->request->post['config_image_logo_height']) {
            $this->error['image_logo'] = $this->language->get('error_image_logo');
        }

        if (!$this->request->post['config_image_product_width'] || !$this->request->post['config_image_product_height']) {
            $this->error['image_product'] = $this->language->get('errorImageProduct');
        }



        if (!$this->request->post['config_error_filename']) {
            $this->error['error_filename'] = $this->language->get('errorErrorFilename');
        } else {
            if (preg_match('/\.\.[\/\\\]?/', $this->request->post['config_error_filename'])) {
                $this->error['error_filename'] = $this->language->get('errorMalformedFilename');
            }
        }

        if (!$this->request->post['config_product_limit']) {
            $this->error['product_limit'] = $this->language->get('errorLimit');
        }

        if (!$this->request->post['config_product_search_limit']) {
            $this->error['product_limit'] = $this->language->get('errorLimit');
        }

        if (!$this->request->post['config_limit_admin']) {
            $this->error['limit_admin'] = $this->language->get('errorLimit');
        }

        if ((utf8_strlen($this->request->post['config_encryption']) < 3) || (utf8_strlen($this->request->post['config_encryption']) > 32)) {
            $this->error['encryption'] = $this->language->get('errorEncryption');
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('errorWarning');
        }

        return !$this->error;
    }


    public function template()
    {
        if ($this->request->server['HTTPS']) {
            $server = HTTPS_CATALOG;
        } else {
            $server = HTTP_CATALOG;
        }

        if (is_file(DIR_IMAGE . 'templates/' . basename($this->request->get['template']) . '.png')) {
            $this->response->setOutput($server . 'image/templates/' . basename($this->request->get['template']) . '.png');
        } else {
            $this->response->setOutput($server . 'image/no_image.png');
        }
    }

    /**
     * TODO добавить описание метода, если он используется.
     */
    public function country()
    {
        $json = array();

        $this->load->model('localisation/country');

        $country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

        if ($country_info) {
            $this->load->model('localisation/zone');

            $json = array(
                'country_id'        => $country_info['country_id'],
                'name'              => $country_info['name'],
                'iso_code_2'        => $country_info['iso_code_2'],
                'iso_code_3'        => $country_info['iso_code_3'],
                'address_format'    => $country_info['address_format'],
                'postcode_required' => $country_info['postcode_required'],
                'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
                'status'            => $country_info['status']
            );
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}