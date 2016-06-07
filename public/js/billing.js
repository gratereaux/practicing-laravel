(function(){

	var StripeBilling = {

		init : function(){
			this.form = $('#billing-form');
			this.submitButton = this.form.find('input[type=submit]');
			this.submitButtonValue = this.submitButton.val();


			var stripeKey = $('meta[name="publishable-key"]').attr('content');
			Stripe.setPublishableKey(stripeKey);

			//temporary here
			this.form.on('submit', $.proxy(this.sendToken, this));
		},

		bindEvents: function(){
			
		},

		sendToken: function(event){
			this.submitButton.prop('disabled', true);
			this.submitButton.val('Procesando...');
			Stripe.createToken(this.form, $.proxy(this.stripeRespondHandler, this));
			event.preventDefault();
		},

		stripeRespondHandler: function(status, response){
			
			if(response.error){
				this.form.find('.payment-error').show().text(response.error.message);
				return this.submitButton.prop('disabled', false).val(this.submitButtonValue);

			}
			this.submitButton.val('Listo...');
			$('<input>', {
				type: 'hidden',
				name: 'stripe-token',
				value: response.id
			}).appendTo(this.form);

			this.form[0].submit();
		}

	};

	StripeBilling.init();

})();