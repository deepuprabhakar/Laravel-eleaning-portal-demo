<?php namespace App;

use Landish\Pagination\Simple\Pagination as BasePagination;

class Pagination extends BasePagination {

	/**
	 * Pagination wrapper HTML.
	 *
	 * @var string
	 */
	protected $paginationWrapper = '<span class="">%s %s %s</span>';

	/**
	 * Available page wrapper HTML.
	 *
	 * @var string
	 */
	protected $availablePageWrapper = '<a href="%s" class="btn btn-default btn-sm">%s</a>';

	/**
	 * Get active page wrapper HTML.
	 *
	 * @var string
	 */
	protected $activePageWrapper = '<a class="active btn btn-default btn-sm">%s</a>';

	/**
	 * Get disabled page wrapper HTML.
	 *
	 * @var string
	 */
	protected $disabledPageWrapper = '<a class="disabled btn btn-default btn-sm">%s</a>';

	/**
	 * Previous button text.
	 *
	 * @var string
	 */
	protected $previousButtonText = '<i class="fa fa-chevron-left"></i>';

	/**
	 * Next button text.
	 *
	 * @var string
	 */
	protected $nextButtonText = '<i class="fa fa-chevron-right"></i>';

	/***
	 * "Dots" text.
	 *
	 * @var string
	 */
	protected $dotsText = '...';

}