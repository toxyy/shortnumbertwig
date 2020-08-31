<?php
/**
 * phpBB Extension - toxyy Short Number Twig Extension
 *
 * @copyright (c) 2020 toxyy <thrashtek@yahoo.com>
 * @license       GNU General Public License, version 2 (GPL-2.0)
 */

namespace toxyy\shortnumbertwig\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\language\language $language Language object */
	protected $language;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language $language Language object
	 */
	public function __construct(\phpbb\language\language $language)
	{
		$this->language = $language;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.user_setup' => 'core_user_setup',
		];
	}

	public function core_user_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name' => 'toxyy/shortnumbertwig',
			'lang_set' => 'common',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}
}
