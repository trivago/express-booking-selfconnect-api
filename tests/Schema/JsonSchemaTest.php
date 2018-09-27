<?php
/**
 * ota-self-connect-json-schema
 *
 * Copyright (c) 2018 trivago
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @since     2018-05-07
 * @author    Roman Lasinski <roman.lasinski@trivago.com>
 */

class JsonSchemaTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return array
     */
    public function getFilesToValidate()
    {
        return [
            [
                __DIR__ . '/../../schemas/booking-availability-response.json',
                __DIR__ . '/../../examples/booking-availability/response.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-availability-response.json',
                __DIR__ . '/../../examples/booking-availability/response_with_installment.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-availability-response.json',
                __DIR__ . '/../../examples/booking-availability/response-error.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-payment-authorise-request.json',
                __DIR__ . '/../../examples/booking-payment-authorise/request.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-payment-authorise-response.json',
                __DIR__ . '/../../examples/booking-payment-authorise/response.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-payment-authorise-response.json',
                __DIR__ . '/../../examples/booking-payment-authorise/response-error.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-prepare-request.json',
                __DIR__ . '/../../examples/booking-prepare/request.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-prepare-response.json',
                __DIR__ . '/../../examples/booking-prepare/response.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-prepare-response.json',
                __DIR__ . '/../../examples/booking-prepare/response-adjusted.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-prepare-response.json',
                __DIR__ . '/../../examples/booking-prepare/response-sold-out.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-submit-request.json',
                __DIR__ . '/../../examples/booking-submit/request.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-submit-response.json',
                __DIR__ . '/../../examples/booking-submit/response.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-submit-response.json',
                __DIR__ . '/../../examples/booking-submit/response-payment-pending.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-submit-response.json',
                __DIR__ . '/../../examples/booking-submit/response-error.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-verify-response.json',
                __DIR__ . '/../../examples/booking-verify/response.json'
            ],
            [
                __DIR__ . '/../../schemas/booking-verify-response.json',
                __DIR__ . '/../../examples/booking-verify/response-error.json'
            ],
        ];
    }

    /**
     * @return array
     */
    public function getInvalidFilesToValidate()
    {
        return [
            [
                [
                    '[property "room_type" is missing] .',
                    '[should match one element in enum] /status.',
                    '[instance must match exactly one of the schemas listed in oneOf] .'
                ],
                __DIR__ . '/../../schemas/booking-prepare-response.json',
                __DIR__ . '/../../examples/booking-prepare/response-invalid.json'
            ],
        ];
    }

    /**
     * @dataProvider getFilesToValidate
     *
     * @param string $schemaFile
     * @param string $jsonFile
     */
    public function testJsonSchema($schemaFile, $jsonFile)
    {
        $errors = self::validateJsonSchema($schemaFile, $jsonFile);
        self::assertEmpty($errors, $jsonFile . ': ' . implode(', ', $errors));
    }

    /**
     * @dataProvider getInvalidFilesToValidate
     *
     * @param array $expectedErrors
     * @param string $schemaFile
     * @param string $jsonFile
     */
    public function testJsonSchemaInvalid(array $expectedErrors, $schemaFile, $jsonFile)
    {
        $errors = self::validateJsonSchema($schemaFile, $jsonFile);
        self::assertSame($expectedErrors, $errors);
    }

    /**
     * @param string $schemaFilePath
     * @param string $jsonFile
     *
     * @return array
     */
    private static function validateJsonSchema($schemaFilePath, $jsonFile)
    {
        $schemaFile = realpath($schemaFilePath);
        if ($schemaFile === false) {
            self::fail(sprintf('Could not load schema file %s.', $schemaFilePath));
        }
        $jsonSchemaUri = 'file://' . pathinfo($schemaFile, PATHINFO_DIRNAME) . '/';

        $jsonSchema    = json_decode(file_get_contents($schemaFile));
        $jsonData      = json_decode(file_get_contents($jsonFile));

        $validator  = \JVal\Validator::buildDefault();
        $violations = $validator->validate($jsonData, $jsonSchema, $jsonSchemaUri);

        $errors = [];
        foreach ($violations as $violation) {
            $errors[] =  sprintf('[%s] %s.', $violation['message'], $violation['path']);
        }

        return $errors;
    }
}
