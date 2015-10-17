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
		/**
		 * override the appropriate methods from the decorated module (ie. this.get = function()).
		 * the former/original method may be called via parent.<method>()
		 */
		this.on = function(callback) {
			this.bindAll(
				'registerClickListener',
				'onDeleteRecipe',
				'onEditRecipe',
				'onConfirmDeletion',
				'onDeleteRecipeSuccess',
				'onDeleteRecipeError'
			);
			this.initModal();
			this.$ctx.on('rendered', this.registerClickListener);
			//calling parent method
			parent.on(callback);
		};

		this.after = function() {
			// calling parent method
			parent.after();
		};

		this.initModal = function() {
			this.$modal = this.$('.js-delete-modal').modal({
				show: false
			})
		};

		this.registerClickListener = function() {
			this.$('.js-delete-recipe').off().on('click', this.onDeleteRecipe);
			this.$('.js-edit-recipe').off().on('click', this.onEditRecipe);
		};

		this.onDeleteRecipe = function(ev) {
			this.$modal.find('.js-replace-recipe').text($(ev.currentTarget).data('recipe-name'));
			this.$modal.find('.js-delete-it').off().on('click', this.onConfirmDeletion);
			this.$modal.modal('show');
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
			this.$modal.modal('hide');
			parent.getRecipes();
		};

		this.onDeleteRecipeError = function(err) {
			console.log('error', err);
		};

		this.onEditRecipe = function() {
			alert('Edit Recipe - coming soon');
		};
	};
}(Tc.$));
