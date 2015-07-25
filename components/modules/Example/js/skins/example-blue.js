(function($) {
	'use strict';
	/**
	 * Blue skin implementation for the Example module.
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module.Example
	 * @class Blue
	 * @extends Tc.Module
	 * @constructor
	 */
	Tc.Module.Example.Blue = function(parent) {
		/**
		 * override the appropriate methods from the decorated module (ie. this.get = function()).
		 * the former/original method may be called via parent.<method>()
		 */
		this.on = function(callback) {
			var mod = this,
				$ctx = mod.$ctx;

			console.log('Example Skin Blue - on [id:' + mod.id + ']');

			//calling parent method
			parent.on(callback);
		};

		this.after = function() {
			var mod = this,
				$ctx = mod.$ctx;

			console.log('Example Skin Blue - after [id:' + mod.id + ']');

			// calling parent method
			parent.after();
		};
	};
}(Tc.$));
