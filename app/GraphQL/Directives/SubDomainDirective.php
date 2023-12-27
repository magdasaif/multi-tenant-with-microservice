<?php

namespace App\GraphQL\Directives;

use Closure;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;

class SubDomainDirective extends BaseDirective
{
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
            """
            Apply middleware to the field resolver.
            """
            directive @subDomain(classes: [String!]!) on FIELD_DEFINITION
        GRAPHQL;
    }

    public function handleField(FieldValue $fieldValue, Closure $next): FieldValue
    {
        $middlewareClasses = $this->directiveArgValue('classes');

        $resolver = $fieldValue->getResolver();

        $fieldValue->setResolver(
            function ($root, array $args, $context, $info) use ($resolver, $middlewareClasses) {
                $pipe = array_reduce(
                    $middlewareClasses,
                    function ($carry, $middlewareClass) {
                        return function ($context) use ($carry, $middlewareClass) {
                            $middleware = app($middlewareClass);
                            return $middleware->handle($context, $carry);
                        };
                    },
                    $resolver
                );

                return $pipe($root, $args, $context, $info);
            }
        );

        return $next($fieldValue);
    }
}