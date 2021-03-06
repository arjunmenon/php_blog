@if($user->paid)
	<p style="margin-bottom: 0;">Your account has full access to the blog.</p>
	<p>You can now create, edit your blog posts</p>
@else
	<p style="margin-bottom: 0;">Your account is limited to viewing posts only.</p>
	<p>To enable full access, subscribe to our yearly plan for just <strong>Rs. 5000</strong></p>

	{{-- <a href="{{action('PaymentController@store')}}">Link name/Embedded Button</a> --}}

	<button id="rzp-button1" type="button" class="btn btn-success">Pay Rs. 5000</button>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script type="text/javascript">
		var options = {
		    "key": "rzp_test_lq36LvHQEZxVCb", // Enter the Key ID generated from the Dashboard
		    "amount": "50000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
		    "currency": "INR",
		    "name": "Acme Corp",
		    "description": "Test Transaction",
		    "image": "https://example.com/your_logo",
		    "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
		    "handler": function (response){
		        // alert(response.razorpay_payment_id);
		        // alert(response.razorpay_order_id);
		        // alert(response.razorpay_signature);

		        const data = { 
		        				transaction_reference_number: response.razorpay_payment_id,
		        				rzp_order_id: response.razorpay_order_id,
		        				transaction_signature: response.razorpay_signature,
		        				raw_response: response,
		        				"_token": "{{ csrf_token() }}"
		        			};

				fetch("{{action('PaymentController@update')}}", {
					  method: 'PUT', // or 'PUT'
					  headers: {
					    'Content-Type': 'application/json',
					  },
					  body: JSON.stringify(data),
					})
					.then(response => response.json())
					.then(data => {
					  console.log('Success:', data);
					})
					.catch((error) => {
					  console.error('Error:', error);
					});
		    },
		    "prefill": {
		        "name": "Gaurav Kumar",
		        "email": "gaurav.kumar@example.com",
		        "contact": "9999999999"
		    },
		    "notes": {
		        "address": "Razorpay Corporate Office"
		    },
		    "theme": {
		        "color": "#F37254"
		    }
		};

		let url = "{{action('PaymentController@store')}}";

		document.getElementById('rzp-button1').onclick = function(e){
			fetch(url)
			.then(res => res.json())
			.then((out) => {
			  	console.log('Checkout this JSON! ', out);
			  	options["amount"] = out.amount;
			  	options["currency"] = out.currency;
			  	options["order_id"] = out.transaction_reference_number;

			  	console.log('Checkout this order! ', options);
				var rzp1 = new Razorpay(options);
			    rzp1.open();
			    e.preventDefault();
			})
			.catch(err => { throw err });
		}
	</script>
@endif