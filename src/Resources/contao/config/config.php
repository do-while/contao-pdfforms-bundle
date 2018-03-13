<?php

/**
 * Extension for Contao 4
 *
 * @copyright  Softleister 2014-2018
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */

define('PDFFORMS_VERSION', '1.3');
define('PDFFORMS_BUILD'  , '1');

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['form']['tables'][]   = 'tl_pdff_positions';
$GLOBALS['BE_MOD']['content']['form']['stylesheet'] = 'bundles/softleisterpdfforms/styles.css';
$GLOBALS['BE_MOD']['content']['form']['testpdf']    = array('Softleister\Pdfforms\PdfformsTestPdf', 'testpdf');

/**
 * -------------------------------------------------------------------------
 * HOOKS
 * -------------------------------------------------------------------------
 */
$GLOBALS['TL_HOOKS']['prepareFormData'][]    = array('Softleister\Pdfforms\PdfformsHookControl', 'myPrepareFormData');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]  = array('Softleister\Pdfforms\PdfformsHookControl', 'myReplaceInsertTags');

//-------------------------------------------------------------------
// Notification Center
//-------------------------------------------------------------------
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['pdf_forms'] = array
(
    'pdf_form_transmit' => array(
            'recipients'            => array('admin_email', 'form_*'),      // Empfänger
            'email_subject'         => array('form_*', 'admin_email'),      // Betreff
            'email_text'            => array('form_*', 'raw_data', 'openpassword', 'admin_email'),
            'email_html'            => array('form_*', 'raw_data', 'openpassword', 'admin_email'),
            'file_name'             => array('form_*', 'admin_email'),
            'file_content'          => array('form_*', 'admin_email'),
            'email_recipient_cc'    => array('admin_email', 'form_*'),      // Kopie an
            'email_recipient_bcc'   => array('admin_email', 'form_*'),      // Blindkopie an
            'email_replyTo'         => array('admin_email', 'form_*'),      // Antwortadresse
            'attachment_tokens'     => array('pdfdocument', 'form_*'),      // erzeugtes PDF
    ),
);
