# trivago Express Booking - Self Connect API

trivago Express Booking (tEB) fast tracks the booking process for users while maintaining your brand presence.

For further details see:
http://developer.trivago.com/expressbooking/express-booking-overview.html


# Schemas

## Booking availability

See documentation: http://developer.trivago.com/expressbooking/booking-availability.html

|               | Schema         | Example  |
| ------------- | -------------- | -------- |
| Request       | not JSON       | -        |
| Response      | schemas/booking-availability-response.json | examples/booking-availability/response.json |


## Booking prepare

See documentation: http://developer.trivago.com/expressbooking/booking-preparation.html

|               | Schema        | Example  |
| ------------- | ------------- | -------- |
| Request       | schemas/booking-prepare-request.json  | examples/booking-availability/response.json |
| Response      | schemas/booking-prepare-response.json | examples/booking-availability/response.json |


## Booking payment authorise

See documentation: http://developer.trivago.com/expressbooking/booking-authorisation.html

|               | Schema        | Example  |
| ------------- | ------------- | -------- |
| Request       | schemas/booking-payment-authorise-request.json  | examples/booking-availability/response.json |
| Response      | schemas/booking-payment-authorise-response.json | examples/booking-availability/response.json |


## Booking submit

See documentation: http://developer.trivago.com/expressbooking/booking-submission.html

|               | Schema        | Example  |
| ------------- | ------------- | -------- |
| Request       | schemas/booking-submit-request.json  | examples/booking-availability/response.json |
| Response      | schemas/booking-submit-response.json | examples/booking-availability/response.json, examples/booking-availability/response-payment-pending.json |


## Booking verify

See documentation: http://developer.trivago.com/expressbooking/booking-verification.html

|               | Schema        | Example  |
| ------------- | ------------- | -------- |
| Request       | not JSON      | -        |
| Response      | schemas/booking-verify-response.json | examples/booking-availability/response.json |
