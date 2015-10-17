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
			this.renderMenu();
			// do not remove
			callback();
		},

		after: function() {
		},

		renderMenu: function() {
			if(this.$ctx.data('is-admin')){
				this.$('.js-admin-menu-container').html(this.template(this.$('#admin-menu-template').html()));
			}
		}

	});
}(Tc.$));
