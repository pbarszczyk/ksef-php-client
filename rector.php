<?php

declare(strict_types=1);

use N1ebieski\KSEFClient\Overrides\Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\Carbon\Rector\MethodCall\DateTimeMethodCallToCarbonRector;
use Rector\Carbon\Rector\New_\DateTimeInstanceToCarbonRector;
use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\FuncCall\FunctionFirstClassCallableRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Node\RemoveNonExistingVarAnnotationRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
    ->withRules([
        ClosureToArrowFunctionRector::class,
    ])
    ->withSkip([
        DateTimeMethodCallToCarbonRector::class,
        RemoveNonExistingVarAnnotationRector::class,
        EncapsedStringsToSprintfRector::class,
        \Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector::class,
        DateTimeInstanceToCarbonRector::class,
        ExplicitBoolCompareRector::class => [
            __DIR__ . '/src/Actions/ConvertEcdsaDerToRaw/ConvertEcdsaDerToRawHandler.php'
        ],
        FunctionFirstClassCallableRector::class => [
            __DIR__ . '/src/Validator/Rules/Number/NipRule.php'
        ],
        CompleteDynamicPropertiesRector::class => [
            __DIR__ . '/src/Testing/Fixtures/Requests/AbstractResponseFixture.php',
            __DIR__ . '/src/Testing/Fixtures/DTOs/Requests/Sessions/AbstractFakturaFixture.php'
        ],
        CatchExceptionNameMatchingTypeRector::class
    ])
    ->withCache(
        __DIR__.'/.rector.cache',
        FileCacheStorage::class
    )
    ->withComposerBased(phpunit: true)
    ->withImportNames(removeUnusedImports: true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        instanceOf: true,
        earlyReturn: true,
        carbon: true,
        phpunitCodeQuality: true
    )
    ->withDowngradeSets(php81: true)
    ->withPhpSets(php81: true);
