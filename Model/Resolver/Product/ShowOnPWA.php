<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\PWA\Model\Resolver\Product;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Catalog\Model\ProductFactory;
class ShowOnPWA implements ResolverInterface
{
    protected $productFactory;
    public function __construct(
        ProductFactory $productFactory
    )
    {
        $this->productFactory = $productFactory;
    }
    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $product = $value['model'];
        $productId = $product->getId();

        if (!$productId) {
            return null;
        }

        $productModel = $this->productFactory->create()->load($productId);
        return (boolean)$productModel->getData('show_on_pwa');
    }
}
