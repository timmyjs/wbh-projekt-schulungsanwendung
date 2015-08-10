(function($) {
	'use strict';
	/**
	 * Menu module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Menu
	 * @extends Tc.Module
	 */
	Tc.Module.Menu = Tc.Module.extend({

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			this.bindAll(
				'onGetUserDataSuccess',
				'onGetUserDataError'
			);
			this.getUserData();
			// do not remove
			callback();
		},

		after: function() {
		},

		getUserData: function() {
			$.ajax({
				url: this.$ctx.data('url'),
				success: this.onGetUserDataSuccess,
				error: this.onGetUserDataError
			});
		},

		onGetUserDataSuccess: function(data) {
			if(data.role === 'admin'){
				this.$('.js-admin-menu-container').html(this.template(this.$('#admin-menu-template').html(), data));
			}
		},

		onGetUserDataError: function(err) {
			this.$('.js-admin-menu-container').remove();
			console.log('err', err);
		}

	});
}(Tc.$));
