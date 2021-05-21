<?php
class Iqwik {

    public function __construct() {
        $this->init();
    }

    protected function init() {
        $this->set_global_variables();
        $this->enable_smtp_phpmailer();
        WordpressCore::clear();
        JsFilesRules::set();
    }

    protected function set_global_variables() {
        define('TEMPLATE_URL', get_template_directory_uri());
        define('SITE_URL', get_site_url());
        define('SITE_NAME', get_bloginfo('name'));
        define('ADMIN_EMAIL', get_option('admin_email'));
        define('TEMPLATE_PARTS', get_template_directory() . '/templates/_parts/');
        define('TEMPLATE_CORE', get_template_directory() . '/core/');
    }

    protected function enable_smtp_phpmailer() {
        add_action('phpmailer_init', function($phpmailer) {
            $phpmailer->isSMTP();
            $phpmailer->Host       = SMTP_HOST;
            $phpmailer->SMTPAuth   = SMTP_AUTH;
            $phpmailer->Port       = SMTP_PORT;
            $phpmailer->Username   = SMTP_USER;
            $phpmailer->Password   = SMTP_PASS;
            $phpmailer->SMTPSecure = SMTP_SECURE;
            $phpmailer->From       = SMTP_FROM;
            $phpmailer->FromName   = SMTP_NAME;
            $phpmailer->SMTPDebug  = SMTP_DEBUG;
        });
    }
}
