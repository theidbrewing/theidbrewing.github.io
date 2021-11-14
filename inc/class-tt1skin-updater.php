<?php
/**
 * Class tt1skin Updater
 *
 * The file that defines the skin updater
 *
 * @package tt1skin
 */

if ( ! class_exists( 'TT1skin_Updater' ) ) {
    /**
     * TT1skin Updater
     */
    class TT1skin_Updater {

        public static function init() {
            add_filter( 'pre_set_site_transient_update_plugins', [ get_called_class(), 'updater' ] );
        }

        public static function updater( $transient ) {
            $plugin_data = get_plugin_data( plugin_dir_path( dirname( __FILE__ ) ) . 'tt1skin.php' );
            $plugin_version = $plugin_data['Version'];
            if ( empty( trim( $plugin_version ) ) ) {
                $plugin_version = '0.0.1';
            }
            //TODO: remoteのskin.jsonから取る
            $skin_data = TT1skin_Skin_Data::get_instance()->get_skin_data();
            $skin_version = $skin_data['version'];
            if ( empty( trim( $skin_version ) ) ) {
                $skin_version = '0.0.1';
            }
            if ( version_compare( $plugin_version, $skin_version, '<' ) ) {
                $plugin_base_name = plugin_basename( dirname( dirname( __FILE__ ) ) );
                $transient->response[  $plugin_base_name . '/tt1skin.php' ] = (object) [
                    'id'        => $plugin_base_name . '/tt1skin.php',
                    'new_version' => $skin_version,
                    'url'         => 'https://theidbrewing.github.io/',
                    'package'     => 'https://theidbrewing.github.io/dist/tt1skin-' . $skin_data['name'] . '.zip',
                    'compatibility' => new stdClass(),
                ];
            }
            return $transient;
        }
    }
}
