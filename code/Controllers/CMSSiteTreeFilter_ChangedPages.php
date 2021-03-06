<?php

namespace SilverStripe\CMS\Controllers;

use SilverStripe\ORM\Versioning\Versioned;

/**
 * Gets all pages which have changed on stage.
 *
 * @package cms
 * @subpackage content
 */
class CMSSiteTreeFilter_ChangedPages extends CMSSiteTreeFilter
{

	static public function title()
	{
		return _t('CMSSiteTreeFilter_ChangedPages.Title', "Modified pages");
	}

	public function getFilteredPages()
	{
		$pages = Versioned::get_by_stage('SilverStripe\\CMS\\Model\\SiteTree', 'Stage');
		$pages = $this->applyDefaultFilters($pages)
			->leftJoin('SiteTree_Live', '"SiteTree_Live"."ID" = "SiteTree"."ID"')
			->where('"SiteTree"."Version" <> "SiteTree_Live"."Version"');
		return $pages;
	}
}
