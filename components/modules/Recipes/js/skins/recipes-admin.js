(function($) {
	'use strict';
	/**
	 * Admin skin implementation for the Recipes module.
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module.Recipes
	 * @class Admin
	 * @extends Tc.Module
	 * @constructor
	 */
	Tc.Module.Recipes.Admin = function(parent) {
		this.$modal = {};
		/**
		 * override the appropriate methods from the decorated module (ie. this.get = function()).
		 * the former/original method may be called via parent.<method>()
		 */
		this.on = function(callback) {
			this.bindAll(
				'onGetIngredientsSuccess',
				'onGetIngredientsError',
				'registerClickListener',
				'onDeleteRecipe',
				'onEditRecipe',
				'onConfirmDeletion',
				'onDeleteRecipeSuccess',
				'onDeleteRecipeError',
				'onConfirmEditing',
				'onEditRecipeSuccess',
				'onEditRecipeError'
			);
			this.initModal();
			this.getIngredients();
			this.$ctx.on('rendered', this.registerClickListener);
			//calling parent method
			parent.on(callback);
		};

		this.after = function() {
			// calling parent method
			parent.after();
		};

		this.initSortable = function() {
			this.$('.js-sortable').sortable({
				connectWith: '.js-connected',
				items: ':not(:disabled)'
			});
		};

		this.initModal = function() {
			var that = this, $el;
			this.$('.js-modal').each(function(i, el) {
				$el = $(el);
				that.$modal[$el.data('name')] = $el.modal({
					show: false
				});
			});
		};

		this.getIngredients = function() {
			$.ajax({
				url: this.$ctx.data('service-ingredients'),
				success: this.onGetIngredientsSuccess,
				error: this.onGetIngredientsError
			});
		};

		this.onGetIngredientsSuccess = function(data) {
			this.ingredients = data;
		};

		this.onGetIngredientsError = function(err) {
			console.log('err', err);
		};

		this.registerClickListener = function() {
			this.$('.js-delete-recipe').off().on('click', this.onDeleteRecipe);
			this.$('.js-edit-recipe').off().on('click', this.onEditRecipe);
		};

		this.onDeleteRecipe = function(ev) {
			var $modal = this.$modal.delete;
			$modal.find('.js-replace-recipe').text($(ev.currentTarget).data('recipe-name'));
			$modal.find('.js-delete-it').off().on('click', this.onConfirmDeletion);
			$modal.modal('show');
		};

		this.onConfirmDeletion = function(ev) {
			$.ajax({
				url: '/project/ajax.php?api=deleteRecipe',
				type: 'POST',
				data: $(ev.currentTarget).data('recipe-id'),
				success: this.onDeleteRecipeSuccess,
				error: this.onDeleteRecipeError
			});
		};

		this.onDeleteRecipeSuccess = function() {
			this.$modal.delete.modal('hide');
			parent.getRecipes();
		};

		this.onDeleteRecipeError = function(err) {
			console.log('error', err);
		};

		this.onEditRecipe = function(ev) {
			var $el = $(ev.currentTarget),
				$modal = this.$modal.edit;
			this.currentRecipeId = $el.data('recipe-id');
			this.renderIngredientLists();
			this.initSortable();
			$modal.find('.js-replace-recipe').text($el.data('recipe-name'));
			$modal.find('.js-edit-it').on('click', this.onConfirmEditing);
			$modal.modal('show');
		};

		this.renderIngredientLists = function() {
			var that = this,
				currentIngredients = [],
				allIngredients = [],
				data = {},
				addIt;

			parent.recipes.recipes.some(function(item) {
				if(that.currentRecipeId === item.id) return currentIngredients = item.ingredients;
			});

			this.ingredients.ingredients.forEach(function(item) {
				addIt = true;
				currentIngredients.forEach(function(name) {
					if(item.name === name) addIt = false;
				});
				if(addIt) allIngredients.push(item.name);
			});

			data = { type: 'Ausgewählte Zutaten', ingredients: currentIngredients };
			this.$('.js-current-ingredients-list-container').html(this.template(this.$('#ingredients-list-template').html(), data));

			data = { type: 'Verfügbare Zutaten', ingredients: allIngredients };
			this.$('.js-all-ingredients-list-container').html(this.template(this.$('#ingredients-list-template').html(), data));
		};

		this.onConfirmEditing = function() {
			var data = this.getEditedRecipe();
			$.ajax({
				url: '/project/ajax.php?api=editRecipe',
				type: 'POST',
				data: data,
				success: this.onEditRecipeSuccess,
				error: this.onEditRecipeError
			});
		};

		this.getEditedRecipe = function() {
			return {
				recipe: this.currentRecipeId,
				ingredients: this.getSelectedIngredients()
			};
		};

		this.getSelectedIngredients = function() {
			var arr = [];
			this.$('.js-current-ingredients-list-container button:not(:disabled)').each(function(i, el) {
				arr.push($(el).text());
			});
			return arr;
		};

		this.onEditRecipeSuccess = function() {
			this.$modal.edit.modal('hide');
			parent.getRecipes();
		};

		this.onEditRecipeError = function() {
			console.log('error', err);
		}
	};
}(Tc.$));
