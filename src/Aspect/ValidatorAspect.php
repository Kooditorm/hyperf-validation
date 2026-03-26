<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Aspect;

use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Kooditorm\Validation\Annotation\Valid;
use Kooditorm\Validation\Annotation\Validated;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;
use Kooditorm\Validation\Exception\ValidationException;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;


#[Aspect]
class ValidatorAspect extends AbstractAspect
{

    public array $annotations = [
        Validated::class,
        Valid::class
    ];

    private array $trans = [
        'int' => 'integer',
        'bool' => 'boolean'
    ];

    private array $allowType = [
        'int', 'bool', 'string', 'array'
    ];

    public function __construct(
        protected ValidatorFactoryInterface $validatorFactory,
        protected RequestInterface          $request
    )
    {
    }

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed
     * @throws \Hyperf\Di\Exception\Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint): mixed
    {
        $data = $this->request->all();

        $rules = [];
        $messages = [];

        $validatedAnnotation = $this->getValidatedAnnotation($proceedingJoinPoint);
        if (empty($validatedAnnotation)) {
            $validatedAnnotation = $this->getValidatedArguments($proceedingJoinPoint);
        }
        if (is_array($validatedAnnotation)) {
            foreach ($validatedAnnotation as $validated) {
                [$rule, $message] = $this->getRules($validated);
                $rules = [...$rules, ...$rule];
                $messages = [...$messages, ...$message];
            }
        } else {
            [$rules, $messages] = $this->getRules($validatedAnnotation);
        }

        $validator = $this->validatorFactory->make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }

        return $proceedingJoinPoint->process();
    }

    private function getRules(object|string $object): array
    {
        $rules = [];
        $messages = [];
        try {
            $reflectionClass = new ReflectionClass($object);
        } catch (ReflectionException) {
            return [$rules, $messages];
        }
        foreach ($reflectionClass->getProperties() as $property) {
            $propertyName = $property->getName();
            $type = $property->getType();

            //只支持单一类型自动验证
            if ($type instanceof \ReflectionNamedType && in_array($type->getName(), $this->allowType, true)) {
                $typeName = $this->trans[$type->getName()] ?? $type->getName();
                $rules[$propertyName][] = $typeName;

                if ($type->allowsNull()) {
                    $rules[$propertyName][] = 'nullable';
                }
            }

            $attributes = $property->getAttributes(ValidatorAnnotation::class, ReflectionAttribute::IS_INSTANCEOF);
            foreach ($attributes as $attribute) {
                $instance = $attribute->newInstance();
                $rule = $instance->rule ?? $instance->rule();

                if (empty($rule)) {
                    continue;
                }
                $value = $instance->value ?? '';
                $message = $instance->message ?? '';
                if (!empty($value)) {
                    $rule .= ':' . $value;
                }
                $rules[$propertyName][] = $rule;

                if (!empty($rule) && $message) {
                    $ruleName = explode(':', $rule)[0];
                    $messages["$propertyName.$ruleName"] = $message;
                }
            }
        }
        return [$rules, $messages];
    }

    private function getValidatedAnnotation(ProceedingJoinPoint $proceedingJoinPoint): ?string
    {

        $reflectionMethod = $proceedingJoinPoint->getReflectMethod();
        foreach ($this->annotations as $annotation) {
            $attributes = $reflectionMethod->getAttributes($annotation);
            if (!empty($attributes)) {
                $instance = $attributes[0]->newInstance();
                return $instance->instance ?? null;
            }
        }

        return null;
    }


    private function getValidatedArguments(ProceedingJoinPoint $proceedingJoinPoint): array
    {
        $validatedAnnotation = [];
        $parameters = $proceedingJoinPoint->getArguments();
        foreach ($parameters as $parameter) {
            if (is_object($parameter)) {
                try {
                    $reflectionClass = new ReflectionClass($parameter);
                    $validatedAnnotation[] = $reflectionClass->getName();
                } catch (ReflectionException) {
                    return $validatedAnnotation;
                }
            }
        }

        return $validatedAnnotation;
    }


}