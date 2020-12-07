<?php
/**
 * This file is part of the Cloudinary PHP package.
 *
 * (c) Cloudinary
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cloudinary\Transformation;

/**
 * Trait EffectParamTrait
 *
 * @api
 */
trait EffectParamTrait
{
    /**
     * Injects a custom function into the image transformation pipeline.
     *
     * @param string $effectName The name of the effect.
     * @param mixed  ...$values  The effect values.
     *
     * @return EffectParam
     */
    public static function effect($effectName, ...$values)
    {
        return new EffectParam($effectName, ...$values);
    }
}
