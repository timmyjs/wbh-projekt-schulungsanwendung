(function($) {
	'use strict';
	/**
	 * Forms module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Forms
	 * @extends Tc.Module
	 */
	Tc.Module.Forms = Tc.Module.extend({

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			this.bindAll(
				'onSubmitForm',
				'onSubmitFormSuccess',
				'onSubmitFormError'
			);
			this.$('.js-form').on('submit', this.onSubmitForm);
			callback();
		},

		after: function() {
		},

		onSubmitForm: function(ev) {
			this.$('.js-error-container').empty();
			ev.preventDefault();
			var $form = $(ev.currentTarget);
			$.ajax({
				url: $form.attr('action'),
				method: $form.attr('method'),
				data: $form.serialize(),
				success: this.onSubmitFormSuccess,
				error: this.onSubmitFormError
			});
			this.$('.js-ajax-loader').addClass('active');
		},

		onSubmitFormSuccess: function(data) {
			if(data.success){
				this.showSuccess();
			}else{
				this.showError();
			}
			this.$('.js-ajax-loader').removeClass('active');
		},

		onSubmitFormError: function(err) {
			this.showError();
		},

		showSuccess: function() {
			var data = { message: this.$ctx.data('success-message') };
			this.$('.js-form').html(this.template(this.$('#success-template').html(), data))
		},

		showError: function() {
			var data = { message: this.$ctx.data('error-message') };
			this.$('.js-error-container').html(this.template(this.$('#error-template').html(), data));
		}

	});
}(Tc.$));
