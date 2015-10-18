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
				'registerClickListener',
				'enableEditing'
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
			this.$('.js-enable-editing').on('click', this.enableEditing);
		},

		enableEditing: function(ev) {
			$(ev.currentTarget).closest('tr').find('.js-toggle-editing').toggleClass('hidden');
			this.$('.js-form-action').removeAttr('disabled').removeClass('disabled');
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
			console.log('success', data);
		},

		onSubmitFormError: function(err) {
			console.log('error', err);
		}

	});
}(Tc.$));
