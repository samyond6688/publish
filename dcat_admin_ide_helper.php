<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection game
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection developer
     * @property Grid\Column|Collection sign_id
     * @property Grid\Column|Collection cooperation_mode
     * @property Grid\Column|Collection cate_theme_id
     * @property Grid\Column|Collection cate_type_id
     * @property Grid\Column|Collection game_secret
     * @property Grid\Column|Collection app_sign
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection mark
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection cate_id
     * @property Grid\Column|Collection publisher_id
     * @property Grid\Column|Collection adjust_channel
     * @property Grid\Column|Collection medium_id
     * @property Grid\Column|Collection account
     * @property Grid\Column|Collection account_id
     * @property Grid\Column|Collection account_name
     * @property Grid\Column|Collection tracker
     * @property Grid\Column|Collection agent_id
     * @property Grid\Column|Collection company_id
     * @property Grid\Column|Collection owner_id
     * @property Grid\Column|Collection game_id
     * @property Grid\Column|Collection package_name_id
     * @property Grid\Column|Collection plugin_login
     * @property Grid\Column|Collection plugin_pay
     * @property Grid\Column|Collection plugin_type
     * @property Grid\Column|Collection adjust_key
     * @property Grid\Column|Collection petitioner
     * @property Grid\Column|Collection plugin_params
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection e_mark
     * @property Grid\Column|Collection plugin_use
     * @property Grid\Column|Collection params
     * @property Grid\Column|Collection company
     * @property Grid\Column|Collection site
     * @property Grid\Column|Collection admin
     * @property Grid\Column|Collection ad_name
     * @property Grid\Column|Collection adj_fb_account_id
     * @property Grid\Column|Collection adj_tracker
     * @property Grid\Column|Collection adj_app_name
     * @property Grid\Column|Collection adj_network_name
     * @property Grid\Column|Collection adj_campaign_id
     * @property Grid\Column|Collection adj_ad_id
     * @property Grid\Column|Collection adj_creative_id
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection order_id
     * @property Grid\Column|Collection product_id
     * @property Grid\Column|Collection open_id
     * @property Grid\Column|Collection package_id
     * @property Grid\Column|Collection udid
     * @property Grid\Column|Collection adid
     * @property Grid\Column|Collection role_name
     * @property Grid\Column|Collection role_level
     * @property Grid\Column|Collection game_order_id
     * @property Grid\Column|Collection pay_amout_str
     * @property Grid\Column|Collection pay_amout
     * @property Grid\Column|Collection product_amout
     * @property Grid\Column|Collection game_product_id
     * @property Grid\Column|Collection currency_type
     * @property Grid\Column|Collection pay_status
     * @property Grid\Column|Collection pay_type
     * @property Grid\Column|Collection pay_no
     * @property Grid\Column|Collection ip
     * @property Grid\Column|Collection ext
     * @property Grid\Column|Collection gg_ext
     * @property Grid\Column|Collection pay_finish_time
     * @property Grid\Column|Collection callcakc_success_time
     * @property Grid\Column|Collection created_date
     * @property Grid\Column|Collection gc_openid
     * @property Grid\Column|Collection gg_openid
     * @property Grid\Column|Collection oauth_code
     * @property Grid\Column|Collection login_type
     * @property Grid\Column|Collection last_login_ip
     * @property Grid\Column|Collection last_login_time
     *
     * @method Grid\Column|Collection game(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection developer(string $label = null)
     * @method Grid\Column|Collection sign_id(string $label = null)
     * @method Grid\Column|Collection cooperation_mode(string $label = null)
     * @method Grid\Column|Collection cate_theme_id(string $label = null)
     * @method Grid\Column|Collection cate_type_id(string $label = null)
     * @method Grid\Column|Collection game_secret(string $label = null)
     * @method Grid\Column|Collection app_sign(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection mark(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection cate_id(string $label = null)
     * @method Grid\Column|Collection publisher_id(string $label = null)
     * @method Grid\Column|Collection adjust_channel(string $label = null)
     * @method Grid\Column|Collection medium_id(string $label = null)
     * @method Grid\Column|Collection account(string $label = null)
     * @method Grid\Column|Collection account_id(string $label = null)
     * @method Grid\Column|Collection account_name(string $label = null)
     * @method Grid\Column|Collection tracker(string $label = null)
     * @method Grid\Column|Collection agent_id(string $label = null)
     * @method Grid\Column|Collection company_id(string $label = null)
     * @method Grid\Column|Collection owner_id(string $label = null)
     * @method Grid\Column|Collection game_id(string $label = null)
     * @method Grid\Column|Collection package_name_id(string $label = null)
     * @method Grid\Column|Collection plugin_login(string $label = null)
     * @method Grid\Column|Collection plugin_pay(string $label = null)
     * @method Grid\Column|Collection plugin_type(string $label = null)
     * @method Grid\Column|Collection adjust_key(string $label = null)
     * @method Grid\Column|Collection petitioner(string $label = null)
     * @method Grid\Column|Collection plugin_params(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection e_mark(string $label = null)
     * @method Grid\Column|Collection plugin_use(string $label = null)
     * @method Grid\Column|Collection params(string $label = null)
     * @method Grid\Column|Collection company(string $label = null)
     * @method Grid\Column|Collection site(string $label = null)
     * @method Grid\Column|Collection admin(string $label = null)
     * @method Grid\Column|Collection ad_name(string $label = null)
     * @method Grid\Column|Collection adj_fb_account_id(string $label = null)
     * @method Grid\Column|Collection adj_tracker(string $label = null)
     * @method Grid\Column|Collection adj_app_name(string $label = null)
     * @method Grid\Column|Collection adj_network_name(string $label = null)
     * @method Grid\Column|Collection adj_campaign_id(string $label = null)
     * @method Grid\Column|Collection adj_ad_id(string $label = null)
     * @method Grid\Column|Collection adj_creative_id(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection order_id(string $label = null)
     * @method Grid\Column|Collection product_id(string $label = null)
     * @method Grid\Column|Collection open_id(string $label = null)
     * @method Grid\Column|Collection package_id(string $label = null)
     * @method Grid\Column|Collection udid(string $label = null)
     * @method Grid\Column|Collection adid(string $label = null)
     * @method Grid\Column|Collection role_name(string $label = null)
     * @method Grid\Column|Collection role_level(string $label = null)
     * @method Grid\Column|Collection game_order_id(string $label = null)
     * @method Grid\Column|Collection pay_amout_str(string $label = null)
     * @method Grid\Column|Collection pay_amout(string $label = null)
     * @method Grid\Column|Collection product_amout(string $label = null)
     * @method Grid\Column|Collection game_product_id(string $label = null)
     * @method Grid\Column|Collection currency_type(string $label = null)
     * @method Grid\Column|Collection pay_status(string $label = null)
     * @method Grid\Column|Collection pay_type(string $label = null)
     * @method Grid\Column|Collection pay_no(string $label = null)
     * @method Grid\Column|Collection ip(string $label = null)
     * @method Grid\Column|Collection ext(string $label = null)
     * @method Grid\Column|Collection gg_ext(string $label = null)
     * @method Grid\Column|Collection pay_finish_time(string $label = null)
     * @method Grid\Column|Collection callcakc_success_time(string $label = null)
     * @method Grid\Column|Collection created_date(string $label = null)
     * @method Grid\Column|Collection gc_openid(string $label = null)
     * @method Grid\Column|Collection gg_openid(string $label = null)
     * @method Grid\Column|Collection oauth_code(string $label = null)
     * @method Grid\Column|Collection login_type(string $label = null)
     * @method Grid\Column|Collection last_login_ip(string $label = null)
     * @method Grid\Column|Collection last_login_time(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection game
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection developer
     * @property Show\Field|Collection sign_id
     * @property Show\Field|Collection cooperation_mode
     * @property Show\Field|Collection cate_theme_id
     * @property Show\Field|Collection cate_type_id
     * @property Show\Field|Collection game_secret
     * @property Show\Field|Collection app_sign
     * @property Show\Field|Collection status
     * @property Show\Field|Collection mark
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection cate_id
     * @property Show\Field|Collection publisher_id
     * @property Show\Field|Collection adjust_channel
     * @property Show\Field|Collection medium_id
     * @property Show\Field|Collection account
     * @property Show\Field|Collection account_id
     * @property Show\Field|Collection account_name
     * @property Show\Field|Collection tracker
     * @property Show\Field|Collection agent_id
     * @property Show\Field|Collection company_id
     * @property Show\Field|Collection owner_id
     * @property Show\Field|Collection game_id
     * @property Show\Field|Collection package_name_id
     * @property Show\Field|Collection plugin_login
     * @property Show\Field|Collection plugin_pay
     * @property Show\Field|Collection plugin_type
     * @property Show\Field|Collection adjust_key
     * @property Show\Field|Collection petitioner
     * @property Show\Field|Collection plugin_params
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection e_mark
     * @property Show\Field|Collection plugin_use
     * @property Show\Field|Collection params
     * @property Show\Field|Collection company
     * @property Show\Field|Collection site
     * @property Show\Field|Collection admin
     * @property Show\Field|Collection ad_name
     * @property Show\Field|Collection adj_fb_account_id
     * @property Show\Field|Collection adj_tracker
     * @property Show\Field|Collection adj_app_name
     * @property Show\Field|Collection adj_network_name
     * @property Show\Field|Collection adj_campaign_id
     * @property Show\Field|Collection adj_ad_id
     * @property Show\Field|Collection adj_creative_id
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection order_id
     * @property Show\Field|Collection product_id
     * @property Show\Field|Collection open_id
     * @property Show\Field|Collection package_id
     * @property Show\Field|Collection udid
     * @property Show\Field|Collection adid
     * @property Show\Field|Collection role_name
     * @property Show\Field|Collection role_level
     * @property Show\Field|Collection game_order_id
     * @property Show\Field|Collection pay_amout_str
     * @property Show\Field|Collection pay_amout
     * @property Show\Field|Collection product_amout
     * @property Show\Field|Collection game_product_id
     * @property Show\Field|Collection currency_type
     * @property Show\Field|Collection pay_status
     * @property Show\Field|Collection pay_type
     * @property Show\Field|Collection pay_no
     * @property Show\Field|Collection ip
     * @property Show\Field|Collection ext
     * @property Show\Field|Collection gg_ext
     * @property Show\Field|Collection pay_finish_time
     * @property Show\Field|Collection callcakc_success_time
     * @property Show\Field|Collection created_date
     * @property Show\Field|Collection gc_openid
     * @property Show\Field|Collection gg_openid
     * @property Show\Field|Collection oauth_code
     * @property Show\Field|Collection login_type
     * @property Show\Field|Collection last_login_ip
     * @property Show\Field|Collection last_login_time
     *
     * @method Show\Field|Collection game(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection developer(string $label = null)
     * @method Show\Field|Collection sign_id(string $label = null)
     * @method Show\Field|Collection cooperation_mode(string $label = null)
     * @method Show\Field|Collection cate_theme_id(string $label = null)
     * @method Show\Field|Collection cate_type_id(string $label = null)
     * @method Show\Field|Collection game_secret(string $label = null)
     * @method Show\Field|Collection app_sign(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection mark(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection cate_id(string $label = null)
     * @method Show\Field|Collection publisher_id(string $label = null)
     * @method Show\Field|Collection adjust_channel(string $label = null)
     * @method Show\Field|Collection medium_id(string $label = null)
     * @method Show\Field|Collection account(string $label = null)
     * @method Show\Field|Collection account_id(string $label = null)
     * @method Show\Field|Collection account_name(string $label = null)
     * @method Show\Field|Collection tracker(string $label = null)
     * @method Show\Field|Collection agent_id(string $label = null)
     * @method Show\Field|Collection company_id(string $label = null)
     * @method Show\Field|Collection owner_id(string $label = null)
     * @method Show\Field|Collection game_id(string $label = null)
     * @method Show\Field|Collection package_name_id(string $label = null)
     * @method Show\Field|Collection plugin_login(string $label = null)
     * @method Show\Field|Collection plugin_pay(string $label = null)
     * @method Show\Field|Collection plugin_type(string $label = null)
     * @method Show\Field|Collection adjust_key(string $label = null)
     * @method Show\Field|Collection petitioner(string $label = null)
     * @method Show\Field|Collection plugin_params(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection e_mark(string $label = null)
     * @method Show\Field|Collection plugin_use(string $label = null)
     * @method Show\Field|Collection params(string $label = null)
     * @method Show\Field|Collection company(string $label = null)
     * @method Show\Field|Collection site(string $label = null)
     * @method Show\Field|Collection admin(string $label = null)
     * @method Show\Field|Collection ad_name(string $label = null)
     * @method Show\Field|Collection adj_fb_account_id(string $label = null)
     * @method Show\Field|Collection adj_tracker(string $label = null)
     * @method Show\Field|Collection adj_app_name(string $label = null)
     * @method Show\Field|Collection adj_network_name(string $label = null)
     * @method Show\Field|Collection adj_campaign_id(string $label = null)
     * @method Show\Field|Collection adj_ad_id(string $label = null)
     * @method Show\Field|Collection adj_creative_id(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection order_id(string $label = null)
     * @method Show\Field|Collection product_id(string $label = null)
     * @method Show\Field|Collection open_id(string $label = null)
     * @method Show\Field|Collection package_id(string $label = null)
     * @method Show\Field|Collection udid(string $label = null)
     * @method Show\Field|Collection adid(string $label = null)
     * @method Show\Field|Collection role_name(string $label = null)
     * @method Show\Field|Collection role_level(string $label = null)
     * @method Show\Field|Collection game_order_id(string $label = null)
     * @method Show\Field|Collection pay_amout_str(string $label = null)
     * @method Show\Field|Collection pay_amout(string $label = null)
     * @method Show\Field|Collection product_amout(string $label = null)
     * @method Show\Field|Collection game_product_id(string $label = null)
     * @method Show\Field|Collection currency_type(string $label = null)
     * @method Show\Field|Collection pay_status(string $label = null)
     * @method Show\Field|Collection pay_type(string $label = null)
     * @method Show\Field|Collection pay_no(string $label = null)
     * @method Show\Field|Collection ip(string $label = null)
     * @method Show\Field|Collection ext(string $label = null)
     * @method Show\Field|Collection gg_ext(string $label = null)
     * @method Show\Field|Collection pay_finish_time(string $label = null)
     * @method Show\Field|Collection callcakc_success_time(string $label = null)
     * @method Show\Field|Collection created_date(string $label = null)
     * @method Show\Field|Collection gc_openid(string $label = null)
     * @method Show\Field|Collection gg_openid(string $label = null)
     * @method Show\Field|Collection oauth_code(string $label = null)
     * @method Show\Field|Collection login_type(string $label = null)
     * @method Show\Field|Collection last_login_ip(string $label = null)
     * @method Show\Field|Collection last_login_time(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
