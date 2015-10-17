(function($) {
	'use strict';
	/**
	 * Recipes module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Recipes
	 * @extends Tc.Module
	 */
	Tc.Module.Recipes = Tc.Module.extend({

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			this.bindAll(
				'onGetRecipesSuccess',
				'onGetRecipesError'
			);
			this.getRecipes();
			// do not remove
			callback();
		},

		after: function() {
		},

		getRecipes: function() {
			$.ajax({
				url: this.$ctx.data('url'),
				success: this.onGetRecipesSuccess,
				error: this.onGetRecipesError
			});
		},

		onGetRecipesSuccess: function(data) {
			this.$('.js-recipe-list-container').html(this.template(this.$('#recipe-list-template').html(), data));
			this.$ctx.trigger('rendered');
		},

		onGetRecipesError: function(err) {
			console.log('err', err);
		}

	});
}(Tc.$));
