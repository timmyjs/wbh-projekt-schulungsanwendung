(function($) {
	'use strict';
	/**
	 * Login module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Login
	 * @extends Tc.Module
	 */
	Tc.Module.Login = Tc.Module.extend({

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			this.bindAll(
				'onSubmitLogin',
				'onSubmitLoginSuccess',
				'onSubmitLoginError',
				'resetError'
			);
			this.$('.js-login-form').on('submit', this.onSubmitLogin);
			this.$('.js-input').on('change', this.resetError);
			callback();
		},

		after: function() {
		},

		onSubmitLogin: function(ev) {
			ev.preventDefault();
			var $form = $(ev.currentTarget);
			$.ajax({
				url: $form.attr('action'),
				method: $form.attr('method'),
				data: $form.serialize(),
				success: this.onSubmitLoginSuccess,
				error: this.onSubmitLoginError
			});
		},

		onSubmitLoginSuccess: function(data) {
			if(data.success){
				document.location.href = 'mainmenu';
			}else{
				this.setError();
			}
		},

		onSubmitLoginError: function(err) {
			console.log('error', err);
		},

		setError: function() {
			this.$('.js-form-group').addClass('has-error');
			this.$('.js-error-text').removeClass('hidden');
		},

		resetError: function() {
			this.$('.js-error-text').addClass('hidden');
			this.$('.js-form-group').removeClass('has-error');
		}

	});
}(Tc.$));
