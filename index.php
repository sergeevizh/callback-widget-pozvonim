<?php
/*
Plugin Name: Callback widget Pozvonim
Plugin URI: https://github.com/systemo-biz/callback-widget-pozvonim
Description: Правильная интеграция виджета обратного звонка Pozvonim.com для сайта на WordPress
Author: Systemo
Author URI: http://systemo.biz/
Version: 20151220
*/


class PozvonimWidgetS
{

  function __construct()
  {
    //Добавляем страницу настроек
    add_action( 'admin_init', function(){
    	add_settings_section(
    		'pozvonim_script_section',
    		'Настройка обратного звонка от Pozvonim.com',
    		array($this, 'pozvonim_script_section_callback'),
    		'discussion'
    	);

      register_setting( 'discussion', 'pozvonim_script');

    	add_settings_field(
    		'pozvonim_script',
    		'Введите скрипт от Pozvonim.com',
    		array($this, 'pozvonim_script_field_callback'),
    		'discussion',
    		'pozvonim_script_section'
    	);

    });

    add_action( 'wp_footer', array($this, 'wp_footer_add_pozvonim'), $priority = 10);

    $pluginurl = plugin_basename(__FILE__);
    add_filter("plugin_action_links_$pluginurl", array($this,'add_settings_link_to_pozvonim_script_plugins'));

  }


  function pozvonim_script_section_callback(){
    ?>
    <p id="pozvonim-instruction">Получите 1 000 руб на баланс при регистрации по ссылке <a href="http://pozvonim.com/?i=6872321679" target="_blank">pozvonim.com с бонусом от Системо</a></p>
    <p>Скрипт для вставки в это поле, можно получить на сайте Pozvonim.com в личном кабинете (<a href="https://my.pozvonim.com/" target="_blank">раздел Старт</a>)</p>
    <?php
  }


  function pozvonim_script_field_callback() {
    $option = esc_html(get_option( 'pozvonim_script'));
    ?>
  	 <input name="pozvonim_script" type="text" value="<?php echo $option ?>" size="100">
    <?php
  }

  function wp_footer_add_pozvonim(){
    $pozvonim_script = get_option( 'pozvonim_script' );
    if($pozvonim_script) echo $pozvonim_script;
  }



  // Add settings link to wordpress plugin page
  function add_settings_link_to_pozvonim_script_plugins($links) {

    $settings_link = '<a href="' . admin_url( 'options-discussion.php#pozvonim-instruction') .'">Настройки</a>';
    array_unshift($links, $settings_link);
    return $links;
  }


}
$ThePozvonimWidgetS = new PozvonimWidgetS;
