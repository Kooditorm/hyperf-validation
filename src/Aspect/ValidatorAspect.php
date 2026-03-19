<?php
declare(strict_types=1);

namespace kooditorm\Validation\Aspect;

use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use kooditorm\Validation\Annotations\Valid;
use kooditorm\Validation\Annotations\Validated;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

#[Aspect]
class ValidatorAspect extends AbstractAspect
{

    public array $annotations = [
        Validated::class,
        Valid::class
    ];

    private array $trans = [
        'int' => 'integer'
    ];

    public function __construct(
        protected ValidatorFactoryInterface $validatorFactory,
        protected RequestInterface $request
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
            $typeName = $this->trans[$type->getName()] ?? $type->getName();
            $rules[$propertyName][] = $typeName;

            if ($type->allowsNull()) {
                $rules[$propertyName][] = 'nullable';
            }

            $attributes = $property->getAttributes(ValidatorAnnotation::class, ReflectionAttribute::IS_INSTANCEOF);
            foreach ($attributes as $attribute) {
                $instance = $attribute->newInstance();
                $rule = $instance->rule ?? '';
                $value = $instance->value ?? '';
                $message = $instance->message ?? '';
                if (!empty($rule) && !empty($value)) {
                    $rule = str_replace('{$value}', $value, $rule);
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