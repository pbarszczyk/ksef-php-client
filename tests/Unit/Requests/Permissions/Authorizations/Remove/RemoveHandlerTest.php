<?php

declare(strict_types=1);

use N1ebieski\KSEFClient\Requests\Permissions\Authorizations\Remove\RemoveRequest;
use N1ebieski\KSEFClient\Testing\Fixtures\Requests\Error\ErrorResponseFixture;
use N1ebieski\KSEFClient\Testing\Fixtures\Requests\Permissions\Authorizations\Remove\RemoveRequestFixture;
use N1ebieski\KSEFClient\Testing\Fixtures\Requests\Permissions\Authorizations\Remove\RemoveResponseFixture;
use N1ebieski\KSEFClient\Tests\Unit\AbstractTestCase;

/** @var AbstractTestCase $this */

/**
 * @return array<string, array{RemoveRequestFixture, RemoveResponseFixture}>
 */
dataset('validResponseProvider', function (): array {
    $requests = [
        new RemoveRequestFixture(),
    ];

    $responses = [
        new RemoveResponseFixture(),
    ];

    $combinations = [];

    foreach ($requests as $request) {
        foreach ($responses as $response) {
            $combinations["{$request->name}, {$response->name}"] = [$request, $response];
        }
    }

    /** @var array<string, array{RemoveRequestFixture, RemoveResponseFixture}> */
    return $combinations;
});

test('valid response', function (RemoveRequestFixture $requestFixture, RemoveResponseFixture $responseFixture): void {
    /** @var AbstractTestCase $this */
    $clientStub = $this->createClientStub($responseFixture);

    $request = RemoveRequest::from($requestFixture->data);

    expect($request)->toBeFixture($requestFixture->data);

    $response = $clientStub->permissions()->authorizations()->remove($requestFixture->data)->object();

    expect($response)->toBeFixture($responseFixture->data);
})->with('validResponseProvider');

test('invalid response', function (): void {
    $responseFixture = new ErrorResponseFixture();

    expect(function () use ($responseFixture): void {
        /** @var AbstractTestCase $this */
        $requestFixture = new RemoveRequestFixture();

        $clientStub = $this->createClientStub($responseFixture);

        $clientStub->permissions()->authorizations()->remove($requestFixture->data);
    })->toBeExceptionFixture($responseFixture->data);
});
