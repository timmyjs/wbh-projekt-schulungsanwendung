(function($) {
	'use strict';
	/**
	 * Layout module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Layout
	 * @extends Tc.Module
	 */
	Tc.Module.Layout = Tc.Module.extend({

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			this.$('.js-logout').on('click', this.onClickLogout);
			callback();
		},

		after: function() {
		},

		onClickLogout: function() {
			document.location.href = '/project/services/logout.php';
		}

	});
}(Tc.$));
