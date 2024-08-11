<?php

declare( strict_types=1 );

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2024
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */


/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['form']['tables'][]   = 'tl_pdff_positions';
$GLOBALS['BE_MOD']['content']['form']['stylesheet'] = 'bundles/softleisterpdfforms/styles.css';
$GLOBALS['BE_MOD']['content']['form']['testpdf']    = ['Softleister\PdfformsBundle\PdfformsTestPdf', 'testpdf'];

