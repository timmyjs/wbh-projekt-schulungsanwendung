(function($) {
	'use strict';
	/**
	 * Ingredients module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Ingredients
	 * @extends Tc.Module
	 */
	Tc.Module.Ingredients = Tc.Module.extend({
		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			this.bindAll(
				'onGetDataSuccess',
				'onGetDataError'
			);
			this.getData();
			// do not remove
			callback();
		},

		after: function() {
		},

		getData: function() {
			$.ajax({
				url: this.$ctx.data('url'),
				success: this.onGetDataSuccess,
				error: this.onGetDataError
			});
		},

		onGetDataSuccess: function(data) {
			this.$('.js-ingredients-table').html(this.template(this.$('#ingredients-table-template').html(), data));
		},

		onGetDataError: function(err) {
			console.log('err', err);
		}

	});
}(Tc.$));
