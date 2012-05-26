<?php
namespace SL\MainBundle\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class EnumStatutEnterprise extends Type
{
	const NAME = 'enumStatutEnterprise';
	protected	$values = array('waiting', 'started', 'completed');

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "ENUM('waiting', 'started', 'completed') COMMENT '(SLType:".self::NAME.")'";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, $this->values)) {
            throw new \InvalidArgumentException("Invalid status");
        }
        return $value;
    }

    public function getName()
    {
        return self::NAME;
    }
}