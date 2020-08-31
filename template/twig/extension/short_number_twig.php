<?php
/**
 * phpBB Extension - toxyy Short Number Twig Extension
 *
 * @copyright (c) 2020 toxyy <thrashtek@yahoo.com>
 * @license       GNU General Public License, version 2 (GPL-2.0)
 */

namespace toxyy\shortnumbertwig\template\twig\extension;

class short_number_twig extends \Twig_Extension
{
	/** @var \phpbb\language\language $language */
	protected $language;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\language $language Language object
	 */
	public function __construct(\phpbb\language\language $language)
	{
		$this->language = $language;
	}

	/**
	 * Get the name of this extension
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'short_number_ext';
	}

	/**
	 * Returns a list of global functions to add to the existing list.
	 *
	 * @return array An array of global functions
	 */
	public function getFunctions()
	{
		return array(
			new \Twig\TwigFunction('short_number_ext', array($this, 'number_format_short')),
		);
	}

	// credit to RadGH, hassanamirkhan and others @ https://gist.github.com/RadGH/84edff0cc81e6326029c
	function number_format_short($n)
	{
		if ($n >= 0 && $n < 10000)
		{
			// 1 - 9999
			$n_format = floor($n);
			$suffix = '';
		}
		else if ($n >= 10000 && $n < 1000000)
		{
			// 10k-999k
			$n_format = floor($n / 1000);
			$suffix = $this->language->lang('THOUSAND_SHORT_SUFFIX');
		}
		else if ($n >= 1000000 && $n < 1000000000)
		{
			// 1m-999m
			$n_format = floor($n / 1000000);
			$suffix = $this->language->lang('MILLION_SHORT_SUFFIX');
		}
		else if ($n >= 1000000000 && $n < 1000000000000)
		{
			// 1b-999b
			$n_format = floor($n / 1000000000);
			$suffix = $this->language->lang('BILLION_SHORT_SUFFIX');
		}
		else if ($n >= 1000000000000)
		{
			// 1t+
			$n_format = floor($n / 1000000000000);
			$suffix = $this->language->lang('TRILLION_SHORT_SUFFIX');
		}
		$temp = $n_format . $suffix;
		return !empty($temp) ? $n_format . $suffix : 0;
	}
}
