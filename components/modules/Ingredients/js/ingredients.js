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
				'onGetDataError',
				'onSubmitForm',
				'onSubmitFormSuccess',
				'onSubmitFormError',
				'registerClickListener',
				'toggleEditing'
			);
			this.getData();
			this.$('.js-form').on('submit', this.onSubmitForm);
			this.$ctx.on('rendered', this.registerClickListener);
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
			this.$ctx.trigger('rendered');
		},

		onGetDataError: function(err) {
			console.log('err', err);
		},

		registerClickListener: function() {
			this.$('.js-toggle-editing').off().on('click', this.toggleEditing);
		},

		toggleEditing: function(ev) {
			var $tr = $(ev.currentTarget).closest('tr')
			if($tr.is('.editable')){
				this.disableEditing();
			}else{
				this.enableEditing();
			}
			$tr.closest('tr').toggleClass('editable');
		},

		disableEditing: function() {
			var $el;
			this.$('.js-submit').prop('disabled', true).addClass('disabled');
			this.$('.js-input').each(function(i, el) {
				$el = $(el);
				$el.val($el.data('origin-value'));
			});
		},

		enableEditing: function() {
			console.log('enableEditing');
			this.$('.js-submit').prop('disabled', false).removeClass('disabled');
		},

		onSubmitForm: function(ev) {
			ev.preventDefault();
			var $form = $(ev.currentTarget);
			$.ajax({
				url: $form.attr('action'),
				type: $form.attr('method'),
				data: $form.serialize(),
				success: this.onSubmitFormSuccess,
				error: this.onSubmitFormError
			});
		},

		onSubmitFormSuccess: function(data) {
			this.getData();
		},

		onSubmitFormError: function(err) {
			console.log('error', err);
		}

	});
}(Tc.$));
