<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

if (! class_exists('AdminPageFramework_Registry', false)) :
abstract class AdminPageFramework_Registry_Base {
    const VERSION = '3.9.1';
    const NAME = 'Admin Page Framework';
    const DESCRIPTION = 'Facilitates WordPress plugin and theme development.';
    const URI = 'https://en.michaeluno.jp/admin-page-framework';
    const AUTHOR = 'Michael Uno';
    const AUTHOR_URI = 'https://en.michaeluno.jp/';
    const COPYRIGHT = 'Copyright (c) 2013-2022, Michael Uno';
    const LICENSE = 'MIT <https://opensource.org/licenses/MIT>';
    const CONTRIBUTORS = '';
}
final class AdminPageFramework_Registry extends AdminPageFramework_Registry_Base {
    const TEXT_DOMAIN = 'admin-page-framework';
    const TEXT_DOMAIN_PATH = '/language';
    public static $bIsMinifiedVersion = true;
    public static $bIsDevelopmentVersion = true;
    public static $sAutoLoaderPath;
    public static $sClassMapPath;
    public static $aClassFiles = array();
    public static $sFilePath = '';
    public static $sDirPath = '';
    public static function setUp($sFilePath=__FILE__)
    {
        self::$sFilePath = $sFilePath;
        self::$sDirPath = dirname(self::$sFilePath);
        self::$sClassMapPath = self::$sDirPath . '/admin-page-framework-class-map.php';
        self::$aClassFiles = include(self::$sClassMapPath);
        self::$sAutoLoaderPath = isset(self::$aClassFiles[ 'AdminPageFramework_RegisterClasses' ]) ? self::$aClassFiles[ 'AdminPageFramework_RegisterClasses' ] : '';
        self::$bIsMinifiedVersion = class_exists('AdminPageFramework_MinifiedVersionHeader', false);
        self::$bIsDevelopmentVersion = isset(self::$aClassFiles[ 'AdminPageFramework_ClassMapHeader' ]);
    }
    public static function getVersion()
    {
        if (! isset(self::$sAutoLoaderPath)) {
            trigger_error(self::NAME . ': ' . ' : ' . sprintf('The method, <code>%1$s</code>, is called too early. Perform <code>%2$s</code> earlier.', __METHOD__, 'setUp()'), E_USER_WARNING);
            return self::VERSION;
        }
        $_aMinifiedVersionSuffix = array( 0 => '', 1 => '.min', );
        $_aDevelopmentVersionSuffix = array( 0 => '', 1 => '.dev', );
        return self::VERSION . $_aMinifiedVersionSuffix[ ( integer ) self::$bIsMinifiedVersion ] . $_aDevelopmentVersionSuffix[ ( integer ) self::$bIsDevelopmentVersion ];
    }
    public static function getInfo()
    {
        $_oReflection = new ReflectionClass(__CLASS__);
        return $_oReflection->getConstants() + $_oReflection->getStaticProperties();
    }
}
endif;
if (! class_exists('AdminPageFramework_Bootstrap', false)) :
final class AdminPageFramework_Bootstrap {
    private static $___bLoaded = false;
    public function __construct($sLibraryPath)
    {
        if (! $this->___isLoadable()) {
            return;
        }
        AdminPageFramework_Registry::setUp($sLibraryPath);
        if (AdminPageFramework_Registry::$bIsMinifiedVersion) {
            return;
        }
        $this->___include();
    }
    private function ___isLoadable()
    {
        if (self::$___bLoaded) {
            return false;
        }
        self::$___bLoaded = true;
        return defined('ABSPATH');
    }
    private function ___include()
    {
        include(AdminPageFramework_Registry::$sAutoLoaderPath);
        new AdminPageFramework_RegisterClasses('', array( 'exclude_class_names' => array( 'AdminPageFramework_MinifiedVersionHeader', 'AdminPageFramework_BeautifiedVersionHeader', ), ), AdminPageFramework_Registry::$aClassFiles);
        self::$___bXDebug = isset(self::$___bXDebug) ? self::$___bXDebug : extension_loaded('xdebug');
        if (self::$___bXDebug) {
            new AdminPageFramework_Utility;
            new AdminPageFramework_WPUtility;
        }
    }
    private static $___bXDebug;
} new AdminPageFramework_Bootstrap(__FILE__);
endif;





class APF_MyFirstFrom extends AdminPageFramework {

    static function verify_envato_purchase_code($code_to_verify) {
		// Your Username
		$username = 'alisaleem252';

		// Set API Key
		$api_key = '0xnzwrrd4y7md0vnk6f11mpz0rqlnbfh';

		// Open cURL channel
		$ch = curl_init();

		// Set cURL options
		curl_setopt($ch, CURLOPT_URL, "http://marketplace.envato.com/api/edge/". $username ."/". $api_key ."/verify-purchase:". $code_to_verify .".json");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		   //Set the user agent
		   $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
		   curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		// Decode returned JSON
		$output = json_decode(curl_exec($ch), true);

		// Close Channel
		curl_close($ch);

		if(isset($purchase_data['verify-purchase']['buyer']))
			return true;
			else
			return false;
		// Return output
	//	return $output;
	}


	public function setUp() {
        //	$dirs = array_filter(glob(MHDESKABSPATH.'/themes/*'), 'is_dir');
    
    
    
            $this->setRootMenuPage( 'Helpdesks' , 'dashicons-id-alt');    // create a root page
    //        $this->addSubMenuItem(
    //            array(
    //                'title'        => 'Envato',
    //                'page_slug'    => 'm_helpdesk_form_envato'
    //            )
    //        );
            $this->addSubMenuItem(
                array(
                    'title'        => 'Configure Helpdesk',
                    'page_slug'    => 'm_helpdesk_form'
                )
            );
            $this->addSubMenuItem(
                array(
                    'title'        => 'Email Settings',
                    'page_slug'    => 'm_helpdesk_form_email'
                )
            );
            $this->addSubMenuItem(
            array(
                    'title'        => 'Get Premium',
                    'href'    => 'https://webostock.com/market-item/multi-helpdesk-ticket-system-pro/31392/',
                    'target'  => '_blank'
                )
            );
    
        }

	    /**
     * The pre-defined callback method that is triggered when the page loads.
     */
    public function load_m_helpdesk_form_envato( $oAdminPage ) {    // load_{page slug}
		$this->addSettingSections(
            array(
                'section_id'    => 'm_helpdesk_form_envato',
                'page_slug'     => 'm_helpdesk_form_envato',
            )
        );

        $this->addSettingFields(
            array(
                'field_id'      => 'helpdesk_envato',
                'section_id'    => 'm_helpdesk_form_envato',
                'title'         => 'Purchase Code',
                'type'          => 'text',
                'default'       => '',
				'description'   => 'How to get my purchase code? <a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">Click Here</a>',
            	),
            array(
                'field_id'      => 'submit',
                'type'          => 'submit',
            )
			);
	}
    /**
     * The pre-defined callback method that is triggered when the page loads.
     */
    public function load_m_helpdesk_form( $oAdminPage ) {    // load_{page slug}


		global $hd_admin_settings_arr;
		$purchase_code = isset($hd_admin_settings_arr['m_helpdesk_form_envato']['helpdesk_envato']);
		//if(!$this->verify_envato_purchase_code($purchase_code))
		//return;
	
		$themes = array();

		foreach (new DirectoryIterator(MHDESKABSPATH.'/themes/') as $file) {
			if ($file->isDir() && !$file->isDot()) {
				$themes[$file->getFilename()] = $file->getFilename();
			}
		}

        $this->addSettingSections(
            array(
                'section_id'    => 'm_helpdesk_form',
                'page_slug'     => 'm_helpdesk_form',
            )
        );

        $this->addSettingFields(
            array(
                'field_id'      => 'helpdesk_name',
                'section_id'    => 'm_helpdesk_form',
                'title'         => 'Helpdesk Name',
                'type'          => 'text',
                'default'       => get_bloginfo('name'),
            ),
			 array(
                'field_id'      => 'helpdesk_administration',
                'type'          => 'checkbox',
                'title'         => 'Helpdesk Administration',
                'description'   => 'Only Administrator user role/type can create Helpdesk/ Company? If yes, then checked this option'
            ), array(
                'field_id'      => 'helpdesk_rewriterule_slug',
                'type'          => 'text',
                'title'         => 'Helpdesk Initial Web Slug',
                'description'   => 'Note: This slug must be a single word without any space at start or in end. e.g. helpdesk or support or company. Ref: site.com/helpdesk/shoppingmart/admin/ OR site.com/support/shoppingmart/admin/',
				'default'       => 'company'
            ),
			 array(
                'field_id'      => 'helpdesk_number',
                'type'          => 'number',
                'title'         => 'Number of Helpdesks',
                'description'   => 'Number of Helpdesks allowed to create per user, 0 means unlimited',
                'default'       => 0,
            ),
			 array(
                'field_id'      => 'helpdesk_agents',
                'type'          => 'number',
                'title'         => 'Number of Agents',
                'description'   => 'Number of Agents allowed per helpdesk, 0 means unlimited',
                'default'       => 0,
            ),
			array(
                'field_id'      => 'helpdesk_tickets',
                'type'          => 'number',
                'title'         => 'Number of Tickets',
                'description'   => 'Number of Tickets allowed per helpdesk, 0 means unlimited',
                'default'       => 0,
            ),
			array(
                'field_id'      => 'helpdesk_customers',
                'type'          => 'number',
                'title'         => 'Number of Customers',
                'description'   => 'Number of Customers allowed per helpdesk, 0 means unlimited',
                'default'       => 0,
            ),
			array(
                'field_id'      => 'helpdesk_theme',
                'type'          => 'select',
                'title'         => 'Select Theme',
                'description'   => 'You can change theme here if you have more than one',
                'default'       => 0,
				'label'			=> $themes
            ),
			array(
                'field_id'      => 'helpdesk_boostrap',
                'type'          => 'checkbox',
                'title'         => 'Enable Bootstrap',
                'description'   => 'If your theme already have a bootstrap then uncheck this option',
                'default'       => true,
            ),
			array(
                'field_id'      => 'helpdesk_subdomains',
                'type'          => 'checkbox',
                'title'         => 'Enable Subdomains',
                'description'   => 'This will give each helpdesk a dedicated subdomain. e.g. site.com/envato/ to envato.site.com',
                'default'       => true,
            ),
            array(
                'field_id'      => 'submit',
                'type'          => 'submit',
				
            )
        );

    }

	/**
     * The pre-defined callback method that is triggered when the page loads.
     */
    public function load_m_helpdesk_form_email( $oAdminPage ) {    // load_{page slug}
		global $hd_admin_settings_arr;
		$purchase_code = isset($hd_admin_settings_arr['m_helpdesk_form_envato']['helpdesk_envato']);
		//if(!$this->verify_envato_purchase_code($purchase_code))
		//return;

        $this->addSettingSections(
            array(
                'section_id'    => 'm_helpdesk_form_email',
                'page_slug'     => 'm_helpdesk_form_email',
            )
        );

        $this->addSettingFields(
            array(
                'field_id'      => 'helpdesk_from_name',
                'section_id'    => 'm_helpdesk_form_email',
                'title'         => 'From Name',
                'type'          => 'text',
                'default'       => get_bloginfo('name'),
            ),
			 array(
                'field_id'      => 'helpdesk_from_email',
                'type'          => 'email',
                'title'         => 'From Email',
                'description'   => 'All Notifications will be sent using this name',
                'default'       => get_bloginfo('admin_email'),
            ),
			array(
                'field_id'      => 'helpdesk_email_welcome',
                'type'          => 'textarea',
                'title'         => 'Welcome Email to Company',
                'description'   => 'Welcome Email will be sent when new Copmany Added, tag: {company} tag: {companyurl}',
                'default'       => 'Welcome to '.get_bloginfo('name').' Your Company {company} has been Added',
            ),
			array(
                'field_id'      => 'helpdesk_email_footer',
                'type'          => 'textarea',
                'title'         => 'Email Footer',
                'description'   => 'Email Footer here you can add your Website link',
                'default'       => 'Sincerely,<br>Gigsix Help Desk <span class="il">Support</span> Team</p>',
            ),

            array(
                'field_id'      => 'submit',
                'type'          => 'submit',
            )
        );


    }

}