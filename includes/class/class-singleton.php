<?php
/**
 * Base class for singleton.
 *
 * @author     Rahul Aryan <support@rahularyan.com>
 * @copyright  2014 AnsPress.io & Rahul Aryan
 * @license    GPL-3.0+ https://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://anspress.io
 * @package    AnsPress
 * @since      4.1.8
 */

namespace AnsPress;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * A class to be used as a base for all singleton classes.
 *
 * @since 4.1.8
 */
class Singleton {
	/**
	 * Refers to a single instance of this class.
	 *
	 * @var null|object
	 * @since 4.1.8
	 */
	public static $instance = null;

	/**
	 * Cloning is forbidden.
	 *
	 * @return void
	 * @since 4.1.8
	 */
	private function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'anspress-question-answer' ), '1.0.0' ); // WPCS: xss okay.
	}

	/**
	 * Class constructor must be protected.
	 *
	 * @since 4.1.8
	 */
	protected function __construct() {
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 4.1.8
	 */
	private function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'anspress-question-answer' ), '1.0.0' ); // WPCS: xss okay.
	}

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @return AnsPress\Singleton A single instance of this class.
	 * @since 4.1.8
	 */
	final public static function init() {
		if ( ! isset( static::$instance ) ) {
				static::$instance = new static();
		}

		return static::$instance;
	}
}