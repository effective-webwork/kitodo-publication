<?php
defined('TYPO3_MODE') or die();

return [
    'ctrl' => [
        'title' => 'Messages',
        'label' => 'functionname',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'default_sortby' => 'ORDER BY crdate DESC',
        'iconfile' => 'EXT:my_extension/Resources/Public/Icons/tx_dpf_domain_model_message.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'document,url,body,functionname,reason'
    ],
    'types' => [
        '1' => ['showitem' => 'document, url, body, functionname, reason']
    ],
    'columns' => [
        'document' => [
            'exclude' => 0,
            'label' => 'Document',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
            ]
        ],
        'url' => [
            'exclude' => 0,
            'label' => 'URL',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'eval' => 'trim,uniqueInPid',
            ]
        ],
        'body' => [
            'exclude' => 0,
            'label' => 'Body',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
            ]
        ],
        'functionname' => [
            'exclude' => 0,
            'label' => 'Function Name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'reason' => [
            'exclude' => 0,
            'label' => 'Reason',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'tstamp' => array(
            'config' => array(
                'type' => 'passthrough',
            )
        ),
    ],
];
