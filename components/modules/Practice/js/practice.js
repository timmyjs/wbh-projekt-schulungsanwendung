(function($) {
	'use strict';
	/**
	 * Practice module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Practice
	 * @extends Tc.Module
	 */
	Tc.Module.Practice = Tc.Module.extend({
		ingredients: [],

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			this.bindAll(
				'onGetNewRecipeSuccess',
				'onGetNewRecipeError',
				'onGetIngredientsSuccess',
				'onGetIngredientsError',
				'onAddIngredient',
				'onRemoveIngredient',
				'onSubmitPracticeForm',
				'onSubmitPracticeFormSuccess',
				'onSubmitPracticeFormError',
				'updateIngredientList'
			);
			this.$ctx.on('updateIngredients', this.updateIngredientList);
			this.$('.js-practice-form').on('submit', this.onSubmitPracticeForm);
			this.getIngredients();
			this.getNewRecipe();
			// do not remove
			callback();
		},

		after: function() {
		},

		getIngredients: function() {
			$.ajax({
				url: this.$ctx.data('service-ingredients'),
				success: this.onGetIngredientsSuccess,
				error: this.onGetIngredientsError
			});
		},

		onGetIngredientsSuccess: function(data) {
			var group,
				that = this,
				$container = this.$('.js-ingredients-container'),
				markup = this.$('#ingredients-template').html();

			data.ingredients.forEach(function(el, i, arr) {
				group = arr.filter(function(item) {
					return parseInt(item.xPos) === parseInt(i);
				});
				group = group.sort(function(a, b) {
					return ((a.yPos < b.yPos) ? -1 : ((a.yPos > b.yPos) ? 1 : 0));
				});
				if(group.length) $container.append(that.template(markup, { group: group }));
			});

			$container.find('.js-add-ingredient').on('click', this.onAddIngredient);
		},

		onGetIngredientsError: function(err) {
			console.log('error', err);
		},

		getNewRecipe: function() {
			$.ajax({
				url: this.$ctx.data('service-new-recipe'),
				success: this.onGetNewRecipeSuccess,
				error: this.onGetNewRecipeError
			});
		},

		onGetNewRecipeSuccess: function(data) {
			this.$('.js-insert-recipe').text(data.name);
		},

		onGetNewRecipeError: function(err) {
			console.log('error', err);
		},

		onAddIngredient: function(ev) {
			var ingredient = $(ev.currentTarget).text();

			if(this.ingredients.indexOf(ingredient) === -1){
				this.ingredients.push(ingredient);
				this.$ctx.trigger('updateIngredients');
			}
		},

		onRemoveIngredient: function(ev) {
			var ingredient = $(ev.currentTarget).text(),
				index = this.ingredients.indexOf(ingredient);

			this.ingredients.splice(index, 1);
			this.$ctx.trigger('updateIngredients');
		},

		onSubmitPracticeForm: function(ev) {
			ev.preventDefault();
			var $form = $(ev.currentTarget);
			$.ajax({
				url: $form.attr('action'),
				method: $form.attr('method'),
				// data: { "item": "test" },
				success: this.onSubmitPracticeFormSuccess,
				error: this.onSubmitPracticeFormError
			});
		},

		onSubmitPracticeFormSuccess: function(data) {
			console.log('onSubmitPracticeFormSuccess');
			if(data.success){
				console.log('success');
				this.getNewRecipe();
			}
		},

		onSubmitPracticeFormError: function(err) {
			console.log('error', err);
		},

		updateIngredientList: function() {
			var data = { ingredients: this.ingredients },
				$container = this.$('.js-ingredient-list-container');

			$container
				.html(this.template(this.$('#ingredient-list-template').html(), data))
				.find('.js-remove-ingredient').off().on('click', this.onRemoveIngredient);
		}

	});
}(Tc.$));
