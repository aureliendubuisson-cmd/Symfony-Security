<?php

namespace App\Factory;

use App\Entity\Answer;
use App\Repository\AnswerRepository;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Answer>
 *
 * @method static Answer createOne(array $attributes = [])
 * @method static Answer[] createMany(int $number, array|callable $attributes = [])
 * @method static Answer find(object|array|mixed $criteria)
 * @method static Answer findOrCreate(array $attributes)
 * @method static Answer first(string $sortedField = 'id')
 * @method static Answer last(string $sortedField = 'id')
 * @method static Answer random(array $attributes = [])
 * @method static Answer randomOrCreate(array $attributes = [])
 * @method static Answer[] all()
 * @method static Answer[] findBy(array $attributes)
 * @method static Answer[] randomSet(int $number, array $attributes = [])
 * @method static Answer[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AnswerRepository repository()
 * @method Answer create(array|callable $attributes = [])
 */
final class AnswerFactory extends PersistentObjectFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    public function needsApproval(): self
    {
        return $this->with(['status' => Answer::STATUS_NEEDS_APPROVAL]);
    }

    protected function defaults(): array
    {
        return [
            'content' => self::faker()->text(),
            'username' => self::faker()->userName(),
            'createdAt' => self::faker()->dateTimeBetween('-1 year'),
            'votes' => rand(-20, 50),
            'question' => QuestionFactory::new()->unpublished(),
            'status' => Answer::STATUS_APPROVED,
        ];
    }

    public static function class(): string
    {
        return Answer::class;
    }
}
