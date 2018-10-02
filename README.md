# trivago Express Booking - Self Connect API

![Read the Docs](http://img.shields.io/badge/Read%20the-Docs-blue.svg)

- [Schemas](#schemas)
  - [Booking availability](#booking-availability)
  - [Booking prepare](#booking-prepare)
  - [Booking payment authorise](#booking-payment-authorise)
  - [Booking submit](#booking-submit)
  - [Booking verify](#booking-verify)
- [OpenAPI - Automated client generation](#openapi---automated-client-generation)
  - [Installation](#installation)
  - [Client generation](#client-generation)
  - [Server stub generation](#server-stub-generation)
  - [References](#references)

trivago Express Booking (tEB) fast tracks the booking process for users while maintaining your brand presence.

For further details see:
http://developer.trivago.com/expressbooking/express-booking-overview.html


## JSON Schemas

### Booking availability

See documentation: http://developer.trivago.com/expressbooking/booking-availability.html

|               | Schema         | Example  |
| ------------- | -------------- | -------- |
| Request       | not JSON       | -        |
| Response      | schemas/booking-availability-response.json | examples/booking-availability/response.json |


### Booking prepare

See documentation: http://developer.trivago.com/expressbooking/booking-preparation.html

|               | Schema        | Example  |
| ------------- | ------------- | -------- |
| Request       | schemas/booking-prepare-request.json  | examples/booking-availability/response.json |
| Response      | schemas/booking-prepare-response.json | examples/booking-availability/response.json |


### Booking payment authorise

See documentation: http://developer.trivago.com/expressbooking/booking-authorisation.html

|               | Schema        | Example  |
| ------------- | ------------- | -------- |
| Request       | schemas/booking-payment-authorise-request.json  | examples/booking-availability/response.json |
| Response      | schemas/booking-payment-authorise-response.json | examples/booking-availability/response.json |


### Booking submit

See documentation: http://developer.trivago.com/expressbooking/booking-submission.html

|               | Schema        | Example  |
| ------------- | ------------- | -------- |
| Request       | schemas/booking-submit-request.json  | examples/booking-availability/response.json |
| Response      | schemas/booking-submit-response.json | examples/booking-availability/response.json, examples/booking-availability/response-payment-pending.json |


### Booking verify

See documentation: http://developer.trivago.com/expressbooking/booking-verification.html

|               | Schema        | Example  |
| ------------- | ------------- | -------- |
| Request       | not JSON      | -        |
| Response      | schemas/booking-verify-response.json | examples/booking-availability/response.json |


## OpenAPI - Automated client generation

With the availability of the swagger file, which is now part of the main repository, you can speed up the implementation of Self Connect
with the use of the swagger-codegen library, which provides code generation for different programming languages and frameworks.
This guide is ment to be a short introduction to it, leaving the official guide the goto for more in depth information.
Guide which can be found on [swagger-codegen](https://github.com/swagger-api/swagger-codegen)

*Note : The swagger codegen requires java version 7 or above.* 


### Installation

**Linux**

Since Self Connect swagger file uses version 3.0 of OpenAPI we are going to install the latest version which at the time of writing is 
3.0.0-rc1.
```bash
wget https://oss.sonatype.org/content/repositories/releases/io/swagger/codegen/v3/swagger-codegen-cli/3.0.0/swagger-codegen-cli-3.0.0.jar
java -jar swagger-codegen-cli-3.0.0.jar --help
```

**Windows**
```PowerShell
Invoke-WebRequest -OutFile swagger-codegen-cli.jar https://oss.sonatype.org/content/repositories/releases/io/swagger/codegen/v3/swagger-codegen-cli/3.0.0/swagger-codegen-cli-3.0.0.jar
```

**OS X**

```bash
brew install swagger-codegen
```


### Client generation

To generate a client for php, you can execute the following :

```bash
java -jar swagger-codegen-cli-3.0.0.jar generate \
   -i https://raw.githubusercontent.com/trivago/express-booking-selfconnect-api/master/openapi.json \
   -l php \
   -o /var/tmp/php_api_client
```

To get a list of available generator options you might run :

```bash
java -jar swagger-codegen-cli-3.0.0.jar config-help -l php
```


### Server stub generation

The generation of the server stub is identical to the generation of the client with only the `-l` option changin.
In case we want to generate a server stub for the PHP Silex framework, the command should be :

```bash
java -jar swagger-codegen-cli-3.0.0.jar generate \
   -i https://raw.githubusercontent.com/trivago/express-booking-selfconnect-api/master/openapi.json \
   -l php-silex \
   -o /var/tmp/php_api_client
```

As with everything related to the swagger-codegen library you can refer to the official documentation, in this case here
[Server stub generation](https://github.com/swagger-api/swagger-codegen/wiki/Server-stub-generator-HOWTO)


### References

A list of references which might be useful :

- https://swagger.io/specification/
- https://swagger.io/tools/open-source/open-source-integrations/
- https://apis.guru/awesome-openapi3/
