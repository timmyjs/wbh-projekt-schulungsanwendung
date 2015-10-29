(function($) {
	'use strict';
	/**
	 * Exercise skin implementation for the Practice module.
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module.Practice
	 * @class Exercise
	 * @extends Tc.Module
	 * @constructor
	 */
	Tc.Module.Practice.Exercise = function(parent) {
		/**
		 * override the appropriate methods from the decorated module (ie. this.get = function()).
		 * the former/original method may be called via parent.<method>()
		 */
		this.on = function(callback) {
			//calling parent method
			parent.on(callback);
		};

		this.after = function() {
			// calling parent method
			parent.after();
		};

		parent.resolveRecipe = function() {
			!this.resolved ? this.resolved = 1 : this.resolved +=1;
			this.$('.js-resolved').text(this.resolved);
			if(this.resolved < 10){
				this.getNewRecipe();
				this.resetSelection();
			}else{
				this.finishPractice();
			}
		};
	};
}(Tc.$));
