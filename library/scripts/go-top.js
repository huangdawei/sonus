/*
Author: mg12
Update: 2012/05/04
Author URI: http://www.neoease.com/
*/

GoTop = function() {

	this.config = {
		pageWidth			:960,		
		nodeId				:'go-top',	
		nodeWidth			:50,		
		distanceToBottom	:120,		
		distanceToPage		:20,		
		hideRegionHeight	:90,		
		text				:'TOP'	
	};

	this.cache = {
		topLinkThread		:null		//(用于 IE6)Display the variable of thread for Go Top node (for IE6)
	}
};

GoTop.prototype = {

	init: function(config) {
		this.config = config || this.config;
		var _self = this;

		// modify the position during scroll
		jQuery(window).scroll(function() {
			_self._scrollScreen({_self:_self});
		});

		// modify the position when screen size changed
		jQuery(window).resize(function() {
			_self._resizeWindow({_self:_self});
		});

		// insert the node
		_self._insertNode({_self:_self});
	},

	/**
	 * insert the node
	 */
	_insertNode: function(args) {
		var _self = args._self;

		// insert the node and set the event
		var topLink = jQuery('<a id="' + _self.config.nodeId + '" href="#">' + _self.config.text + '</a>');
		topLink.appendTo(jQuery('body'));
		if(jQuery.scrollTo) {
			topLink.click(function() {
				jQuery.scrollTo({top: 0}, 500);
				return false;
			});
		}

		// distance to the right
		var right = _self._getDistanceToBottom({_self:_self});

		// style for IE6 (do not support position:fixed)
		if(/MSIE 6/i.test(navigator.userAgent)) {
			topLink.css({
				'display': 'none',
				'position': 'absolute',
				'right': right + 'px'
			});

		// for other browsers
		} else {
			topLink.css({
				'display': 'none',
				'position': 'fixed',
				'right': right + 'px',
				'top': (jQuery(window).height() - _self.config.distanceToBottom) + 'px'
			});
		}
	},

	/**
	 * update the position and status
	 */
	_scrollScreen: function(args) {
		var _self = args._self;

		// hide the node when on the top
		var topLink = jQuery('#' + _self.config.nodeId);
		if(jQuery(document).scrollTop() <= _self.config.hideRegionHeight) {
			clearTimeout(_self.cache.topLinkThread);
			topLink.hide();
			return;
		}

		// display the node when not on the top (for IE6)
		if(/MSIE 6/i.test(navigator.userAgent)) {
			clearTimeout(_self.cache.topLinkThread);
			topLink.hide();

			_self.cache.topLinkThread = setTimeout(function() {
				var top = jQuery(document).scrollTop() + jQuery(window).height() - _self.config.distanceToBottom;
				topLink.css({'top': top + 'px'}).fadeIn();
			}, 400);

		// for other browsers
		} else {
			topLink.fadeIn();
		}
	},

	/**
	 * update the postion
	 */
	_resizeWindow: function(args) {
		var _self = args._self;

		var topLink = jQuery('#' + _self.config.nodeId);

		// distance to the right of window
		var right = _self._getDistanceToBottom({_self:_self});

		// distance to the top of window
		var top = jQuery(window).height() - _self.config.distanceToBottom;
		// use distance to the top of page instead in IE6
		if(/MSIE 6/i.test(navigator.userAgent)) {
			top += jQuery(document).scrollTop();
		}

		// update the position
		topLink.css({
			'right': right + 'px',
			'top': top + 'px'
		});
	},

	/**
	 * get the distance to the right of window
	 */
	_getDistanceToBottom: function(args) {
		var _self = args._self;

		// the distance to the right of window = (width of screen - width of page + 1)/2 - width of node - distance from left of node to left of page (20px), 
		
		var right = parseInt((jQuery(window).width() - _self.config.pageWidth + 1)/2 - _self.config.nodeWidth - _self.config.distanceToPage, 10);
		if(right < 10) {
			right = 10;
		}

		return right;
	}
};