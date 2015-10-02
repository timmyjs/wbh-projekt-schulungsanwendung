(function($) {
	'use strict';
	/**
	 * Registration module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Registration
	 * @extends Tc.Module
	 */
	Tc.Module.Registration = Tc.Module.extend({

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			this.bindAll(
				'onSubmitRegistration',
				'onSubmitRegistrationSuccess',
				'onSubmitRegistrationError'
			);
			console.log('Registration on');
			this.$('.js-registration-form').on('submit', this.onSubmitRegistration);
			callback();
		},

		after: function() {
		},

		onSubmitRegistration: function(ev) {
			this.$('.js-error-container').empty();
			ev.preventDefault();
			var $form = $(ev.currentTarget);
			$.ajax({
				url: $form.attr('action'),
				method: $form.attr('method'),
				data: $form.serialize(),
				success: this.onSubmitRegistrationSuccess,
				error: this.onSubmitRegistrationError
			});
			this.$('.js-ajax-loader').addClass('active');
		},

		onSubmitRegistrationSuccess: function(data) {
			if(data.success){
				this.showSuccess();
			}else{
				this.showError();
			}
			this.$('.js-ajax-loader').removeClass('active');
		},

		onSubmitRegistrationError: function(err) {
			this.showError();
		},

		showSuccess: function() {
			this.$('.js-registration-form').html(this.template(this.$('#registration-success-template').html(), {}));
		},

		showError: function() {
			this.$('.js-error-container').html(this.template(this.$('#registration-error-template').html(), {}));
		}

	});
}(Tc.$));
