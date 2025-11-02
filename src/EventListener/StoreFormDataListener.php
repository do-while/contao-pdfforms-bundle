<?php

declare( strict_types=1 );

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2025
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */

namespace Softleister\PdfformsBundle\EventListener;

use Contao\Form;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('storeFormData')]
class StoreFormDataListener
{
    public function __invoke(array $submittedData, Form $form): array
    {
        if (isset($submittedData[PrepareFormDataListener::SUBMITKEY])) {
            unset($submittedData[PrepareFormDataListener::SUBMITKEY]);
        }

        return $submittedData;
    }
}
