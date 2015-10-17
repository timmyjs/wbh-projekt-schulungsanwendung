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
				'registerClickListener',
				'onDeleteRecipe',
				'onEditRecipe',
				'onConfirmDeletion',
				'onDeleteRecipeSuccess',
				'onDeleteRecipeError'
			);
			this.initSortable();
			this.initModal();
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
			this.$modal.modal('hide');
			parent.getRecipes();
		};

		this.onDeleteRecipeError = function(err) {
			console.log('error', err);
		};

		this.onEditRecipe = function(ev) {
			var $modal = this.$modal.edit;
			$modal.find('.js-replace-recipe').text($(ev.currentTarget).data('recipe-name'));
			$modal.modal('show');
		};
	};
}(Tc.$));
